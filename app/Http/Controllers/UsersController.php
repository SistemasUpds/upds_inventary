<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Permiso;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{

    public function index() {
        $users = User::all();
        $userAuth = User::find(auth()->user()->id);
        return $userAuth->permiso->crear_user == 1 ? view('users.index')->with('users', $users) : redirect('/admin/error');
    }

    public function create() {
        $userAuth = User::find(auth()->user()->id);
        return $userAuth->permiso->crear_user == 1 ? view('users.create') : redirect('/admin/error');
    }

    public function store(Request $request) {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'admin' => true,
        ]);

        $permiso = Permiso::updateOrCreate(['user_id' => $user->id]);
        $permiso->save();
        return redirect('admin/users');
    }

    public function show($id) {
        $user = User::find($id);
        $permisos = Permiso::where('user_id', $user->id)->first();
        return view('users.show', compact('user', 'permisos'));
    }
    
    public function edit($id) {
        $edit = User::find($id);
        $permisos = Permiso::where('user_id', $edit->id)->first();
        $userAuth = User::find(auth()->user()->id);
        return $userAuth->permiso->crear_user == 1 ? view('users.edit', compact('edit', 'permisos')) : redirect('/admin/error');
    }

    public function update(Request $request, $id) {
        $user = User::find($id); // Reemplaza esto con la forma adecuada de obtener el ID de usuario
        $user->name = $request->name;
        $user->email = $request->email;
        $user->update();
        // Obtener los permisos seleccionados
        $permisosSeleccionados = $request->input('permisos', []);

        // Guardar los permisos en la base de datos
        $permiso = Permiso::updateOrCreate(
            ['user_id' => $id], // Buscar el permiso por el ID de usuario
            [
                'dar_baja_item' => in_array('dar_baja_item', $permisosSeleccionados),
                'crear_user' => in_array('crear_user', $permisosSeleccionados),
                'exportar' => in_array('exportar', $permisosSeleccionados),
                'editar_area' => in_array('editar_area', $permisosSeleccionados),
                'borrar_area' => in_array('borrar_area', $permisosSeleccionados),
            ]
        );
        $permiso->save();
        return redirect('admin/users')->with('success', 'Cuenta de usuario actualizado');
    }

    public function destroy($id) {
        $user = User::find($id);
        //$permiso = Permiso::where('user_id', $user->id);
        //$permiso->delete();
        $user->estado = 'I';
        $user->admin = false;
        $user->update();
        $userAuth = User::find(auth()->user()->id);
        return $userAuth->tipo_user == 1 ? back()->with('success', 'Se dio de baja la Cuenta') : redirect('/admin/error');
    }

    public function activarCuenta($id) {
        $user = User::find($id);
        $user->estado = 'A';
        $user->admin = true;
        $user->update();
        $userAuth = User::find(auth()->user()->id);
        return $userAuth->tipo_user == 1 ? back()->with('success', 'Se activo la Cuenta') : redirect('/admin/error');
    }

    public function viewResetPassword($id) {
        $user = User::find($id);
        return view('users.reset', compact('user'));
    }

    public function resetPassword($id, Request $request) {
        $user = User::find($id);
        $user->password = Hash::make($request->password);
        $user->update();
        return redirect('admin/users')->with('success', 'Se restablecio la contraseña');
    }
}
