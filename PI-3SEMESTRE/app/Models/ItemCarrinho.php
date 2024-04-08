<?php



namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class ItemCarrinho extends RModel
{
    use HasFactory;
    protected $table = "CARRINHO_ITEM";
    protected $primaryKey = 'PRODUTO_ID';
   
    
    public $timestamps = false;
    protected $fillable = [
            'USUARIO_ID',
            'PRODUTO_ID',
            'ITEM_QTD',
        ];

    public function produto()
    {
        return $this->belongsTo(Produto::class, 'PRODUTO_ID');
    }

  

    public function usuario()
    {
        return $this->belongsTo(User::class, 'USUARIO_ID');
    }
    

    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'PRODUTO_ID');
    }
    
  

  

}



