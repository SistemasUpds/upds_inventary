<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MoveHistory extends Model
{
    protected $table = "move_histories";
    protected $primaryKey = "id";
    protected $fillable = ['item_id', 'descripcion', 'movimiento'];

    public function elemento()
    {
      return $this->belongsTo(Item::class, 'area_id');
    }
}
