


@extends("layout")
@section("conteudo")
<div class="d-flex justify-content-between align-items-center flex-wrap">
    <h1>Carrinho</h1>
</div>
    <div class="table-responsive mt-5">
        <table class="table">
            <thead class="thead-dark mt-5">
                <tr>
                    <th style="width: 5%"></th> <!-- Coluna vazia para o botão "Carrinho" -->
                    <th style="width: 15%">Nome</th>
                    <th style="width: 10%">Foto</th>
                    <th style="width: 8%">Valor</th>
                    <th style="width: 40%">Descrição</th>
                </tr>
            </thead>
            <tbody class="mt-5">
                @php $total = 0; @endphp
                @foreach($carrinhoItens as $carrinhoItem)
                <tr>
                    <td>
                    <a href="{{ route('carrinho_excluir', ['indice => $carrinhoItem'])}}" class="btn btn-danger">
                        <i class="fa fa-trash"></i>
                        </a>
                    </td>
                    <td>{{ $carrinhoItem->produto->PRODUTO_NOME }}</td>
                    <td class="">                    
                            <img src="{{$carrinhoItem->produto->imagens->first()->IMAGEM_URL}}" alt="Imagem do produto" class="img-thumbnail" style="max-width: 50px;">                    
                        
                    </td>
                    <td class="">{{ $carrinhoItem->produto->PRODUTO_PRECO}}</td>
                    <td>{{ $carrinhoItem->produto->PRODUTO_DESC }}</td>
                </tr>
                @php $total += $carrinhoItem->produto->PRODUTO_PRECO; @endphp
                @endforeach
            </tbody>

            <tfoot>
                <tr>
                    <td collspan="5">
                        Total do Carrinho: R$ {{$total}}
                    </td>
                </tr>
            </tfoot>

        </table>

       
        <form method="post" action="{{ route('carrinho_finalizar') }}">
    @csrf
    <input type="submit" value="Finalizar Compra" class="btn btn-lg btn-success">
</form>

    </div>
@endsection

