<?php

namespace App\Http\Controllers;

use App\Area;
use App\Item;
use App\Observacion;
use App\OtroMaterial;
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
            'descripcion' => 'required',
            'sigla' => 'required',
        ]);

        // Store
        $coll = new Area();
        $coll->nombre = $request->nombre;
        $coll->descripcion = $request->descripcion;
        $coll->encargado = $request->encargado;
        $areaSigla = Area::all();
        foreach ($areaSigla as $item) {
            if ($request->sigla ==  $item->sigla) {
                return back()->with('success', 'La sigla ya existe debe de ser Unica.');
            }
        }
        $coll->sigla = $request->sigla;
        $coll->save();
        return redirect('/')->with('success', 'Registrado con éxito.');
    }

    public function show($id)
    {
        $user = User::find(auth()->user()->id);
        $tipo = Tipo::all();
        $area = Area::find($id);
        $obser = Observacion::all();
        $otro = OtroMaterial::where('area_id', $id)->get();
        $cantidad = count($otro);
        return view('areas.show', compact('otro', 'area', 'tipo', 'user', 'obser', 'cantidad'));
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
            'descripcion' => 'required',
        ]);

        // Update
        $coll = Area::find($id);
        $coll->nombre = $request->nombre;
        $coll->encargado = $request->encargado;
        $coll->descripcion = $request->descripcion;
        $areaSigla = Area::all();
        if ($coll->sigla != $request->sigla) {
            foreach ($areaSigla as $item) {
                if ($request->sigla ==  $item->sigla ) {
                    return back()->with('success', 'La sigla ya existe debe de ser Unica.');
                }
            }
        }
        $coll->sigla = $request->sigla;
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

    public function createActivo() {
        $tipos = Tipo::all();
        return view('activo.create', compact('tipos'));
    }

    public function storeActivo(Request $request) {
        // Validate
        $this->validate($request, [
            'nombre' => 'required',
            'id_tipo' => 'required'
        ]);
        $coll = new Area();
        $coll->activo = $request->nombre;
        $coll->tipo_id = $request->id_tipo;
        $coll->save();
        return redirect('/')->with('success', 'Registrado con éxito el activo.');
    }

}
