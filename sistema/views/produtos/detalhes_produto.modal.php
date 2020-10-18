<?
    $produto = $this->get('produto');
    $caracteristicas = json_decode($produto['caracteristicas']);
?>
<table class="table">
    <tbody>
        <tr>
            <td colspan="2"><h4><?=$produto['titulo']?></h4></td>
        </tr>
        <tr>
            <td>Valor unitário:</td>
            <td>R$ <?=$produto['valor']?></td>
        </tr>
        <tr>
            <td>Quantidade em estoque:</td>
            <td><?=$produto['estoque']?></td>
        </tr>
        <tr>
            <td>Descrição:</td>
            <td><?=$produto['descricao']?></td>
        </tr>
        <tr>
            <td>Caracteristicas:</td>
            <td>
                <ul>
                    <? foreach($caracteristicas as $k => $v): ?>
                    <li><?=$k?>: <?=$v?></li>
                    <? endforeach; ?>
                </ul>
            </td>
        </tr>
    </tbody>
</table>