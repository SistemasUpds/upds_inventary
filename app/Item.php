<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = "items";
    protected $primaryKey = "id";
    protected $fillable = ['tipo_id', 'image', 'novus','obserb_id', 'centro_id','activo_id', 'area_id', 'estado', 'qr_code', 'descripcion', 'codigo', 'fecha_compra', 'fecha_baja', 'user_baja'];

    public function area()
    {
      return $this->belongsTo(Area::class);
    }
    
    public function tipo()
    {
      return $this->belongsTo(Tipo::class);
    }

    public function activo()
    {
      return $this->belongsTo(Activo::class);
    }
    
    public function centro()
    {
      return $this->belongsTo(Analisis::class, 'centro_id');
    }
    
    public function Observacion()
    {
      return $this->belongsTo(Observacion::class, 'obserb_id');
    }
}
