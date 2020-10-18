<? include('views/inc/alertas.inc.php') ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h1 class="h2">Clientes</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="./?u=clientes/add" class="btn btn-sm btn-outline-primary">
            <div class="fa fa-plus mr-1"></div>
            Novo cliente
        </a>
    </div>
</div>

<table class="table table-striped table-sm">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>CPF</th>
            <th>Endereço</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <? while($cliente = $this->get('clientes')->fetch()): ?>
        <tr>
            <td class="align-middle"><?=$cliente['id_cliente']?></td>
            <td class="align-middle">
                <b><?=$cliente['nome']?></b>
            </td>
            <td class="align-middle"><?=$cliente['cpf']?></td>
            <td class="align-middle">
                <?=$cliente['endereco']?>, <?=$cliente['endereco_num']?> - <?=$cliente['bairro']?>
                <br>
                <small><?=$cliente['cidade']?> / <?= $cliente['uf'] ?></small>
            </td>
            <td class="align-middle" width="100">
                <a href="#" class="btn btn-sm btn-outline-secondary">
                    <i class="fa fa-pencil"></i>
                </a>
                <a href="./?u=clientes/deletar&id=<?=$cliente['id_cliente']?>" class="btn btn-sm btn-outline-secondary" onclick="return confirm('Deseja realmente excluir este cliente?')">
                    <i class="fa fa-trash"></i>
                </a>
            </td>
        </tr>
        <? endwhile; ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="6">Total de clientes: <?= $this->get('clientes')->rowCount() ?></td>
        </tr>
    </tfoot>
</table>