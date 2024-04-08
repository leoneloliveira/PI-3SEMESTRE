<?php

namespace App\Services;

use App\Models\User;
use App\Models\Pedido;
use App\Models\PedidoItem;
use App\Models\Endereco;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class VendaService
{
    const STATUS_KEY = 'status';
    const MESSAGE_KEY = 'mensagem';

    public function finalizarVenda(array $prods, User $user, Endereco $endereco)
    {
        try {
          
            return $this->finalizarVendaTransacional($prods, $user, $endereco);
        } catch (\Throwable $e) {
            Log::error("ERRO: SERVIÇO DE VENDA", [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            throw $e;
        }
    }

    private function finalizarVendaTransacional(array $prods, User $user, Endereco $endereco)
    {
        return DB::transaction(function () use ($prods, $user, $endereco ) {
            $pedido = new Pedido();
            $pedido->PEDIDO_DATA = now();
            $pedido->STATUS_ID = 1;
            $pedido->USUARIO_ID = $user->USUARIO_ID;
            $pedido->ENDERECO_ID = $endereco->ENDERECO_ID;
                     
            $pedido->save();

            if (empty($prods)) {
                
                return ['status' => 'err', 'message' => 'Nenhum produto válido para finalizar a venda'];
            }

            foreach ($prods as $p) {
                $quantidadeEscolhida = $p['quantidade'];

                $item = new PedidoItem();
                $item->ITEM_QTD = $quantidadeEscolhida;
                $item->ITEM_PRECO = $p['ITEM_PRECO'];
                $item->PRODUTO_ID = $p['PRODUTO_ID'];
                $item->pedido()->associate($pedido);
                $item->save();
            }          

            return ['status' => 'ok', 'message' => 'Venda finalizada com sucesso'];
        });
    }
}
