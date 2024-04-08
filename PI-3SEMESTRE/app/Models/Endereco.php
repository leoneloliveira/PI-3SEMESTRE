<?php

namespace App\Models;



class Endereco extends RModel
{
    protected $table = "ENDERECO";
    protected $primaryKey = 'ENDERECO_ID';
    protected $fillable = ['ENDERECO_NOME','ENDERECO_LOGRADOURO','ENDERECO_NUMERO','ENDERECO_COMPLEMENTO','ENDERECO_CEP','ENDERECO_CIDADE','ENDERECO_ESTADO','USUARIO_ID',];
    public $timestamps = false;
}
