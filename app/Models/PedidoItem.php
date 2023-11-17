<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class PedidoItem extends RModel
{
    use HasFactory;
    
    public $timestamps = false;
    protected $table = 'PEDIDO_ITEM'; 
    protected $fillable = [
        'PRODUTO_ID ',
        ' PEDIDO_ID',       
        'ITEM_QTD',
        'ITEM_PRECO',
    ];
    protected $primaryKey = ' PEDIDO_ID'; 
}
