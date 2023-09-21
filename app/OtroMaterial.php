<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OtroMaterial extends Model
{
    protected $table = "otro_materials";
    protected $primaryKey = "id";
    protected $fillable = ['nombre', 'area_id', 'descripcion', 'image'];

    public function area()
    {
        return $this->belongsTo(Area::class);
    }
}
