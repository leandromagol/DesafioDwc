<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    //
    protected $table = 'clientes';
      protected $fillable = [
      'email', 'nome','cidade','uf','cep','numero','logradouro','telefone'
      ,'enviado'];
}
