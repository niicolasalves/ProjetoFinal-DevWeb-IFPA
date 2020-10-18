<? include('views/inc/alertas.inc.php') ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h1 class="h2">Adicionar cliente</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="./?u=clientes" class="btn btn-sm btn-outline-secondary">
            <div class="fa fa-chevron-left mr-1"></div>
            Voltar 
        </a>
    </div>
</div>

<form action="" method="post" class="formAjax" data-ajaxurl="./?u=clientes/store" data-ajaxreturn="./?u=clientes">
    <div class="row">
        <div class="col-xl-8 mx-auto">
            <div class="form-group">
                <label for="ipt-nome">Nome completo:</label>
                <input type="text" name="nome" id="ipt-nome" class="form-control">
            </div>
            <div class="form-group">
                <label for="ipt-cpf">CPF:</label>
                <input type="text" name="cpf" id="ipt-cpf" class="form-control" data-inputmask="'mask': '999.999.999-99'">
            </div>
            <div class="row">
                <div class="form-group col-10">
                    <label for="ipt-endereco">Endereço:</label>
                    <input type="text" name="endereco" id="ipt-endereco" class="form-control">
                </div>
                <div class="form-group col-2">
                    <label for="ipt-numero">Número:</label>
                    <input type="text" name="numero" id="ipt-numero" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-6">
                    <label for="ipt-bairro">Bairro:</label>
                    <input type="text" name="bairro" id="ipt-bairro" class="form-control">
                </div>
                <div class="form-group col-6">
                    <label for="ipt-complemento">Complemento</label>
                    <input type="text" name="complemento" id="ipt-complemento" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-10">
                    <label for="ipt-cidade">Cidade:</label>
                    <input type="text" name="cidade" id="ipt-cidade" class="form-control">
                </div>
                <div class="form-group col-2">
                    <label for="ipt-uf">UF:</label>
                    <input type="text" name="uf" id="ipt-uf" class="form-control" data-inputmask="'mask': 'AA'">
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 text-center">
            <button type="submit" class="btn btn-primary">Cadastrar</button>
            <button type="reset" class="btn btn-secondary">Limpar</button>
        </div>
    </div>
</form>