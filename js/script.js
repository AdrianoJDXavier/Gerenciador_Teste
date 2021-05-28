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