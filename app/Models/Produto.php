<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'PRODUTO'; 

    protected $primaryKey = 'PRODUTO_ID'; 
  

    public function imagens()
    {
        return $this->hasMany(Imagem::class, 'PRODUTO_ID');
    }

    public function categoria() {
        return $this->belogsTo(Categoria::class, 'CATEGORIA_ID');
    }
}
