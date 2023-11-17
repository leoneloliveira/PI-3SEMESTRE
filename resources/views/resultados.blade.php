@extends('layout') 

@section('conteudo')
    <h2 class="mt-4  ">Produtos da Pesquisa</h2>

   
    <div class="row mt-4">
    @foreach($resultadosProdutos as $produto)
        {{-- Exiba os resultados dos produtos --}}
        
        
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3 mb-4">
        <div class="card product-card" style="height: 100%;">
            @if ($produto->imagens->count() > 0)
                <img src="{{ asset($produto->imagens[0]->IMAGEM_URL) }}" alt="Imagem do produto" class="card-img-top" style="height:200px;">
            @else
                <img src="{{ asset('caminho_da_imagem_padrao.jpg') }}" alt="Imagem padrão" class="card-img-top" style="height: 200px;">
            @endif

            <div class="card-body">
                <h5 class="card-title">{{$produto->PRODUTO_NOME }}</h5>
                <div class="card-description" style="height: 100px; overflow: hidden;">
                    <p class="card-text">{{ $produto->PRODUTO_DESC }}</p>
                    

                </div>
                <p class="card-price">R$ {{ $produto->PRODUTO_PRECO }}</p>

                  <a href="{{route('adicionar_carrinho', ['idproduto' => $produto->PRODUTO_ID] )}}" class="btn btn-sm btn-success ">Comprar</a>
                  <a href="{{route('adicionar_carrinho', ['idproduto' => $produto->PRODUTO_ID] )}}" class="btn btn-sm btn-secondary mt-2">Adicionar Item</a>
                
            </div>

           
            
        </div>
    </div>

    @endforeach
</div>
    

    
@endsection

