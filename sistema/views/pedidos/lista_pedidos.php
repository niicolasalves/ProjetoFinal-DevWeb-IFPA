<? include('views/inc/alertas.inc.php') ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h1 class="h2">Pedidos</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="./?u=pedidos/add" class="btn btn-sm btn-outline-primary mr-3">
            <div class="fa fa-plus mr-1"></div>
            Novo pedido
        </a>
        <a href="./?u=produtos/detalhes_modal" class="btn btn-sm btn-outline-secondary abrirNoModal">
            <div class="fa fa-money-check-alt mr-1"></div>
            Consultar produto
        </a>
    </div>
</div>

<table class="table table-striped table-sm">
    <thead>
        <tr>
            <th>ID</th>
            <th>Data do Pedido</th>
            <th>Cliente</th>
            <th>Valor Total</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <? while($pedido = $this->get('pedidos')->fetch()): ?>
        <tr>
            <td class="align-middle"><?=$pedido['id_pedido']?></td>
            <td class="align-middle"><?=$pedido['data']?></td>
            <td class="align-middle"><?=$pedido['nome_cliente']?></td>
            <td class="align-middle">R$ <?=$pedido['valor_pedido']?></td>
            <td class="align-middle" width="1"><a href="javascript:;" onclick="abrirModal('/?u=pedidos/modal_pedido&id=<?=$pedido['id_pedido']?>')">Detalhar</a></td>
        </tr>
        <? endwhile; ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="6">Total de clientes: <?= $this->get('pedidos')->rowCount() ?></td>
        </tr>
    </tfoot>
</table>