$(document).ready(function(e){
    $("#form_id").on('submit', function(e){
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'includes/input-handler.inc.php',
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData:false,
            success: function(data) {
                if(data.status == "success"){
                    $('.suc-box').html('<p>'+data.message+'</p>'); 
                    $('.alert-box').addClass('none');
                    $('.btn-submit').addClass('none');
                    $('.btn-cont').removeClass('none');
                    $('.suc-box').removeClass('none');
                }else if(data.status == "error"){
                    $('.alert-box').html('<p>'+data.message+'</p>');
                    $('.alert-box').removeClass('none');
                }
            },
        });
    });
});