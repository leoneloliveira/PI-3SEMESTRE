<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Endereco;
use App\Services\ClienteService;

class ClienteController extends Controller
{
     public function cadastrar(Request $request){
        $data = [];
 
        return view("cadastrar", $data);
     }
     public function cadastrarCliente(Request $request)
     {
         $values = $request->all();
     
         $usuario = new User();
         $usuario->fill($values);

         $senha =  $request->input("USUARIO_SENHA","");


         
               $usuario->USUARIO_SENHA = Hash::make($senha);

               if ($usuario->save()) {

                  $endereco = new Endereco();
                  $endereco->fill($values);

                  $usuario->endereco()->save($endereco);

                  return redirect()->route("logar");
               } else {
                  $data["erro"] = "Erro ao cadastrar o cliente";
                  return view("cadastrar", $data);
               }


                $clienteService = new ClienteService();
                $result = $clienteService->salvarUsuario($usuario, $endereco);

                $message = $result["message"];
                $status = $result["status"];

                $request->session()->flash($status, $message);
     
             return redirect()->route("cadastrar");
     }
     

     
     
}
