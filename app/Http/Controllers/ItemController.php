<?php

namespace App\Http\Controllers;

use App\Activo;
use App\Analisis;
use App\Area;
use App\Estado;
use App\Item;
use App\MoveHistory;
use App\Observacion;
use App\OtroMaterial;
use App\Tipo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
//use Endroid\QrCode\QrCode;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Svg\Tag\Rect;

require_once(public_path('phpqrcode/qrlib.php'));


class ItemController extends Controller
{
    public function index()
    {
        //
    }

    public function create($id)
    {
        $tipoActivo = Tipo::all();
        $areas = Area::all();
        $analisis = Analisis::all();
        $estados = Estado::all();
        if ($id === '0') {
            return view('items.create', compact('estados'))->with('analis', $analisis)->with('areas', $areas)->with('tipoActivo', $tipoActivo);;
        } else {
            $idarea = Area::find($id);
            return view('items.create', compact('estados'))->with('analis', $analisis)->with('areas', $areas)->with('tipoActivo', $tipoActivo)->with('idarea', $idarea);
        }
    }

    public function store(Request $request)
    {
        // Validate
        $this->validate($request, [
            'nombre' => 'required',
            'descripcion' => 'required',
            'id_area' => 'required',
            'id_tipo' => 'required',
            'id_estado' => 'required',
            'fecha' => 'required',
            'id_centro' => 'required',
        ]);
        $imageData = $request->input('image_data');
        $area = Area::find($request->id_area);
        // Datos del activo
        $coll = new Item();
        $coll->activo_id = $request->nombre;
        $coll->descripcion = $request->descripcion;
        $coll->area_id = $request->id_area;
        $coll->tipo_id = $request->id_tipo;
        $coll->estado_id = $request->id_estado;
        $coll->centro_id = $request->id_centro;
        $coll->modelo = $request->modelo;
        $coll->serie = $request->serie;
        $coll->fecha_compra = $request->fecha;
        //Codigo UPDS
        $tipo = Tipo::find($request->id_tipo);
        $nombreActivo = Activo::find($request->nombre);
        $siglaActivo = strtoupper(substr($nombreActivo->activo, 0, 3));
        $elementosDeActivo = Item::where('area_id', $area->id)->where('activo_id', $request->nombre)->count();
        if ($elementosDeActivo == 0) {
            $num = 1; // Si no hay elementos en el área para el activo, comenzamos en 1.
        } else {
            $num = $elementosDeActivo + 1; // Si hay elementos, incrementamos en 1.
        }
        $coll->codigo = $area->sigla. '.' .$tipo->codigo . '.' . $siglaActivo . '.' . sprintf('%05d', $num);

        //save image file
        if ($imageData) {
            // Obtener la foto tomada por la cámara en formato base64
            $imagenBase64 = $request->input('image_data');
            $imagenCodificadaLimpia = str_replace("data:image/png;base64,", "", urldecode($imagenBase64));
            $nombreImagen = 'camara_' . uniqid() . '.png';
            // Ruta de destino para guardar la imagen
            $rutaImagen = public_path('/img/fotos/' . $nombreImagen);
            // Decodifica la imagen base64 y obtén el tipo de contenido
            $imagenDecodificada = base64_decode($imagenCodificadaLimpia);
            $moved = file_put_contents($rutaImagen, $imagenDecodificada);

            if ($moved) {
                $coll->image = $nombreImagen;
                $coll->save();
            }
        } else {
            $file = $request->file('image');
            $path = public_path() . '/img/fotos';
            $fileName = uniqid() . '-' . $file->getClientOriginalName();
            $moved = $file->move($path, $fileName);
            if ($moved) {
                $coll->image = $fileName;
                $coll->save();
            }
        }
        $coll->save();
        // Redirect
        return redirect('/')->with('success', 'Activo registrado exitosamente');
    }

    public function show($id)
    {
        $item = Item::find($id);
        // Generar el código QR y obtener su contenido en formato PNG
        ob_start();  // Capturar la salida
        QRcode::png(url('vistaQR/' . $item->id));
        $qrImage = ob_get_clean();  // Obtener la salida capturada

        return view('items.show', ['item' => $item, 'qrImage' => $qrImage]);
    }

    public function edit($id)
    {
        $tipoActivo = Tipo::all();
        $analis = Analisis::all();
        // retrieve item
        $estados = Estado::all();
        $item = Item::find($id);
        $activos = Activo::all();
        // retrieve areas
        $areas = Area::all();
        return view('items.edit', compact('estados'))
            ->with('item', $item)
            ->with('analis', $analis)
            ->with('areas', $areas)
            ->with('activos', $activos)
            ->with('tipoActivo', $tipoActivo);
    }

