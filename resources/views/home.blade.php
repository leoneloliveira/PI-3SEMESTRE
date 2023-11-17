
@extends("layout")
@section("conteudo") 



<div class="container mt-4">

    <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel" >
        <div class="carousel-inner">
            @foreach(\App\Models\Imagem::all() as $key => $imagem)
                <div class="carousel-item {{$key == 0 ? 'active' : ''}}">
                    <img class="d-block mx-auto" src="{{ asset($imagem->IMAGEM_URL) }}" alt="Imagem {{$key + 1}}" style="max-width: 400px; max-height: 300px;">
                </div>
            @endforeach
        </div>
    </div>

</div>  
<div class="container mt-5">
    <div class="row mt-5"> <!-- Inicie uma nova linha para os cards -->
        @include("_produtos", ['lista' => $lista])
    </div>
</div>
 


@endsection




