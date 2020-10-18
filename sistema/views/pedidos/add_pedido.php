<? include('views/inc/alertas.inc.php') ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h1 class="h2">Novo pedido</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="./?u=pedidos" class="btn btn-sm btn-outline-secondary mr-3">
            <div class="fa fa-chevron-left mr-1"></div>
            Voltar 
        </a>
        <a href="./?u=produtos/detalhes_modal" class="btn btn-sm btn-outline-secondary abrirNoModal">
            <div class="fa fa-money-check-alt mr-1"></div>
            Consultar produto
        </a>
    </div>
</div>

<form action="" id="form-pedido" method="post" class="formAjax" data-ajaxurl="./?u=pedidos/store" data-ajaxreturn="./?u=pedidos">
    <div class="row">
        <div class="col-xl-8 mx-auto">
            <input type="hidden" name="valor_total" id="ipt-total">
            <input type="hidden" name="cod_cliente" id="ipt-cod_cliente">
            <div class="form-group">
                <label for="ipt-cliente"><b>Cliente:</b></label>
                <input type="text" name="nome_cliente" id="ipt-cliente" class="form-control" placeholder="Busque pelo nome do cliente...">
                <div id="autocomplete-clientes" class="autocomplete-box">
                    <small><b>CLIENTES</b></small>
                    <ul></ul>
                </div>
            </div>
            <div class="form-group">
                <label for="ipt-produto"><b>Incluir produto:</b></label>
                <input type="text" name="nome_produto" id="ipt-produto" class="form-control" placeholder="Busque pelo titulo do produto...">
                <div id="autocomplete-produtos" class="autocomplete-box">
                    <small><b>PRODUTOS</b></small>
                    <ul></ul>
                </div>
            </div>
            <div class="form-group">
                <label for="">Produtos do pedido:</label>
                <table class="table table-sm" id="tabela-produtos">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="">ID</th>
                            <th>Titulo</th>
                            <th>Valor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="3" align="center">Nenhum produto foi incluido no pedido</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" align="right"><small>Valor total do pedido: <span id="valor-total" class="font-weight-bold">R$ 0,00</span></small></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="row">
                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-primary">Finalizar Pedido</button>
                    <button type="reset" class="btn btn-secondary" onclick="limpar_pedido()">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script type="text/javascript">
var produtos_count = 0;
var valor_total = 0;

function escolher_cliente(id, nome){
    $('#ipt-cod_cliente').val(id);
    $('#ipt-cliente').val(nome);
    $('#autocomplete-clientes').hide();
}

function incluir_produto(id, titulo, valor){
    if(produtos_count == 0){
        $('#tabela-produtos tbody').html('');
    }

    var el_input = document.createElement('input');
    el_input.setAttribute('type', 'hidden');
    el_input.setAttribute('name', 'cod_produto[]');
    el_input.setAttribute('value', id);
    el_input.classList = 'ipt-produtos';

    $('#form-pedido').append(el_input);

    $('#tabela-produtos tbody').append('<tr><td>'+ id +'</td><td>' + titulo + '</td><td>' + valor + '</td></tr>');
    $('#autocomplete-produtos').hide();
    $('#ipt-produto').val('');

    var produto_valor = Number(valor);
    valor_total += produto_valor;

    produtos_count++;
    atualizar_total();
}

function atualizar_total(){
    $('#valor-total').html(valor_total.toLocaleString('pt-br',{style: 'currency', currency: 'BRL'}));
    $('#ipt-total').val(valor_total);
}

function limpar_pedido(){
    $('#ipt-cod_cliente').val('');
    $('.ipt-produtos').remove();

    $('#tabela-produtos tbody').html('<tr><td colspan="3" align="center">Nenhum produto foi incluido no pedido</td></tr>');

    produtos_count = 0;
    valor_total = 0;
    atualizar_total();
}

$(function(){
    var min_length = 3;

    $('#ipt-cliente').keyup(function(){
        var nome = $(this).val();
        if(nome.length >= min_length){
            $.ajax({
                type: 'POST',
                url: './?u=clientes/autocomplete',
                data: 'nome='+nome,
                dataType: 'json',
                success: function(res){
                    $('#autocomplete-clientes ul').html('');
                    $('#autocomplete-clientes').show();
                    if(res == '' || res.length == 0){
                        $('#autocomplete-clientes ul').html('<li>Nenhum cliente foi encontrado</li>');
                    }

                    res.forEach(function(cliente){
                        var el_li = document.createElement('li');
                        var el_a = document.createElement('a');
    
                        el_a.setAttribute('href', 'javascript:;');
                        el_a.setAttribute('onclick', 'escolher_cliente(\'' + cliente['id'] + '\', \'' + cliente['nome'] + '\')');
                        el_a.innerHTML = cliente['nome'];

                        el_li.append(el_a);

                        $('#autocomplete-clientes ul').append(el_li);
                    });
                }
            });
        } else {
            $('#autocomplete-clientes').hide();
        }
    });

    $('#ipt-produto').keyup(function(){
        var titulo = $(this).val();
        if(titulo.length >= min_length){
            $.ajax({
                type: 'POST',
                url: './?u=produtos/autocomplete',
                data: 'titulo='+titulo,
                dataType: 'json',
                success: function(res){
                    $('#autocomplete-produtos ul').html('');
                    $('#autocomplete-produtos').show();
                    if(res == '' || res.length == 0){
                        $('#autocomplete-produtos ul').html('<li>Nenhum produto foi encontrado</li>');
                    }

                    res.forEach(function(produto){
                        var el_li = document.createElement('li');
                        var el_a = document.createElement('a');
    
                        el_a.setAttribute('href', 'javascript:;');
                        el_a.setAttribute('onclick', 'incluir_produto(\'' + produto['id'] + '\', \'' + produto['titulo'] + '\', \'' + produto['valor'] + '\')');
                        el_a.innerHTML = produto['titulo'];

                        el_li.append(el_a);

                        $('#autocomplete-produtos ul').append(el_li);
                    });
                }
            });
        } else {
            $('#autocomplete-produtos').hide();
        }
    });
});
</script>