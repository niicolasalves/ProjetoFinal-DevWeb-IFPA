<? include('views/inc/alertas.inc.php') ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h1 class="h2">Produtos</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="./?u=produtos/add" class="btn btn-sm btn-outline-primary mr-3">
            <div class="fa fa-plus mr-1"></div>
            Novo produto
        </a>
        <a href="./?u=produtos/detalhes_modal" class="btn btn-sm btn-outline-secondary abrirNoModal">
            <div class="fa fa-money-check-alt mr-1"></div>
            Buscar produto
        </a>
    </div>
</div>

<table class="table table-striped table-sm">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tipo</th>
            <th>Titulo</th>
            <th>Estoque</th>
            <th>Valor</th>
            <th>Características</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <? while($produto = $this->get('produtos')->fetch()): ?>
        <tr>
            <td class="align-middle"><?=$produto['id_produto']?></td>
            <td class="align-middle text-uppercase"><?=$produto['tipo']?></td>
            <td class="align-middle">
                <b><?=$produto['titulo']?></b>
                <br>
                <small><?=$produto['descricao']?></small>
            </td>
            <td class="align-middle"><?=$produto['estoque']?></td>
            <td class="align-middle"><?=$produto['valor']?></td>
            <td class="align-middle">
                <?
                    $caracteristicas = json_decode($produto['caracteristicas']);
                    foreach($caracteristicas as $nome => $carac):
                ?>
                <small><?=$nome?>: <?=$carac?></small>
                <br>
                <? endforeach; ?>
            </td>
            <td class="align-middle" width="100">
                <a href="#" class="btn btn-sm btn-outline-secondary">
                    <i class="fa fa-pencil"></i>
                </a>
                <a href="./?u=produtos/deletar&id=<?=$produto['id_produto']?>" class="btn btn-sm btn-outline-secondary" onclick="return confirm('Deseja realmente excluir este produto?')">
                    <i class="fa fa-trash"></i>
                </a>
            </td>
        </tr>
        <? endwhile; ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="6">Total de clientes: <?= $this->get('produtos')->rowCount() ?></td>
        </tr>
    </tfoot>
</table>