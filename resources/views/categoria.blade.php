 @extends("layout")
 @section("conteudo")

     <div class="container">   

         <div class=" mt-4   ">
             @if(isset($listaCategoria) && count($listaCategoria) > 0)

             <div class=" list-group list-group-horizontal d-flex">

                 <a href="{{route('categoria')}}"
                     class="list-group-item list-group-item-action @if(0 == $idcategoria) active @endif">Todas</a>
                 @foreach($listaCategoria as $cat)
                 <a href="{{route('categoria_por_id', ['idcategoria' => $cat->CATEGORIA_ID])}}"
                     class="list-group-item list-group-item-action @if($cat->CATEGORIA_ID == $idcategoria) active @endif">{{ $cat->CATEGORIA_NOME }}</a>
                 @endforeach
             </div>

             @endif

         </div>
         <div class="mt-4">
      <img src="{{asset('images/videogames.jpg')}}" class="d-block w-100 " alt="...">
    </div>
     </div>
 


 <div class="container mt-5">
     <div class="row">
         
         @include("_produtos", ['lista' => $lista])
     </div>
 </div>



 @endsection