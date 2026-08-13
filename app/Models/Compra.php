<?php

namespace App\Models;

use App\Core\Model;

class Compra extends Model
{
    protected $table = 'compras';
    
    protected $fillable = [
        'fornecedor_id',
        'data_compra',
        'total',
        'status'
    ];
}
