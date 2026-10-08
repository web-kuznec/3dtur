var domen = document.domain;

function substr( f_string, f_start, f_length ) {    // Return part of a string
    if(f_start < 0) {
        f_start += f_string.length;
    }
 
    if(f_length == undefined) {
        f_length = f_string.length;
    } else if(f_length < 0){
        f_length += f_string.length;
    } else {
        f_length += f_start;
    }
 
    if(f_length < f_start) {
        f_length = f_start;
    }
 
    return f_string.substring(f_start, f_length);
}

function checkmail(value) {
    reg = /^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i;
    if (!value.match(reg)) {
        return false;
    } else {
        return true;
    }
}

function exitus() {
    $.ajax({
        type: 'POST',
        dataType: 'html',
        url: '/ajax/ajax/auth/exit',
        success: function(data) {
            document.location.reload();
        }
    });
}

function dell_val(tag) {
    if($('#'+tag)) {
        $('#'+tag).css('border', '1px solid silver');
        $('#'+tag).bind('click', function() {
            return fase;
        });
    }
}

function close_div(div1, div2) {
if(jQuery('#'+div1)) {
        $('#'+div1).remove();
    }
    if($('#'+div2)) {
        $('#'+div2).remove();
    }
}

function translit(tag, table, update) {
    if($("#"+tag)) {
        var name = $("#"+tag).val();
        var id = null;
        if($("#id")) {
            var id = $("#id").val();
        }
        jQuery.ajax({
            type: 'POST',
            dataType: 'html',
            data: {id:id,name:name,table:table},
            url: '/ajax/ajax/struct/translit',
            success: function(response) {
                var obj = jQuery.parseJSON(response);
                if(obj.code == "ERROR_VATIDATION") {
                    if($("#"+update)) {
                        $("#"+update).val("Ошибка");
                    }
                } else {
                    if("#"+update) {
                        $("#"+update).val(obj.code);
                    }
                }
            }
        });
    }
}

function edit(page) {
    draw_window();
    var pars = $H({ page:page }).toQueryString();
    var myRequest = new Request.HTML({
        url: '/ajax/ajax/text/edit',
        method: 'POST',
        onComplete: function(a,b,c) {
            $('div_abs').set('html', c);
            setup();
        }
    }).send(pars);
}

function draw_window() {
    var div_fix = jQuery('<div/>').attr({
        id: 'div_fix'
    });
    jQuery(document.body).append(div_fix);
    var div_abs = jQuery('<div/>').attr({
        id: 'div_abs'
    });
    jQuery(document.body).append(div_abs);
}