<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'PEDIDO';
    protected $fillable = ['PEDIDO_DATA', 'STATUS_ID', 'USUARIO_ID'];
    protected $primaryKey = 'PEDIDO_ID';

    public function endereco()
    {
        return $this->belongsTo(Endereco::class, 'ENDERECO_ID');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($pedido) {
            $pedido->clearCart();
        });
    }

    public function clearCart()
    {
        $this->carrinhoItens()->update(['ITEM_QTD' => 'finalizado']);
    }

    public function carrinhoItens()
    {
        return $this->hasMany(ItemCarrinho::class, 'PRODUTO_ID');
    }
    


    public function produto()
    {
        return $this->belongsTo(Produto::class, 'PRODUTO_ID');

    }







   
}
