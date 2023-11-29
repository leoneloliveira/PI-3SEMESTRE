<table>
    <tr>
        <th>Produto</th>
        <th>Quantidade</th>
        <th>valor</th>
    </tr>
    @foreach($listaItens as $item)
    <tr>
        <td>{{$item->PRODUTO_NOME}}</td>
        <td>{{$item->ITEM_QTD}}</td>
        <td>{{$item->ITEM_PRECO}}</td>
    </tr>
    @endforeach
</table>

