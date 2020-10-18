<div class="form-group">
    <input type="text" id="ipt-titulo" class="form-control form-control-lg" placeholder="Busque pelo titulo do produto..." style="min-width: 400px">
</div>
<div id="autocomplete-produtos">
    <ul></ul>
</div>
<div id="resultado"></div>
<script type="text/javascript">

function ver_produto(id){
    $('#ipt-titulo', '#my-modal').val('');
    
    $.get('./?u=produtos/produto_modal&id='+id, function(res){
        $('#resultado').html(res);
        $('#autocomplete-produtos ul').html('');
    });
}

$(function(){
    var min_length = 3;

    $('#ipt-titulo', '#my-modal').keyup(function(){
        var titulo = $(this).val();
        if(titulo.length >= min_length){
            $.ajax({
                type: 'POST',
                url: './?u=produtos/autocomplete',
                data: 'titulo='+titulo,
                dataType: 'json',
                success: function(res){
                    $('#autocomplete-produtos ul', '#my-modal').html('');
                    if(res == '' || res.length == 0){
                        $('#autocomplete-produtos ul', '#my-modal').html('<li>Nenhum produto foi encontrado</li>');
                    }

                    res.forEach(function(produto){
                        var el_li = document.createElement('li');
                        var el_a = document.createElement('a');
    
                        el_a.setAttribute('href', 'javascript:;');
                        el_a.setAttribute('onclick', 'ver_produto(\'' + produto['id'] + '\')');
                        el_a.innerHTML = produto['titulo'];

                        el_li.append(el_a);

                        $('#autocomplete-produtos ul', '#my-modal').append(el_li);
                    });
                }
            });
        }
    });
});
</script>