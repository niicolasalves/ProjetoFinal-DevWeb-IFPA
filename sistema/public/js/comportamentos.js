$(document).ready(function(){
    $(':input').inputmask();

    $('form.formAjax').submit(function(e){
        e.preventDefault();
        var data = $(this).serialize();
        var url = $(this).data('ajaxurl');
        var url_return = $(this).data('ajaxreturn');
        var type = $(this).attr('method');
        
        $.ajax({
            type: type,
            url: url,
            data: data,
            success: function(res){
                alert(res);
                window.location.href = url_return;
            },
            error: function(res){
                alert(res.responseText);
            }
        });
    });

    $('a.abrirNoModal').click(function(e){
        e.preventDefault();
        var url = $(this).attr('href');
        abrirModal(url);
    });

});

function abrirModal(url, type = 'get'){
    $.ajax({
        type: type,
        url: url,
        success: function(res){
            $('#my-modal').html(res);
            $('#my-modal').show();
            exibirBgModal();
        }
    })
}

function fecharModal(){
    $('#my-modal').hide();
    ocultarBgModal();
}

function exibirBgModal(){
    $('#bg-modal').show();
    $('#bg-modal').click(function(e){
        fecharModal();
    });
}

function ocultarBgModal(){
    $('#bg-modal').hide();
}