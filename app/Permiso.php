<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    protected $table = "permisos";
    protected $primaryKey = "id";
    protected $fillable = ['user_id', 'dar_baja_item', 'crear_user', 'exportar', 'editar_area', 'borrar_area'];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
