@if(isset($lista))
<div class="row">
    @foreach($lista as $prod)
    <div class="col-12 col-sm-6 col-lg-4 col-xl-3 mb-4">
        <div class="card product-card" style="height: 100%;">
            @if ($prod->imagens->count() > 0)
                <img src="{{ asset($prod->imagens[0]->IMAGEM_URL) }}" alt="Imagem do produto" class="card-img-top" style="height:200px;">
            @else
                <img src="{{ asset('caminho_da_imagem_padrao.jpg') }}" alt="Imagem padrão" class="card-img-top" style="height: 200px;">
            @endif

            <div class="card-body">
                <h5 class="card-title">{{ $prod->PRODUTO_NOME }}</h5>
                <div class="card-description" style="height: 100px; overflow: hidden;">
                    <p class="card-text">{{ $prod->PRODUTO_DESC }}</p>
                    

                </div>
                <p class="card-price">R$ {{ $prod->PRODUTO_PRECO }}</p>
                
                <a href="{{route('adicionar_carrinho', ['idproduto' => $prod->PRODUTO_ID] )}}" class="btn btn-sm btn-success ">Comprar</a>
              
                  <a href="{{route('adicionar_carrinho', ['idproduto' => $prod->PRODUTO_ID] )}}" class="btn btn-sm btn-secondary mt-2">Adicionar Item</a>
                
            </div>           
            
        </div>
    </div>
    @endforeach
</div>
@endif
