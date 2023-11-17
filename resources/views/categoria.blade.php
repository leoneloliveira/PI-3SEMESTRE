 @extends("layout")
    @section("conteudo")
    <div class="row">
 <div class="container mt-4 "> 
    
      <div class="col-2 mt-4">
         @if(isset($listaCategoria) && count($listaCategoria) > 0)
         
         <div class="list-group ">
         
               <a href="{{route('categoria')}}" class="list-group-item list-group-item-action @if(0 == $idcategoria) active @endif">Todas</a>
               @foreach($listaCategoria as $cat)
               <a href="{{route('categoria_por_id', ['idcategoria' => $cat->CATEGORIA_ID])}}" class="list-group-item list-group-item-action @if($cat->CATEGORIA_ID == $idcategoria) active @endif">{{ $cat->CATEGORIA_NOME }}</a>
               @endforeach
         </div>         
        
         @endif

        </div>
     </div>
    </div>


<div class="container mt-5">
    <div class="row"> <!-- Inicie uma nova linha para os cards -->
        @include("_produtos", ['lista' => $lista])
    </div>
</div>
      


@endsection