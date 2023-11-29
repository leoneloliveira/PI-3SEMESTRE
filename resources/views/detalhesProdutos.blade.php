@extends("layout")
@section("conteudo")

<style>
.carousel-inner {
    max-height: 400px;
}

.product-details {
    margin-top: 20px;
}


</style>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-6">
            @if ($produto->imagens->count() > 0)
            <div id="imageCarousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    @foreach($produto->imagens as $key => $imagem)
                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                        <img src="{{ asset($imagem->IMAGEM_URL) }}" class="d-block mx-auto w-50 " alt="">
                    </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#imageCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#imageCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only btn ">Next</span>
                </a>
            </div>
            @endif
        </div>
        <div class="col-md-6">
            <h2>{{ $produto->PRODUTO_NOME }}</h2>
            <p>{{ $produto->PRODUTO_DESC }}</p>
            <p>R${{ $produto->PRODUTO_PRECO }}</p>

            <div class="product-details">

                <a href="{{ route('adicionar_carrinho', ['idproduto' => $produto->PRODUTO_ID]) }}"
                    class="btn btn-primary mt-4" style="background-color: #e44d26; color: #ffffff;  border: none;">Comprar</a>

            </div>
            <h3 class="mt-4">Especificações Técnicas</h3>
            <p>Dimensões: 10cm x 20cm x 5cm</p>
            <p>Peso: 100g</p>
            <p>Material: plastico</p>
        </div>
    </div>
</div>
@endsection