<?php

namespace App\Services;

use App\Models\User;
use App\Models\Endereco;
use Log;

class ClienteService 
{

    public function salvarUsuario(User $user, Endereco $endereco){    

        try {
            $user->save();

            $endereco->USUARIO_ID = $user->id;
            $endereco->save();

            Log::info('Usuário salvo com sucesso!', ['id' => $user->id]);
            return ['success' => true, 'message' => 'Usuário salvo com sucesso!'];
        } catch (\Exception $e) {
            Log::error('Erro ao salvar usuário.', ['error' => $e->getMessage()]);
            return ['success' => false, 'message' => 'Erro ao salvar usuário. Por favor, tente novamente.'];
        }
    }
}