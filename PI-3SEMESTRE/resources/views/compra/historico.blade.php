@extends("layout")

@section("script.js")
    <script>
        $(function(){
            $(".infocompra").on('click', function() {
                let id = $(this).attr("data-value");
                $.post('{{ route("compra_detalhes") }}', { idpedido: id }, function(result) {
                    $("#modalcompra .modal-body").html(result);
                    $("#modalcompra").modal("show");
                });
            });
        });
    </script>
@endsection

@section("conteudo") 
    <div class="col-12">
        <h2>Minhas Compras</h2>
    </div>

    <div class="col-12">
        <table class="table table-bordered">
            <tr>
                <th>Data da Compra</th>
                <th>Situação</th>
                <th></th>
            </tr>
            @foreach($lista as $ped)
                <tr>
                    <td>{{ $ped->PEDIDO_DATA }}</td>
                    <td>{{ $ped->STATUS_ID}}</td>
                    <td>
                        <a href="#" class="btn btn-sm btn-info infocompra" data-value="{{ $ped->id }}" data-toggle="modal" data-target="#modalcompra">
                            <i class="fas fa-shopping-basket"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>

    <!-- Modal for displaying purchase details -->
    <div class="modal fade" id="modalcompra">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detalhes da Compra</h5>
                </div>
                <div class="modal-body">
                    <!-- Content will be loaded here via AJAX -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

@endsection
