<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Categoria;
use App\Models\Produto;
use App\Models\Imagem;
use App\Models\ItemCarrinho;
use App\Services\VendaService;
use App\Models\Pedido;
use App\Models\PedidoItem;

class ProdutoController extends Controller
{
   public function index(Request $request)
   {
       $data = [];
      
       // Carregue a lista de produtos
       $listaProdutos = Produto::all();  
       
       // Carregue as imagens associadas aos produtos
       $listaProdutos->load('imagens');
       
       $data["lista"] = $listaProdutos;

       return view("home", $data);
   }

  




   public function categoria(Request $request, $idcategoria = 0)
   {
       $data = [];
       $listaCategoria = Categoria::all();
       $queryProduto = Produto::limit(27);
   
       if ($idcategoria != 0) {
           $queryProduto->where("categoria_id", $idcategoria);
       }
   
       $listaProdutos = $queryProduto->get();
       $data["lista"] = $listaProdutos;
       $data["listaCategoria"] = $listaCategoria;
       $data["idcategoria"] = $idcategoria;
   
       return view("categoria", $data);
   }


   

   public function adicionarCarrinho(Request $request, $produtoId)
   {
       if (auth()->check()) {
           $user = auth()->user();
          
   
           // Remover o produto da lista de itens removidos se estiver presente
           $carrinhoItensRemovidos = session('carrinhoItensRemovidos', []);
           $carrinhoItensRemovidos = array_diff($carrinhoItensRemovidos, [$produtoId]);
           session(['carrinhoItensRemovidos' => $carrinhoItensRemovidos]);
   
           $carrinhoItem = ItemCarrinho::where('USUARIO_ID', $user->USUARIO_ID)
    ->where('PRODUTO_ID', $produtoId)
    ->first();

if (!$carrinhoItem) {
    ItemCarrinho::create([
        'USUARIO_ID' => $user->USUARIO_ID,
        'PRODUTO_ID' => $produtoId,
        'ITEM_QTD' => 1
    ]);
} else {
    // Se o item já existe no carrinho, incrementa a quantidade apenas para o produto específico
    $carrinhoItem->increment('ITEM_QTD');
}

           
   
           return redirect()->route('ver_carrinho')->with('success', 'Produto adicionado ao carrinho.');
       } else {
           // Lógica para lidar com o usuário não autenticado, por exemplo, redirecionar para a página de login
           return redirect()->route('logar')->with('error', 'Você precisa fazer login para adicionar produtos ao carrinho.');
       }
   }
   

   public function verCarrinho()
   {
       // Verifique se o usuário está autenticado
       if (auth()->check()) {
        // Recupere todos os itens do carrinho do usuário autenticado
        $categorias = Categoria::all();

        $carrinhoItens = ItemCarrinho::with('produto.imagens')
        ->where('USUARIO_ID', auth()->user()->USUARIO_ID)
        ->get()
       ->reject(function ($item) {
                   // Rejeita os itens marcados como removidos na sessão
                   return in_array($item->PRODUTO_ID, session('carrinhoItensRemovidos', []));
               });
   
 return view('carrinho', compact('carrinhoItens', 'categorias'));
       } else {
           // Lógica para lidar com o usuário não autenticado, por exemplo, redirecionar para a página de login
           return redirect()->route('logar')->with('error', 'Você precisa estar logado para visualizar o carrinho.');
       }
   }
   
   
   
   
   
   public function excluirCarrinho($produtoId)
   {
       
   
       // Atualize a quantidade do produto para 0 no carrinho_item
       ItemCarrinho::where('USUARIO_ID', auth()->id())
                   ->where('PRODUTO_ID', $produtoId)
                   ->update(['ITEM_QTD' => 0]);
   
       // Adicione o produto à lista de itens removidos na sessão
       $carrinhoItensRemovidos = session('carrinhoItensRemovidos', []);
       $carrinhoItensRemovidos[] = $produtoId;
   
       // Atualize a lista de itens removidos na sessão
       session(['carrinhoItensRemovidos' => $carrinhoItensRemovidos]);
   
       return redirect()->route('ver_carrinho')->with('success', 'Produto removido do carrinho.');
   }
   


