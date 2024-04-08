@extends("layout")
@section("conteudo")

<style>
    /* Custom styles for Netshoes-like carousel */
    #carouselExampleSlidesOnly {
      width: 100%;
      margin: auto;
    }

    .carousel-inner {
      border-radius: 10px;
      overflow: hidden;
    }

    .carousel-item img {
      width: 100%;
      height: 50%; /* Defina a altura desejada aqui */
      object-fit: cover; /* Isso garante que a imagem cubra completamente o espaço alocado */
      border-radius: 10px;
    }
  </style>


<div id="carouselExampleSlidesOnly" class="carousel slide mt-4" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="{{asset('images/videogames.jpg')}}" class="d-block  " alt="...">
    </div>
    <div class="carousel-item">
      <img src="{{asset('images/produto01.png')}}" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="{{asset('images/produto02.png')}}" class="d-block w-100 " alt="...">
    </div>
  </div>


</div>
<div class="container mt-5">
    <div class="row mt-5">
     
        @include("_produtos", ['lista' => $lista])
    </div>
</div>



@endsection