    public function update(Request $request, $id)
    {
        // Validate
        $this->validate($request, [
            'nombre' => 'required',
            'id_area' => 'required'
        ]);

        // Update
        $item = Item::find($id);
        $item->activo_id = $request->nombre;
        $item->descripcion = $request->descripcion;
        $item->estado_id = $request->id_estado;
        $item->centro_id = $request->id_centro;
        $item->modelo = $request->modelo;
        $item->serie = $request->serie;
        if ($item->area_id != $request->id_area) {
            $nomArea = Area::find($request->id_area);
            $movi = new MoveHistory();
            $movi->item_id = $id;
            $movi->descripcion = 'Se movio de '.$item->area->nombre.' a '.$nomArea->nombre;
            $movi->save();
            
            $area = Area::find($request->id_area);
            $tipo = Tipo::find($request->id_tipo);
            $nombreActivo = Activo::find($request->nombre);
            $siglaActivo = strtoupper(substr($nombreActivo->activo, 0, 3));
            // Calcular el valor de $num como el máximo entre $elementosEnArea y $elementosDeTipo
            $elementosDeActivo = Item::where('area_id', $area->id)->where('activo_id', $request->nombre)->count();
            if ($elementosDeActivo == 0) {
                $num = 1; // Si no hay elementos en el área para el activo, comenzamos en 1.
            } else {
                $num = $elementosDeActivo + 1; // Si hay elementos, incrementamos en 1.
            }
            $item->codigo = $area->sigla. '.' .$tipo->codigo . '.' . $siglaActivo . '.' . sprintf('%05d', $num);
        }
        $item->area_id = $request->id_area;
        $item->tipo_id = $request->id_tipo;
        if ($request->fecha_compra != null) {
            $item->fecha_compra = $request->fecha_compra;
        }

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = public_path() . '/img/fotos';
            $fileName = uniqid() . '-' . $file->getClientOriginalName();
            $moved = $file->move($path, $fileName);

            if ($moved) {
                $previousPath = $path . '/' . $item->image;
                $item->image = $fileName;
                $saved = $item->save();

                if ($saved)
                    File::delete($previousPath);
            }
        }
        $item->save();
        // Generar el código QR y obtener su contenido en formato PNG
        ob_start();  // Capturar la salida
        QRcode::png(url('vistaQR/' . $item->id));
        $qrImage = ob_get_clean();  // Obtener la salida capturada
        
