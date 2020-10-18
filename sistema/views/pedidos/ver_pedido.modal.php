<? while($pedido = $this->get('pedido')->fetch()): ?>
<table class="table">
    <tbody>
        <tr>
            <td>Data:</td>
            <td><?=$pedido['data']?></td>
        </tr>
        <tr>
            <td>Cliente:</div>
            <td><?=$pedido['nome_cliente']?></td>
        </tr>
        <tr>
            <td>Produtos:</td>
            <td>
                <ul>
                    <? while($produto = $this->get('produtos')->fetch()): ?>
                    <li><?=$produto['titulo']?> | R$ <?=$produto['valor']?></li>
                    <? endwhile; ?>
                </ul>
            </td>
        </tr>
        <tr>
            <td>Valor total do pedido:</td>
            <td>R$ <?=$pedido['valor_pedido']?></td>
        </tr>
    </tbody>
</table>
<? endwhile; ?>