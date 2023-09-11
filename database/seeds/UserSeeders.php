<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' =>'Super Usuario',
            'email' => 'Super.User@gmail.com',
            'password' => bcrypt('SuperUser.'),
            'admin' => true,
            'tipo_user' => '1',
        ]);
        User::create([
            'name' =>'Administrador',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('AdminUpds.'),
            'admin' => true,
            'tipo_user' => '2',
        ]);
        User::create([
            'name' =>'Usuario1 UPDS',
            'email' => 'usuario1.upds@gmail.com',
            'password' => bcrypt('UsuarioUpds1'),
            'admin' => false,
            'tipo_user' => '0',
        ]);
    }
}
