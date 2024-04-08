<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidoItem extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'PEDIDO_ITEM';
    protected $fillable = [
        'PRODUTO_ID',
        'PEDIDO_ID',
        'ITEM_QTD',
        'ITEM_PRECO',
    ];
    protected $primaryKey = 'PRODUTO_ID';

    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'PEDIDO_ID');
    }
}
