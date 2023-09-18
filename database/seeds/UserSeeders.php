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
            'name' =>'Brayan Mendez Colque',
            'email' => 'Super.User@gmail.com',
            'password' => bcrypt('SuperUser.'),
            'admin' => true,
            'tipo_user' => '1',
        ]);
        User::create([
            'name' =>'Admin Rolando Yucra',
            'email' => 'rolando.yucra@gmail.com',
            'password' => bcrypt('RolandoYucra*123'),
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
