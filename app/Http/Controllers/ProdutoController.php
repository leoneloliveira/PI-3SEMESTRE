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
           $carrinhoItem = ItemCarrinho::where('USUARIO_ID', $user->USUARIO_ID)
               ->where('PRODUTO_ID', $produtoId)
               ->first();
           if ($carrinhoItem) {
               $carrinhoItem->ITEM_QTD += 1; 
               $carrinhoItem->save();
           } else {
               ItemCarrinho::create([
                   'USUARIO_ID' => $user->USUARIO_ID,
                   'PRODUTO_ID' => $produtoId,
                   'ITEM_QTD' => 1 
               ]);
           }
           return redirect()->route('ver_carrinho')->with('success', 'Produto adicionado ao carrinho.');
       } else {
           // Se o usuário não estiver autenticado, redirecione para a página de login
           return redirect()->route('logar')->with('error', 'Você precisa fazer login para adicionar produtos ao carrinho.');
       }
   }
   



   public function verCarrinho()
{
    // Verifique se o usuário está autenticado
    if (auth()->check()) {
        // Recupere os itens do carrinho do usuário autenticado
        $categorias = Categoria::all();

        $carrinhoItens = ItemCarrinho::with('produto.imagens') // Carregar dados do produto e da imagem
            ->where('USUARIO_ID', auth()->user()->USUARIO_ID)
            ->get();

        // Verifique se os dados estão sendo recuperados corretamente
        // dd($carrinhoItens);

        return view('carrinho', compact('carrinhoItens', 'categorias'));
    } else {
        // Lógica para lidar com o usuário não autenticado, por exemplo, redirecionar para a página de login
        return redirect()->route('logar')->with('error', 'Você precisa estar logado para visualizar o carrinho.');
    }
}






public function excluirCarrinho($carrinhoItemId)
{
    $carrinhoItem = ItemCarrinho::find($carrinhoItemId);
    if ($carrinhoItem) {
        $carrinhoItem->delete();
    }
    return redirect()->route('ver_carrinho')->with('success', 'Produto removido do carrinho.');
}






public function finalizar(Request $request)
{
    $prods = session('carrinho', []);
    $vendaServico = new VendaService(); // Corrigi o nome da variável

    // Substitua \Auth::user() pelo método correto para obter o usuário autenticado
    $user = Auth::user(); // Supondo que você esteja usando o modelo padrão de usuário do Laravel

    $result = $vendaServico->finalizarVenda($prods, $user); // Corrigi o nome da variável

    if ($result["status"] == "ok") {
        $request->session()->forget("carrinho");
    }

    $request->session()->flash($result["status"], $result["message"]); // Corrigi o nome da variável

    return redirect()->route('ver_carrinho');
}








    public function historico(Request $request){
        $data = [];

        $idusuario = \Auth::user()->USUARIO_ID;
        $listaPedido = Pedido::where("USUARIO_ID", $idusuario)
        ->orderBy("PEDIDO_DATA", "desc")
        ->get();
        $data["lista"] = $listaPedido;



        return view("compra/historico",$data);


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



}