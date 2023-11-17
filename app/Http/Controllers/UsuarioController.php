<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse; 
use App\Models\User;

class UsuarioController extends Controller
{
    
    public function showLoginForm()
{
    
    return view('logar'); 
}

public function logar(Request $request): RedirectResponse
{
    $usuario = User::where('USUARIO_EMAIL', $request->USUARIO_EMAIL)->first();


    if (Hash::check($request->USUARIO_SENHA, $usuario->USUARIO_SENHA)) {
        Auth::login($usuario);
        return redirect("/");
    } else {
       
        return redirect("/logar");
    }
}

public function sair(Request $request){

    Auth::logout();
    return redirect()->route("home");

}



}



