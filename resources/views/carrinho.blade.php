@extends("layout")
@section("conteudo")

<div class="container mt-5">
    <h1 class="card-title">Meu Carrinho</h1>
    <h2 class="card-title mb-4" style="margin-top: 5px; margin-left: 900px;">Resumo da Compra</h2>
    <div class="row">
        <div class="col-md-8">
            <table class="table table-hover border">
                <thead class="thead-dark">
                    <tr>
                        <th style="width: 10%" class="text-center">Imagem</th>
                        <th style="width: 30%">Produto</th>
                        <th style="width: 10%">Preço Unitário</th>
                        <th style="width: 20%">Quantidade</th>
                        <th style="width: 15%">Subtotal</th>

                    </tr>
                </thead>
                <tbody>
                    @php $total = 0; @endphp
                    @foreach($carrinhoItens as $carrinhoItem)
                    <tr>
                        <td class="text-center align-middle">
                            @if($carrinhoItem->produto->imagens->isNotEmpty())
                            <img src="{{$carrinhoItem->produto->imagens->first()->IMAGEM_URL}}" alt="Imagem do produto"
                                class="img-thumbnail" style="max-width: 70px;">
                            @else
                            <img src="{{ asset('images/imagem_padrao.png') }}" alt="Imagem padrão" class="img-thumbnail"
                                style="max-width: 70px;">
                            @endif
                        </td>
                        <td class="align-middle">
                            <h6 class="mb-1">{{ $carrinhoItem->produto->PRODUTO_MARCA }}</h6>
                            <p>{{ $carrinhoItem->produto->PRODUTO_NOME }}</p>
                            <p class="text-muted">Cor: {{ $carrinhoItem->produto->PRODUTO_COR }}</p>
                        </td>
                        <td class="align-middle">
                            <p>R$ {{ number_format($carrinhoItem->produto->PRODUTO_PRECO, 2, ',', '.') }}</p>
                            <p class="text-success">(-{{ $carrinhoItem->produto->DESCONTO_PERCENTUAL }}% OFF)</p>
                        </td>
                        <td class="align-middle">
                            <form method="post" action="{{ route('carrinho.atualizar_quantidade') }}">
                                @csrf
                                <input type="hidden" name="produto_id" value="{{ $carrinhoItem->produto->PRODUTO_ID }}">
                                <div class="input-group">
                                    <input type="number" name="nova_quantidade" value="{{ $carrinhoItem->ITEM_QTD }}"
                                        min="1" class="form-control form-control-sm text-center">
                                    <button type="submit" class="btn btn-link">
                                        <i class="fas fa-sync-alt"></i>
                                    </button>
                                </div>
                            </form>
                        </td>
                        <td class="align-middle">
                            R$
                            {{ number_format($carrinhoItem->produto->PRODUTO_PRECO * $carrinhoItem->ITEM_QTD, 2, ',', '.') }}
                        </td>
                        <td class="text-center align-middle">
                            <a href="{{ route('carrinho_excluir', ['indice' => $carrinhoItem->produto->PRODUTO_ID]) }}"
                                class="btn btn-danger btn-sm">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </td>
                    </tr>
                    @php $total += $carrinhoItem->produto->PRODUTO_PRECO * $carrinhoItem->ITEM_QTD; @endphp
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="col-md-4">

            <div class="card">
                <div class="card-body">

                    <p class="card-text">Subtotal ({{ $carrinhoItens->sum('ITEM_QTD') }} itens): R$
                        {{ number_format($total, 2, ',', '.') }}</p>

                    <p class="card-text">Cupom de desconto: <a href="#">Adicionar</a></p>
                    <p class="card-text fw-bold">Valor total: R$ {{ number_format($total, 2, ',', '.') }} no Pix</p>
                    <p class="card-text">ou R$ {{ number_format($total, 2, ',', '.') }} em até 4x de R$
                        {{ number_format($total / 4, 2, ',', '.') }} sem juros</p>

                    <form method="post" action="{{ route('carrinho_finalizar') }}">
                        @csrf
                        <input type="submit" value="Finalizar Compra" class="btn btn-lg "
                            style="background-color: #e44d26; color: #ffffff; width: 100%; border: none;">
                    </form>
                    <a href="{{ route('categoria') }}"
                        class="btn btn-lg mt-2 {{ Request::is('categoria') ? 'active' : '' }}"
                        style="background-color: transparent; color: #39acdf; border: solid 1px #39acdf; font-weight: bold; width: 100%;">
                        Escolher Mais Produtos
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection