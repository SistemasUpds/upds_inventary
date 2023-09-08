<?php

namespace App\Http\Controllers;

use App\Area;
use App\Item;
use App\Observacion;
use App\Tipo;
use App\User;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
//use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AreaController extends Controller
{
    public function index()
    {
        $areas = Area::all();
        return view('home')->with('areas', $areas);
    }

    public function create()
    {
        return view('areas.create');
    }

    public function store(Request $request)
    {
        // Validate
        $this->validate($request, [
            'nombre' => 'required',
            'encargado' => 'required',
            'descripcion' => 'required'
        ]);

        // Store
        $coll = new Area();
        $coll->nombre = $request->nombre;
        $coll->descripcion = $request->descripcion;
        $coll->encargado = $request->encargado;
        $coll->save();
        return redirect('/')->with('success', 'Registrado con éxito.');
    }

    public function show($id)
    {
        $user = User::find(auth()->user()->id);
        $tipo = Tipo::all();
        $area = Area::find($id);
        $obser = Observacion::all();
        return view('areas.show')->with('area', $area)->with('tipo', $tipo)->with('user', $user)->with('obser', $obser);
    }

    public function edit($id)
    {
        $area = Area::find($id);
        return view('areas.edit')->with('area', $area);
    }

    public function update(Request $request, $id)
    {
        // Validate
        $this->validate($request, [
            'nombre' => 'required',
            'encargado' => 'required',
            'descripcion' => 'required'
        ]);

        // Update
        $coll = Area::find($id);
        $coll->nombre = $request->nombre;
        $coll->encargado = $request->encargado;
        $coll->descripcion = $request->descripcion;
        $coll->update();

        // Redirect
        return redirect('/')->with('success', 'Area actualizada con éxito.');
    }

    public function destroy($id)
    {
        $area = Area::find($id);
        $area->delete();
        return redirect('/')->with('success', 'Area eliminada con éxito');
    }

    
    /*public function generarPDF(Request $request)
    {
        
        
        $pdf = PDF::loadView('areas.pdf', compact('datosFiltrados', 'area'));
        return $pdf->download('Reporte.pdf');
    }*/

    public function generarPDF(Request $request)
    {
        $area = Area::find($request->area);
        if ($request->input('id_tipo') == '00') {
            $datosFiltrados = Item::where('area_id', $request->area)->get();
        } elseif ($request->has('id_tipo')) {
            $categoriaSeleccionada = $request->input('id_tipo');
            $datosFiltrados = Item::where('tipo_id', $categoriaSeleccionada)->where('area_id', $request->area)->get();
        } else {
            $datosFiltrados = Item::where('area_id', $request->area)->get();
        }

        // Construir el contenido del archivo CSV
        $csvContent = "Num;Codigo;Activo;Tipo de activo;Centro de Analisis;Fecha de compra;Descripcion;Fecha de baja;Estado;Observacion\n";
        $contador = 1;

        foreach ($datosFiltrados as $row) {
            $codigo = str_replace('"', '', $row->codigo);
            $activo = str_replace('"', '', $row->nombre);
            $tipoActivo = '';
            if ($row->tipo) {
                $tipoActivo = str_replace('"', '', $row->tipo->nombre);
            }
            $centro = '';
            if ($row->centro) {
                $centro = str_replace('"', '', $row->centro->centro_analisis);
            }
            $fechaCompra = str_replace('"', '', Carbon::parse($row->fecha_compra)->format('d/m/Y'));
            $descripcion = str_replace('"', '', $row->descripcion);
            $fechaBaja = '';
            if ($row->fecha_baja) {
                $fechaBaja = str_replace('"', '', $row->fecha_baja);
            }
            $estado = ($row->estado != 0) ? 'Activo' : 'Inactivo';
            $observacion = '';
            if ($row->observacion) {
                $observacion = str_replace('"', '', $row->observacion->observacion);
            }
            $csvContent .= "$contador;$codigo;$activo;$tipoActivo;$centro;$fechaCompra;$descripcion;$fechaBaja;$estado;$observacion\n";
            $contador++;
        }

        // Descarga el archivo CSV
        $fileName = 'archivo.csv';
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename=' . $fileName);
        echo $csvContent;
        exit;
    }

}