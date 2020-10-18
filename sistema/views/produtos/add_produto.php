<? include('views/inc/alertas.inc.php') ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h1 class="h2">Adicionar produto</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="./?u=produtos" class="btn btn-sm btn-outline-secondary">
            <div class="fa fa-chevron-left mr-1"></div>
            Voltar 
        </a>
    </div>
</div>

<form action="" method="post" class="formAjax" data-ajaxurl="./?u=produtos/store" data-ajaxreturn="./?u=produtos">
    <div class="row">
        <div class="col-xl-8 mx-auto">
            <div class="form-group">
                <label for="ipt-tipo">Tipo do produto:</label>
                <select name="tipo" id="ipt-tipo" class="form-control" onchange="carregar_caracteristicas();">
                    <option value="" disabled selected>Selecione...</option>
                    <option value="desktops">Desktops</option>
                    <option value="laptops">Laptops</option>
                    <option value="impressoras">Impressoras</option>
                </select>
            </div>
            <div class="form-group">
                <label for="ipt-titulo">Titulo:</label>
                <input type="text" name="titulo" id="ipt-titulo" class="form-control">
            </div>
            <div class="row">
                <div class="form-group col-9">
                    <label for="ipt-valor">Valor:</label>
                    <input type="text" name="valor" id="ipt-valor" class="form-control">
                </div>
                <div class="form-group col-3">
                    <label for="ipt-estoque">Estoque:</label>
                    <input type="text" name="estoque" id="ipt-estoque" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label for="ipt-descricao">Descrição detalhada:</label>
                <textarea name="descricao" id="ipt-descricao" class="form-control" rows="8"></textarea>
            </div>
            <label for=""><h5>Características:</h5></label>
            <div id="caracteristicas"></div>
            <!-- add caracteristica -->
            <div class="row">
                <div class="col-12">
                    <label for="ipt-add_caracteristicas"><small>ADICIONAR CARACTERÍSTICA DO PRODUTO</small></label>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-10">
                    <select name="todas_caracteristicas" id="ipt-add_caracteristicas" class="form-control">
                        <option value="" disabled selected>Selecione o tipo do produto</option>
                    </select>
                </div>
                <div class="col-2 col-form-label">
                    <h5><a href="javascript:;" onclick="add_caracteristica()"><i class="fa fa-plus-circle ml-2"></i></a></h5>
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
<script type="text/javascript">
function add_caracteristica(){
    $(function(){
        var carac = $('#ipt-add_caracteristicas').val();
        var template = $('#row_caracteristica').html().trim().replace(/{{carac}}/ig, carac);
        $('#caracteristicas').append(template);
    });
}

function del_caracteristica(elem){
    var parente = $(elem).parent().parent();
    $(parente).remove();
}

function carregar_caracteristicas(){
    var tipo = $('#ipt-tipo').val();
    switch(tipo){
        case 'desktops':
            var caracs = $('#caracteristicas_desktop').html().trim();
            $('#ipt-add_caracteristicas').html(caracs);
        break;
        case 'laptops':
            var caracs = $('#caracteristicas_laptop').html().trim();
            $('#ipt-add_caracteristicas').html(caracs);
        break;
        case 'impressoras':
            var caracs = $('#caracteristicas_impressora').html().trim();
            $('#ipt-add_caracteristicas').html(caracs);
        break;
    }
}
</script>
<template id="row_caracteristica">
    <div class="row form-group">
        <label class="col-4 text-right col-form-label">{{carac}}:</label>
        <div class="col-7">
            <input type="text" name="caracteristica[{{carac}}]" class="form-control">
        </div>
        <div class="col-1 col-form-label">
            <a href="javascript:;" onclick="del_caracteristica(this)"><i class="fa fa-minus-circle"></i></a>
        </div>
    </div>
</template>
<template id="caracteristicas_desktop">
    <option value="Nome do Fabricante">Nome do Fabricante</option>
    <option value="Memória RAM">Memória RAM</option>
    <option value="Armazenamento HD">Armazenamento HD</option>
    <option value="Tipo de Processador">Tipo de Processador</option>
</template>
<template id="caracteristicas_laptop">
    <option value="Nome do Fabricante">Nome do Fabricante</option>
    <option value="Tamanho de Tela">Tamanho de Tela</option>
    <option value="Memória RAM">Memória RAM</option>
    <option value="Armazenamento HD">Armazenamento HD</option>
    <option value="Tipo de Processador">Tipo de Processador</option>
</template>
<template id="caracteristicas_impressora">
    <option value="Nome do Fabricante">Nome do Fabricante</option>
    <option value="Tipo de Impressora">Tipo de Impressora</option>
    <option value="Multifuncional">Multifuncional</option>
</template>