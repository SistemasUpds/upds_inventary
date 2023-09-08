<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeders::class);
        $this->call(AreasSeeders::class);
        $this->call(TipoSeeders::class);
        $this->call(EstadoSeeders::class);
        $this->call(ActivoSeeders::class);
        $this->call(PermisoSeeders::class);
        $this->call(ObservacionSeeders::class);
        $this->call(AnalisiSeeders::class);
        // $this->call(UsersTableSeeder::class);
    }
}
