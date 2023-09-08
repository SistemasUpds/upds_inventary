<?php

namespace App\Http\Controllers;

use App\Area;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->admin) {
            $user = User::find(auth()->user()->id);
            $areas = Area::all();
            return view('home')->with('areas', $areas)->with('user', $user);
        }
        return view('welcome');
    }

    public function sinPermiso() {
        return view('errors.permiso');
    }
}