   public function atualizarQuantidade(Request $request)
   {
       // Valide a solicitação conforme necessário
   
       // Obtenha os dados da solicitação
       $produtoId = $request->input('produto_id');
       $novaQuantidade = $request->input('nova_quantidade');
   
       // Lógica para atualizar a quantidade no banco de dados
       $user = auth()->user();
   
       $itemCarrinho = ItemCarrinho::where('PRODUTO_ID', $produtoId)
           ->where('USUARIO_ID', $user->USUARIO_ID)
           ->first();
   
       if ($itemCarrinho) {
           $itemCarrinho->update(['ITEM_QTD' => $novaQuantidade]);
   
           // Redirecione de volta à página do carrinho ou faça qualquer outra ação necessária
           return redirect()->route('ver_carrinho')->with('success', 'Quantidade atualizada com sucesso.');
       }
   
       // Lida com a falha na atualização
       return redirect()->route('ver_carrinho')->with('error', 'Falha na atualização da quantidade.');
   }
   


   
   

   


  
   public function finalizar(Request $request)
   {
       try {
           $user = Auth::user();
           $endereco = $user->endereco;
   
           $vendaServico = new VendaService();
   
           // Obter itens do carrinho, excluindo os itens removidos
           $carrinhoItens = ItemCarrinho::with('produto.imagens')
               ->where('USUARIO_ID', auth()->user()->USUARIO_ID)
               ->get()
               ->reject(function ($item) {
                   return in_array($item->PRODUTO_ID, session('carrinhoItensRemovidos', []));
               });
   
           $prods = [];
   
           foreach ($carrinhoItens as $carrinhoItem) {
               $prods[] = [
                   'quantidade' => $carrinhoItem->ITEM_QTD,
                   'ITEM_PRECO' => $carrinhoItem->produto->PRODUTO_PRECO,
                   'PRODUTO_ID' => $carrinhoItem->produto->PRODUTO_ID,
               ];
   
               // Atualizar a quantidade para zero no banco
               $carrinhoItem->update(['ITEM_QTD' => 0]);
           }
   
           // Obter apenas os itens que não foram marcados como removidos
           $carrinhoItensExibicao = $carrinhoItens->reject(function ($item) {
               return $item->ITEM_QTD == 0;
           });
   
           $result = $vendaServico->finalizarVenda($prods, $user, $endereco);
   
           $request->session()->flash($result["status"], $result["message"]);
       } catch (\Throwable $e) {
           \Log::error("ERRO: Venda não pode ser finalizada", [
               'message' => $e->getMessage(),
               'trace' => $e->getTraceAsString(),
           ]);
   
           throw $e;
       }
   
       return view('carrinho')->with('carrinhoItens', $carrinhoItensExibicao);
   }
   
   
   
   
   
   
   
   
  



   








public function historico(Request $request)
{
    $data = [];

    $idusuario = Auth::user()->USUARIO_ID;
    $listaPedido = Pedido::where("USUARIO_ID", $idusuario)
        ->orderBy("PEDIDO_DATA", "desc")
        ->get();
    $data["lista"] = $listaPedido;

    return view("compra/historico", $data);
}





public function detalhes(Request $request) {
    $idpedido = $request->input("idpedido");

    $listaItens = PedidoItem::join("PRODUTO", "PRODUTO_ID", "=", "itens_pedidos_produto_id")
    ->where("PEDIDO_ID", $idpedido)
    ->get(["itens_pedido", "itens_pedidos.valor as valoritem", "PRODUTO_NOME", "ITEM_QTD"]);

$data = [];
$data["listaItens"] = $listaItens;

return view("compra/detalhes",$data);
}












public function mostrarResultados(Request $request)
{
    $searchTerm = $request->input('search');
    
    // Lógica para buscar os resultados com base no termo de pesquisa
    $resultadosProdutos = Produto::where('PRODUTO_NOME', 'like', '%' . $searchTerm . '%')->get();
    $resultadosCategorias = Categoria::where('CATEGORIA_NOME', 'like', '%' . $searchTerm . '%')->get();

    // Você pode adicionar mais lógica para buscar em outros modelos se necessário

    return view('resultados', [
        'resultadosProdutos' => $resultadosProdutos,
        'resultadosCategorias' => $resultadosCategorias,
    ]);
}

public function mostrarDetalhes($id)
    {
        $produto = Produto::find($id);

        return view('detalhesProdutos', ['produto' => $produto]);
    }



}