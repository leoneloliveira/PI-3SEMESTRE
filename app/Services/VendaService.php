<?php

namespace App\Services;

use App\Models\User;
use App\Models\Pedido;
use App\Models\PedidoItem;
use App\Models\Endereco;

class VendaService
{
    public function finalizarVenda($prods = [], User $user, Endereco $endereco = null)
    {
        try {
            \DB::beginTransaction();

            $pedido = new Pedido();

            $pedido->PEDIDO_DATA = now()->format("Y-m-d");
            $pedido->STATUS_ID = "PEN";
            $pedido->USUARIO_ID = $user->id;

            if ($endereco) {
                $pedido->endereco()->associate($endereco);
            }

            $pedido->save();

            foreach ($prods as $p) {
                $item = new PedidoItem;

                $item->ITEM_QTD = 1;
                $item->ITEM_PRECO = $p->ITEM_PRECO;
                $item->PEDIDO_DATA = now()->format("Y-m-d");
                $item->PRODUTO_ID = $p->PRODUTO_ID;
                $item->pedido()->associate($pedido);

                $item->save();
            }

            \DB::commit();
            return ['status' => 'ok', 'message' => 'Venda finalizada com sucesso'];
        } catch (\Exception $e) {
            \DB::rollback();
            \Log::error("ERRO: VENDA SERVICE", ['message' => $e->getMessage()]);
            return ['status' => 'err', 'message' => 'Venda não pode ser finalizada'];
        }
    }
}
