j = jQuery.noConflict();
function rp_required(form, funcao=null, ajx=null) {
    form = "#" + form;
    j(form).submit(function() {
        j('.small').remove();

        var submit = j(form).find('.rp_required').filter(function() {
            return !this.value;
        }).get();
        var vazios = j(form).find('.rp_required').filter(function() {
            return this;
        }).get();
        if (vazios.length) {
            j(vazios).each(function(index) {
                var small = "<small class='small' id='small_" + index + "' style='color: red; display: none;'>Campo obrigatório!</small>";

                if (this.value == '') {
                    j(this).remove('#small' + index)
                    j(this).after(small);
                    j('#small_' + index).css('display', 'block');
                    j(this).css({
                        "border": "1px solid",
                        "border-color": "red",
                    });
                } else {
                    j(this).css({
                        "border": "",
                        "border-color": "",
                    });
                }
            });
            if (submit.length) {
                return false;
            } else {
                if(funcao){
                retorno = funcao();
                }else{
                    retorno = true;
                }
                if (retorno && !ajx) {
                    return true;
                } else {
                    return false;
                }
            }
        }
    });
}

function OpenModalFor(clicked_button) {
    var item_id = j(clicked_button).data('itemid');
    console.log(item_id);

    j.ajax({
        type: 'POST',
        data: {
            'id' : item_id,
        },
        url : "relatorio_teste_detalhes_modal.php",
        success: function(response) {
            if(response) {
                console.log(response)
                j('#getModal').append(response);
                j('.modal').modal('show');
                j(".close").click(function () {
                    j('.modal').modal('hide');
                    j('#getModal').html('');
                    j('.modal-backdrop').remove()
                   
                });
            } else {
                alert('Error');
            }
        }
    });
    
    /* j.ajax({
        url: 'relatorio_teste_detalhes_modal.php',
        type: 'POST',
        data: {id : item_id},
        dataType: 'html',
        cache: false
   })
   .done(function(data){
        console.log(data);
        j("#getModal").html(data);
        j(".modal").modal('show');
   })
   .fail(function(){
        
   }); */
}

