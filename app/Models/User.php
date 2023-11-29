<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = "USUARIO";
    protected $fillable = ['USUARIO_NOME', 'USUARIO_EMAIL', 'USUARIO_SENHA', 'USUARIO_CPF'];
    public $timestamps = false;

     protected $primaryKey = "USUARIO_ID";

    protected $hidden = ['USUARIO_SENHA'];


    public function itemCarrinho()
    {
        return $this->hasMany(ItemCarrinho::class, 'USUARIO_ID');
    }
 
   // Relação indicando que um usuário tem um endereço
   public function endereco()
   {
       
      
// Especifique explicitamente o nome da chave estrangeira se for diferente de 'USUARIO_ID'
       return $this->hasOne(Endereco::class, 'USUARIO_ID');
   }


   public function itens()
   {
       return $this->hasMany(ItemCarrinho::class, 'USUARIO_ID');
   }
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    /*protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];*/
}