        return view('items.show')->with('success', 'Activo actualizado correctamente.')->with('item', $item)->with('qrImage', $qrImage);
    }

    public function destroy(Request $request, $id)
    {
        $item = Item::find($id);
        /*$nombresImagenes = [
            $item->image,
        ];
        
        foreach ($nombresImagenes as $nombreImagen) {
            $rutaImagen = public_path('img\fotos'.$nombreImagen);
            if (File::exists($rutaImagen)) {
                File::delete($rutaImagen);s
            }
        };*/
        if ($request->has('encargado') && $request->has('id_observacion')) {
            $item->user_baja = $request->encargado;
            $item->obserb_id = $request->id_observacion;
            $item->fecha_baja = Carbon::now();
            $item->estado = 0;
            $item->update();
            return redirect('/')->with('success', 'Mueble eliminado correctamente');
        } else {
            return redirect('/')->with('success', 'Error al dar de baja, No agrego todos los datos necesarios');
        }
    }

    public function vistaQR($id)
    {
        $item = Item::find($id);
        if ($item == null) {
            return redirect('/');
        } else { 
            return view('layouts.showqr')->with('item', $item);
        }
    }

    public function printQR(Request $request)
    {
        $coll = Item::find($request->id_item);
        if ($coll->qr_code === null) {
            if ($request->input('image_data')) {
                // Obtener la foto en formato base64
                $imagenBase64 = $request->input('image_data');
                $imagenCodificadaLimpia = str_replace("data:image/png;base64,", "", urldecode($imagenBase64));
                $nombreImagen = 'qr_' . $request->codigo . '.png';
                // Ruta de destino para guardar la imagen
                $rutaImagen = public_path('/img/qr_codes/' . $nombreImagen);
                // Decodifica la imagen base64 y obtén el tipo de contenido
                $imagenDecodificada = base64_decode($imagenCodificadaLimpia);
                $moved = file_put_contents($rutaImagen, $imagenDecodificada);

                if ($moved) {
                    $coll->qr_code = $nombreImagen;
                    $coll->update();
                    $msg = 'Imagen creada correctamente';
                }
            } else {
                $msg = 'Error al crear la imagen';
            }
        } else {
            if ($request->input('image_data')) {
                // Obtener la foto en formato base64
                $imagenBase64 = $request->input('image_data');
                $imagenCodificadaLimpia = str_replace("data:image/png;base64,", "", urldecode($imagenBase64));
                $nombreImagen = 'qr_' . $request->codigo . '.png';
                // Ruta de destino para guardar la imagen
                $rutaImagen = public_path('/img/qr_codes/' . $nombreImagen);
                $path = public_path() . '/img/qr_codes';
                // Decodifica la imagen base64 y obtén el tipo de contenido
                $imagenDecodificada = base64_decode($imagenCodificadaLimpia);
                $moved = file_put_contents($rutaImagen, $imagenDecodificada);
    
                if ($moved) {
                    $previousPath = $path . '/' . $coll->image;
                    $coll->qr_code = $nombreImagen;
                    $saved = $coll->update();
                    if ($saved)
                        File::delete($previousPath);
                    $msg = 'Imagen creada correctamente';
                }
            } else {
                $msg = 'Error al crear la imagen';
            }
        }
        
        return back()->with($msg);
    }

    public function printPDf($nombre)
    {
        $ruta_imagen = public_path('/img/qr_codes/'.$nombre);
        if (File::exists($ruta_imagen))
            return Response::download($ruta_imagen, $nombre);
        else
            abort(404, 'Imagen no encontrada');
    }

    public function history($id)
    {
        $coll = Item::find($id);
        $hitory = MoveHistory::where('item_id', $id)->get();
        return view('items.history')->with('hitory', $hitory)->with('item', $coll);
    }

    public function obtenerActivosPorTipo($tipoId)
    {
        if ($tipoId === 'ningun-activo') {
            return response()->json([]);
        }
        $activos = Activo::where('tipo_id', $tipoId)->get();
        // Devuelve los activos en formato JSON.
        return response()->json($activos);
    }

    public function otroMaterial($id) {
        $area = Area::find($id);
        return view('items.otro_material', compact('area'));
    }

    public function storeMaterial(Request $request) {
        // Validate
        $this->validate($request, [
            'nombre' => 'required',
            'descripcion' => 'required',
            'id_area' => 'required',
        ]);
        $imageData = $request->input('image_data');
        $coll = new OtroMaterial();
        $coll->nombre = $request->nombre;
        $coll->descripcion = $request->descripcion;
        $coll->area_id = $request->id_area;
        if ($imageData) {
            $imagenBase64 = $request->input('image_data');
            $imagenCodificadaLimpia = str_replace("data:image/png;base64,", "", urldecode($imagenBase64));
            $nombreImagen = 'camara_' . uniqid() . '.png';
            $rutaImagen = public_path('/img/otros/' . $nombreImagen);
            $imagenDecodificada = base64_decode($imagenCodificadaLimpia);
            $moved = file_put_contents($rutaImagen, $imagenDecodificada);
            if ($moved) {
                $coll->image = $nombreImagen;
                $coll->save();
            }
        } else {
            $file = $request->file('image');
            $path = public_path() . '/img/otros';
            $fileName = uniqid() . '-' . $file->getClientOriginalName();
            $moved = $file->move($path, $fileName);
            if ($moved) {
                $coll->image = $fileName;
                $coll->save();
            }
        }
        $coll->save();
        return redirect('/')->with('success', 'Material registrado exitosamente');
    }

    public function showMaterial($id) {
        $otro = OtroMaterial::find($id);
        return view('otros_materiales.show', compact('otro'));
    }
    
    public function editMaterial($id) {
        $material = OtroMaterial::find($id);
        return view('otros_materiales.edit', compact('material'));
    }

    public function updateMaterial(Request $request, $id) {
        // Validate
        $this->validate($request, [
            'nombre' => 'required',
            'descripcion' => 'required',
            'id_area' => 'required',
        ]);
        // Update
        $item = OtroMaterial::find($id);
        $item->nombre = $request->nombre;
        $item->descripcion = $request->descripcion;
        $item->area_id = $request->id_area;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = public_path() . '/img/otros';
            $fileName = uniqid() . '-' . $file->getClientOriginalName();
            $moved = $file->move($path, $fileName);
            if ($moved) {
                $previousPath = $path . '/' . $item->image;
                $item->image = $fileName;
                $saved = $item->save();
                if ($saved)
                    File::delete($previousPath);
            }
        }
        $item->save();
        return view('otros_materiales/show')->with('success', 'Activo actualizado correctamente.')->with('otro', $item);
    }

    public function descargarMaterial($id)
    {
        $material = OtroMaterial::where('area_id', $id)->get();
        $csvContent = "Num;Nombre;Descripcion;Area\n";
        $contador = 1;

        foreach ($material as $row) {
            $nombre = str_replace('"', '', $row->nombre);
            $descripcion = str_replace('"', '', $row->descripcion);
            $area = str_replace('"', '', $row->area->nombre);
            $csvContent .= "$contador;$nombre;$descripcion;$area\n";
            $contador++;
        }

        // Descarga el archivo CSV
        $fileName = 'otros_materiales.csv';
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename=' . $fileName);
        echo $csvContent;
        exit;
    }
}
