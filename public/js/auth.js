jQuery(document).ready(function() {
    
    /* Навешиваем событие на submit авторизации */
    if(jQuery('#autorizy')) {
        jQuery('#autorizy').bind('submit', function() {
            ajaxauth();
            return false;
        });
    }
    
    /* Навешиваем событие на submit создания нового пароля */
    if(jQuery('#reset')) {
        jQuery('#reset').bind('submit', function() {
            newpass();
            return false;
        });
    }
    
    /* Навешиваем событие на регистрацию */
    if(jQuery('#ah_reg')) {
        jQuery('#ah_reg').bind('click', function() {
            show_reg();
        });
    }
    
    /* Навешиваем событие на submit восстановление пароля */
    if(jQuery('#ah_backup')) {
        jQuery('#ah_backup').bind('click', function() {
            show_backup();
        });
    }
});

function show_auth() {
    jQuery.ajax({
        type: 'POST',
        dataType: 'html',
        url: '/ajax/ajax/auth/show_auth',
        success: function(data) {
            jQuery('#window_auth').html(data);
            
            /* Навешиваем событие на submit авторизации */
            jQuery('#autorizy').bind('submit', function() {
                ajaxauth();
                return false;
            });
            
            /* Навешиваем событие на регистрацию */
            jQuery('#ah_reg').bind('click', function() {
                show_reg();
            });
        
            /* Навешиваем событие на submit восстановление пароля */
            jQuery('#ah_backup').bind('click', function() {
                show_backup();
            });
        }
    });
}

function show_reg() {
    jQuery.ajax({
        type: 'POST',
        dataType: 'html',
        url: '/ajax/ajax/auth/show_registration',
        success: function(data) {
            jQuery('#window_auth').html(data);
            
            /* Навешиваем событие на submit авторизации */
            jQuery('#fregistration').bind('submit', function() {
                ajaxreg();
                return false;
            });
            
            /* Навешиваем событие на авторизацию */
            jQuery('#ah_auth').bind('click', function() {
                show_auth ();
            });
        
            /* Навешиваем событие на submit восстановление пароля */
            jQuery('#ah_backup').bind('click', function() {
                show_backup();
            });
        }
    });
}

function show_backup() {
    jQuery.ajax({
        type: 'POST',
        dataType: 'html',
        url: '/ajax/ajax/auth/show_backap',
        success: function(data) {
            jQuery('#window_auth').html(data);
            
            /* Вешаем событие на submit */
            if(jQuery('#backup')) {
                jQuery('#backup').bind('submit', function() {
                    backup();
                    return false;
                });
            }
            
            /* Вешаем событие на авторизацию */
            jQuery('#ah_auth').bind('click', function() {
                show_auth();
            });
            
            /* Вешаем событие на регистрацию */
            jQuery('#ah_reg').bind('click', function() {
                show_reg();
            });
        }
    });
}

function backup() {
    if(jQuery('#backup')) {
        jQuery.ajax({
            url: '/ajax/ajax/auth/backup',
            type: 'POST',
            dataType: 'html',
            data: jQuery('#backup').serialize(), 
            success: function(response) {
                var obj = jQuery.parseJSON(response);
                if(obj.code == "success") {
                    jQuery("#fregistration").html("<p>Регистрация прошла успешно!</p><p>Проверьте свою почту и подтвердите регистрацию, пройдя по ссылке</p>");
                } else {
                    jQuery("#result").html("<p>Неверно заполнены поля</p>");
                }
            },
            error: function(response) {
                alert('Ошибка сайта, обратитесь к администратору!');
            }
         });
    }
    return false;
}

function hide_r() {
    jQuery.ajax({
        type: 'POST',
        dataType: 'html',
        url: '/ajax/ajax/auth/show_auth',
        success: function(data) {
            jQuery('#window_auth').html(data);
            jQuery('#ah_reg').bind('click', function() {
                show_r();
            });
            if(jQuery('#autorizy')) {
                jQuery('#autorizy').bind('submit', function() {
                    ajaxauth();
                    return false;
                });
            }
        }
    });
}

function ajaxauth() {
    if(jQuery('#autorizy')) {
        jQuery.ajax({
            url: '/ajax/ajax/auth',
            type: 'POST',
            dataType: 'html',
            data: jQuery('#autorizy').serialize(), 
            success: function(response) {
                var obj = jQuery.parseJSON(response);
                if(obj.code == "success") {
                    window.location.href = '/admin';
                } else if(obj.code == "pass") {
                    jQuery('#password').css('border', '1px solid #bd2b2b');
                    jQuery('#password').bind('click', function() {
                        dell_val('password');
                    });
                }
                else {
                    jQuery('#username').css('border', '1px solid #bd2b2b');
                    jQuery('#username').bind('click', function() {
                        dell_val('username');
                    });
                    jQuery('#password').css('border', '1px solid #bd2b2b');
                    jQuery('#password').bind('click', function() {
                        dell_val('password');
                    });
                }
            },
            error: function(response) {
                alert('error');
            }
        });
    }
}

function newpass() {
    var pass = jQuery('#pass').val();
    var pass_confirm = jQuery('#pass_confirm').val();
    if(pass != "" && pass_confirm != "" && pass == pass_confirm) {
        if(jQuery('#reset')) {
            jQuery.ajax({
                url: '/ajax/ajax/auth/newpass',
                type: 'POST',
                dataType: 'html',
                data: jQuery('#reset').serialize(), 
                success: function(response) {
                    var obj = jQuery.parseJSON(response);
                    if(obj.code == "success") {
                        var pathname = location.hostname;
                        location.assign("http://"+pathname+"/admin/");
                    } else if(obj.code == "pass") {
                        jQuery('#password').css('border', '1px solid #bd2b2b');
                        jQuery('#password').bind('click', function() {
                            dell_val('password');
                        });
                    }
                    else {
                        jQuery('#username').css('border', '1px solid #bd2b2b');
                        jQuery('#username').bind('click', function() {
                            dell_val('username');
                        });
                        jQuery('#password').css('border', '1px solid #bd2b2b');
                        jQuery('#password').bind('click', function() {
                            dell_val('password');
                        });
                    }
                },
                error: function(response) {
                    alert('error');
                }
            });
        }
    } else {
        jQuery('#pass').css('border', '1px solid #bd2b2b');
        jQuery('#pass').bind('click', function() {
            dell_val('pass');
        });
        jQuery('#pass_confirm').css('border', '1px solid #bd2b2b');
        jQuery('#pass_confirm').bind('click', function() {
            dell_val('pass_confirm');
        });
    }
}

function ajaxreg() {
    if(jQuery('#fregistration')) {
        jQuery.ajax({
            url: '/ajax/ajax/auth/registaration',
            type: 'POST',
            dataType: 'html',
            data: jQuery('#fregistration').serialize(), 
            success: function(response) {
                var obj = jQuery.parseJSON(response);
                if(obj.code == "success") {
                    jQuery("#fregistration").html("<p>Регистрация прошла успешно!</p><p>Проверьте свою почту и подтвердите регистрацию, пройдя по ссылке</p>");
                } else {
                    jQuery("#result").html("<p>Неверно заполнены поля</p>");
                }
            },
            error: function(response) {
                alert('Ошибка сайта, обратитесь к администратору!');
            }
         });
    }
}

function exitus() {
    jQuery.ajax({
        url: '/ajax/ajax/auth/exit',
        type: 'POST',
        dataType: 'html',
        success: function(response) {
            location.reload();
        },
        error: function(response) {
            alert('error');
        }
     });
}