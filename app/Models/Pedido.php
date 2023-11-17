<?php

namespace App\Models;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;


class Pedido extends RModel
{
    
        use HasFactory;
    
        public $timestamps = false;
        protected $table = 'PEDIDO'; 
        protected $fillable = [
            'USUARIO_ID' ,
'ENDERECO_ID',
'STATUS_ID' ,
'PEDIDO_DATA',
        ];
        protected $primaryKey = 'PEDIDO_ID'; 
      
    
        public function endereco()
        {
            return $this->belongsTo(Endereco::class, 'ENDERECO_ID');
        }       
    }
    

