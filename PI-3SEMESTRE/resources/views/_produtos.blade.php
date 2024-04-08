@if(isset($lista))
<div class="row">
    @foreach($lista as $prod)
    <div class="col-12 col-sm-6 col-lg-4 col-xl-3 mb-4">
        <div class="card product-card" style="height: 100%;">
            <a href="{{ route('detalhes_produto', ['id' => $prod->PRODUTO_ID]) }}">
                @if(count($prod->imagens) > 0)
                @foreach($prod->imagens as $imagem)
                <img src="{{ asset($imagem->IMAGEM_URL) }}" alt="Imagem do produto" class="card-img-top"
                    style="height:200px;">
                @break
                @endforeach
                @else
                <img src="{{ asset('images/foto.png') }}" alt="Imagem padrão" class="card-img-top"
                    style="height: 200px;">
                @endif
            </a>

            <div class="card-body">
                <a href="{{ route('detalhes_produto', ['id' => $prod->PRODUTO_ID]) }}"
                    class="text-dark text-decoration-none">
                    <h5 class="card-title">{{ $prod->PRODUTO_NOME }}</h5>
                    <div class="card-description" style="height: 100px; overflow: hidden; margin: 0;">
                        <p class="card-text">{{ $prod->PRODUTO_DESC }}</p>
                    </div>
                    <p class="card-price" style="margin: 0;">R$ {{ $prod->PRODUTO_PRECO }}</p>
                </a>
            </div>
        </div>
        
    </div>    
    @endforeach
    
</div>
@endif