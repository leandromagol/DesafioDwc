<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedidos_Brinde extends Model
{
    //
    protected $table = 'pedidos_brindes';
      protected $fillable = [
      'email', 'token'
      ];

}
