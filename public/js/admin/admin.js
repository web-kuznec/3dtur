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

/*function show_r() {
    if($('h_reg')) {
        $('h_reg').setProperty('id', 'sh_reg');
        $('ah_reg').setAttribute('onclick', 'hide_r()');
    }
}

function hide_r() {
    if($('sh_reg')) {
        $('sh_reg').setProperty('id', 'h_reg');
        $('ah_reg').setAttribute('onclick', 'show_r()');
    }
}

function display_struct(id) {
    var pars = $H({ id:id }).toQueryString();
    var myRequest = new Request.HTML({
        url: '/ajax/ajax/struct/open/',
        method: 'POST',
        onComplete: function(a,b,c) {
            $('structure').set('html', c);
        }
    }).send(pars);
}

function close_struct(id) {
    var pars = $H({ id:id }).toQueryString();
    var myRequest = new Request.HTML({
        url: '/ajax/ajax/struct/close/',
        method: 'POST',
        onComplete: function(a,b,c) {
            $('structure').set('html', c);
        }
    }).send(pars);
}

function hide_struct(id) {
    if($$('.my_parent_'+id)) {
        var parent = $$('.my_parent_'+id);
        for(i=0;i<parent.length;i++){
            parent[i].toggleClass('struct_hide');
        }
    }
    $('aplus_'+id).setAttribute('onclick', 'display_struct('+id+')');
    $('plus_'+id).setAttribute('src', '/public/images/plus.gif');
}

function add_module() {
    draw_window();
    var myRequest = new Request.HTML({
        url: '/ajax/ajax/modules/new/',
        method: 'POST',
        onComplete: function(a,b,c) {
            $('div_abs').set('html', c);
        }
    }).send();
}

function create_module() {
    if($('module_new')) {
        $('module_new').set('send', {
            url: '/ajax/ajax/modules/create',
            method: 'POST',
            evalScripts: true,
            dataType: 'json',
            onComplete: function(a, b, c) {
                document.location.reload();
            }
        });
        $('module_new').send();
    }
}

function add_str(page) {
    draw_window();
    var pars = $H({ page:page }).toQueryString();
    var myRequest = new Request.HTML({
        url: '/ajax/ajax/struct/new/',
        method: 'POST',
        onComplete: function(a,b,c) {
            $('div_abs').set('html', c);
        }
    }).send(pars);
}

function edit_str(page) {
    draw_window();
    var pars = $H({ page:page }).toQueryString();
    var myRequest = new Request.HTML({
        url: '/ajax/ajax/struct/edit/',
        method: 'POST',
        onComplete: function(a,b,c) {
            $('div_abs').set('html', c);
        }
    }).send(pars);
}

function add_groupus() {
    draw_window();
    var pars = $H({ id:id }).toQueryString();
    var myRequest = new Request.HTML({
        url: '/ajax/ajax/groupus/add/',
        method: 'POST',
        onComplete: function(a,b,c) {
            $('div_abs').set('html', c);
        }
    }).send(pars);
}

function edit_groupus(id) {
    draw_window();
    var pars = $H({ id:id }).toQueryString();
    var myRequest = new Request.HTML({
        url: '/ajax/ajax/groupus/edit/',
        method: 'POST',
        onComplete: function(a,b,c) {
            $('div_abs').set('html', c);
        }
    }).send(pars);
}

function struct_check(func) {
    if($('struct_name').get('value') != "") {
        var struct_name = $('struct_name').get('value');
        var struct_url = $('struct_url').get('value');
        var table = "page";
        if($('dont')) {
            var dont = $('dont').get('value');
        } else {
            var dont = 0;
        }
        var pars = $H({
            struct_name:struct_name,
            struct_url:struct_url,
            table:table,
            dont:dont
        }).toQueryString();
        var myRequest = new Request.JSON({
            url: '/ajax/ajax/struct/check_dubl',
            method: 'POST',
            evalScripts: true,
            dataType: 'json',
            onSuccess: function(a) {
                if(a.code == "OK") {
                    window[func]();
                } else {
                    $('struct_url').setStyle('border', '1px solid #bd2b2b');
                    $('struct_url').setAttribute('onclick', "dell_val('struct_url');");
                    kuznya_scroll('struct_new');
                }
            }
        }).send(pars);
    } else {
        if($('struct_name').get('value') == "") {
            $('struct_name').setStyle('border', '1px solid #bd2b2b');
            $('struct_name').setAttribute('onclick', "dell_val('struct_name');");
        }
        kuznya_scroll('struct_new');
    }
}

function struct_new() {
    if($('struct_new')) {
        $('struct_new').set('send', {
            url: '/ajax/ajax/struct/create',
            method: 'POST',
            evalScripts: true,
            dataType: 'json',
            onComplete: function(a, b, c) {
                document.location.reload();
            }
        });
        $('struct_new').send();
    }
}

function struct_update() {
    if($('struct_new')) {
        $('struct_new').set('send', {
            url: '/ajax/ajax/struct/update',
            method: 'POST',
            evalScripts: true,
            dataType: 'json',
            onComplete: function(a, b, c) {
                document.location.reload();
            }
        });
        $('struct_new').send();
    } 
}

function stat_page(id, status) {
    var pars = $H({ id:id, status:status }).toQueryString();
    var myRequest = new Request.JSON({
        url: '/ajax/ajax/struct/status/',
        method: 'POST',
        evalScripts: true,
        dataType: 'json',
        onSuccess: function(a) {
            if(a.code == "OK") {
                if(status == 0) {
                    $('str_a'+id).set("onclick", "stat_page('"+id+"', '1')");
                    $('str_img'+id).set("src", "http://"+domen+"/public/images/st_on_16.png ");
                } else {
                    $('str_a'+id).set("onclick", "stat_page('"+id+"', '0')");
                    $('str_img'+id).set("src", "http://"+domen+"/public/images/st_off_16.png ");
                }
            }
        }
    }).send(pars);
}

function dell_page(id) {
    new MooDialog.Confirm('Удалить страницу?', function(){
        var p = $H({
            id:id
        }).toQueryString();
        var myRequest = new Request.HTML({
            url: '/ajax/ajax/struct/delete',
            method: 'POST',
            onComplete: function(a,b,c) {
                document.location.reload();
            }
        }).send(p);
    });
}

function add_news() {
    draw_window();
    var myRequest = new Request.HTML({
        url: '/ajax/ajax/news/new',
        method: 'POST',
        onComplete: function(a,b,c) {
            $('div_abs').set('html', c);
            var inject = $('div_abs');
            new Picker.Date($$('input.date'), {
                timePicker: true,
                positionOffset: {
                    x: 5, 
                    y: 0
                },
                pickerClass: 'datepicker_vista',
                useFadeInOut: !Browser.ie,
                inject: inject
            });
            setup();
        }
    }).send();
}

function add_articles() {
    draw_window();
    var myRequest = new Request.HTML({
        url: '/ajax/ajax/articles/new',
        method: 'POST',
        onComplete: function(a,b,c) {
            $('div_abs').set('html', c);
            var inject = $('div_abs');
            new Picker.Date($$('input.date'), {
                timePicker: true,
                positionOffset: {
                    x: 5, 
                    y: 0
                },
                pickerClass: 'datepicker_vista',
                useFadeInOut: !Browser.ie,
                inject: inject
            });
            setup();
        }
    }).send();
}

function news_check(func) {
    if($('news_name').get('value') != "" || $('news_url').get('value') != "" || $('news_date').get('value') == "") {
        var news_url = $('news_url').get('value');
        var table = "news";
        if($('dont')) {
            var dont = $('dont').get('value');
        } else {
            var dont = "";
        }
        var pars = $H({
            news_url:news_url,
            table:table,
            dont:dont
        }).toQueryString();
        var myRequest = new Request.JSON({
            url: '/ajax/ajax/news/check_dubl',
            method: 'POST',
            evalScripts: true,
            dataType: 'json',
            onSuccess: function(a) {
                if(a.code == "OK") {
                    window[func]();
                } else {
                    $('news_url').setStyle('border', '1px solid #bd2b2b');
                    $('news_url').setAttribute('onclick', "dell_val('news_url');");
                    kuznya_scroll('news_new');
                }
            }
        }).send(pars);
    } else {
        if($('news_name').get('value') != "") {
            $('news_name').setStyle('border', '1px solid #bd2b2b');
            $('news_name').setAttribute('onclick', "dell_val('news_name');");
        }
        if($('news_url').get('value') != "") {
            $('news_url').setStyle('border', '1px solid #bd2b2b');
            $('news_url').setAttribute('onclick', "dell_val('news_url');");
        }
        if($('news_date').get('value') != "") {
            $('news_date').setStyle('border', '1px solid #bd2b2b');
            $('news_date').setAttribute('onclick', "dell_val('news_date');");
        }
        kuznya_scroll('news_new');
    }
}

function articles_check(func) {
    if($('news_name').get('value') != "" || $('news_url').get('value') != "" || $('news_date').get('value') == "") {
        var news_url = $('news_url').get('value');
        var table = "news";
        if($('dont')) {
            var dont = $('dont').get('value');
        } else {
            var dont = "";
        }
        var pars = $H({
            news_url:news_url,
            table:table,
            dont:dont
        }).toQueryString();
        var myRequest = new Request.JSON({
            url: '/ajax/ajax/articles/check_dubl',
            method: 'POST',
            evalScripts: true,
            dataType: 'json',
            onSuccess: function(a) {
                if(a.code == "OK") {
                    window[func]();
                } else {
                    $('news_url').setStyle('border', '1px solid #bd2b2b');
                    $('news_url').setAttribute('onclick', "dell_val('news_url');");
                    kuznya_scroll('news_new');
                }
            }
        }).send(pars);
    } else {
        if($('news_name').get('value') != "") {
            $('news_name').setStyle('border', '1px solid #bd2b2b');
            $('news_name').setAttribute('onclick', "dell_val('news_name');");
        }
        if($('news_url').get('value') != "") {
            $('news_url').setStyle('border', '1px solid #bd2b2b');
            $('news_url').setAttribute('onclick', "dell_val('news_url');");
        }
        if($('news_date').get('value') != "") {
            $('news_date').setStyle('border', '1px solid #bd2b2b');
            $('news_date').setAttribute('onclick', "dell_val('news_date');");
        }
        kuznya_scroll('news_new');
    }
}

function groupus_check(func) {
    if($('groupus_name').get('value') == "" ) {
        $('groupus_name').setStyle('border', '1px solid #bd2b2b');
        $('groupus_name').setAttribute('onclick', "dell_val('groupus_name');");
    } else {
         window[func]();
    }
}

function create_groupus() {
    $('groupus_edit').set('send', {
        url: '/ajax/ajax/groupus/create',
        method: 'POST',
        evalScripts: true,
        onComplete: function() {
            window.location.reload();
        }
    });
    $('groupus_edit').send();
}

function add_groupus() {
    draw_window();
    var myRequest = new Request.HTML({
        url: '/ajax/ajax/groupus/add/',
        method: 'POST',
        onComplete: function(a,b,c) {
            $('div_abs').set('html', c);
        }
    }).send();
}

function update_groupus() {
    $('groupus_edit').set('send', {
        url: '/ajax/ajax/groupus/update',
        method: 'POST',
        evalScripts: true,
        onComplete: function() {
            window.location.reload();
        }
    });
    $('groupus_edit').send();
}

function news_new() {
    if($('news_new')) {
        $('news_new').set('send', {
            url: '/ajax/ajax/news/create',
            method: 'POST',
            evalScripts: true,
            dataType: 'json',
            onComplete: function(a, b, c) {
                document.location.reload();
            }
        });
        $('news_new').send();
    }
}

function articles_new() {
    if($('news_new')) {
        $('news_new').set('send', {
            url: '/ajax/ajax/articles/create',
            method: 'POST',
            evalScripts: true,
            dataType: 'json',
            onComplete: function(a, b, c) {
                document.location.reload();
            }
        });
        $('news_new').send();
    }
}

function news_update() {
    if($('news_new')) {
        $('news_new').set('send', {
            url: '/ajax/ajax/news/update',
            method: 'POST',
            evalScripts: true,
            dataType: 'json',
            onComplete: function(a, b, c) {
                document.location.reload();
            }
        });
        $('news_new').send();
    }
}

function articles_update() {
    if($('news_new')) {
        $('news_new').set('send', {
            url: '/ajax/ajax/articles/update',
            method: 'POST',
            evalScripts: true,
            dataType: 'json',
            onComplete: function(a, b, c) {
                document.location.reload();
            }
        });
        $('news_new').send();
    }
}

function edit_news(id) {
    draw_window();
    var p = $H({ id:id }).toQueryString();
    var myRequest = new Request.HTML({
        url: '/ajax/ajax/news/edit',
        method: 'POST',
        onComplete: function(a,b,c) {
            $('div_abs').set('html', c);
            var inject = $('div_abs');
            new Picker.Date($$('input.date'), {
                timePicker: true,
                positionOffset: {
                    x: 5, 
                    y: 0
                },
                pickerClass: 'datepicker_vista',
                useFadeInOut: !Browser.ie,
                inject: inject
            });
            setup();
        }
    }).send(p);
}

function edit_articles(id) {
    draw_window();
    var p = $H({ id:id }).toQueryString();
    var myRequest = new Request.HTML({
        url: '/ajax/ajax/articles/edit',
        method: 'POST',
        onComplete: function(a,b,c) {
            $('div_abs').set('html', c);
            var inject = $('div_abs');
            new Picker.Date($$('input.date'), {
                timePicker: true,
                positionOffset: {
                    x: 5, 
                    y: 0
                },
                pickerClass: 'datepicker_vista',
                useFadeInOut: !Browser.ie,
                inject: inject
            });
            setup();
        }
    }).send(p);
}

function stat_news(id, status) {
    if(status == 0) {
        status = 1;
    } else {
        status = 0;
    }
    var p = $H({ id:id, status:status }).toQueryString();
    var myRequest = new Request.JSON({
        url: '/ajax/ajax/news/status',
        method: 'POST',
        dataType: 'json',
            onSuccess: function(a) {
                if(a.code == "OK") {
                    if($('str_a'+id)) {
                        $('str_a'+id).set('onclick', 'stat_news("'+id+'", "'+status+'");');
                    }
                    if($('str_img'+id)) {
                        if(status == 1) {
                            $('str_img'+id).set('src', '/public/images/st_on_16.png');
                        } else {
                            $('str_img'+id).set('src', '/public/images/st_off_16.png');
                        }
                    }
                }
            }
    }).send(p);
}

function stat_articles(id, status) {
    if(status == 0) {
        status = 1;
    } else {
        status = 0;
    }
    var p = $H({ id:id, status:status }).toQueryString();
    var myRequest = new Request.JSON({
        url: '/ajax/ajax/articles/status',
        method: 'POST',
        dataType: 'json',
            onSuccess: function(a) {
                if(a.code == "OK") {
                    if($('str_a'+id)) {
                        $('str_a'+id).set('onclick', 'stat_articles("'+id+'", "'+status+'");');
                    }
                    if($('str_img'+id)) {
                        if(status == 1) {
                            $('str_img'+id).set('src', '/public/images/st_on_16.png');
                        } else {
                            $('str_img'+id).set('src', '/public/images/st_off_16.png');
                        }
                    }
                }
            }
    }).send(p);
}

function stat_user(id, status) {
    if(status == 0) {
        status = 1;
    } else {
        status = 0;
    }
    var p = $H({ id:id, status:status }).toQueryString();
    var myRequest = new Request.JSON({
        url: '/ajax/ajax/users/status',
        method: 'POST',
        dataType: 'json',
            onSuccess: function(a) {
                if(a.code == "OK") {
                    if($('str_a'+id)) {
                        $('str_a'+id).set('onclick', 'stat_user("'+id+'", "'+status+'");');
                    }
                    if($('str_img'+id)) {
                        if(status == 1) {
                            $('str_img'+id).set('src', '/public/images/st_on_16.png');
                        } else {
                            $('str_img'+id).set('src', '/public/images/st_off_16.png');
                        }
                    }
                }
            }
    }).send(p);
}

function stat_groupus(id, status) {
    if(status == 0) {
        status = 1;
    } else {
        status = 0;
    }
    var p = $H({ id:id, status:status }).toQueryString();
    var myRequest = new Request.JSON({
        url: '/ajax/ajax/groupus/status',
        method: 'POST',
        dataType: 'json',
            onSuccess: function(a) {
                if(a.code == "OK") {
                    if($('str_a'+id)) {
                        $('str_a'+id).set('onclick', 'stat_groupus("'+id+'", "'+status+'");');
                    }
                    if($('str_img'+id)) {
                        if(status == 1) {
                            $('str_img'+id).set('src', '/public/images/st_on_16.png');
                        } else {
                            $('str_img'+id).set('src', '/public/images/st_off_16.png');
                        }
                    }
                }
            }
    }).send(p);
}

function dell_news(id) {
    new MooDialog.Confirm('Удалить новость?', function(){
        var p = $H({ id:id }).toQueryString();
        var myRequest = new Request.HTML({
            url: '/ajax/ajax/news/dell',
            method: 'POST',
            onComplete: function(a,b,c) {
                document.location.reload();
            }
        }).send(p);
    });
}

function dell_articles(id) {
    new MooDialog.Confirm('Удалить статью?', function(){
        var p = $H({ id:id }).toQueryString();
        var myRequest = new Request.HTML({
            url: '/ajax/ajax/articles/dell',
            method: 'POST',
            onComplete: function(a,b,c) {
                document.location.reload();
            }
        }).send(p);
    });
}

function dell_user(id) {
    new MooDialog.Confirm('Удалить пользователя?', function(){
        var p = $H({ id:id }).toQueryString();
        var myRequest = new Request.HTML({
            url: '/ajax/ajax/users/dell',
            method: 'POST',
            onComplete: function(a,b,c) {
                document.location.reload();
            }
        }).send(p);
    });
}

function dell_groupus(id) {
    new MooDialog.Confirm('Удалить группу?', function(){
        var p = $H({ id:id }).toQueryString();
        var myRequest = new Request.HTML({
            url: '/ajax/ajax/groupus/dell',
            method: 'POST',
            onComplete: function(a,b,c) {
                document.location.reload();
            }
        }).send(p);
    });
}

function news_recovery(id) {
    var p = $H({ id:id }).toQueryString();
    var myRequest = new Request.HTML({
        url: '/ajax/ajax/news/recovery',
        method: 'POST',
        onComplete: function(a,b,c) {
            document.location.reload();
        }
    }).send(p);
}

function dell_rolem(module, role) {
    var pars = $H({
        module:module, 
        role:role
    }).toQueryString();
    var myRequest = new Request.HTML({
        url: '/ajax/ajax/modules/del_link_role',
        method: 'POST',
        onComplete: function() {
            if($('role_'+module)) {
                $('role_'+module).destroy();
            }
        }
    }).send(pars);
}

function add_rolemod(module) {
    var role = $('srole_'+module).get('value');
    var pars = $H({
        module:module, 
        role:role
    }).toQueryString();     
    var myRequest = new Request.HTML({
        url: '/ajax/ajax/modules/add_link_role',
        method: 'POST',
        onComplete: function() {
            document.location.reload();
        //show_modules();
        }
    }).send(pars);
}

function add_banner() {
    draw_window();
    var myRequest = new Request.HTML({
        url: '/ajax/ajax/reklama/new',
        method: 'POST',
        onComplete: function(a,b,c) {
            $('div_abs').set('html', c);
            var myFx = new Fx.Scroll(window).toElement('window_admin_middle', 'y');
            var inject = $('div_abs');
            new Picker.Date($$('input.date'), {
                timePicker: true,
                positionOffset: {
                    x: 5, 
                    y: 0
                },
                pickerClass: 'datepicker_vista',
                useFadeInOut: !Browser.ie,
                inject: inject
            });
        }
    }).send();
}

function banner_check(func) {
    var width = $('banner_width').get('value');
    var height = $('banner_height').get('value');
    var page = $('banner_page').get('value');
    if($('banner_place')) {
        var place = $('banner_place').get('value');
    } else {
        var place = "";
    }
    if(!width.match(/[0-9]/) || !height.match(/[0-9]/) || page == 0 || place == "" ) {
        if(!width.match(/[0-9]/)) {
            $('banner_width').setStyle('border', '1px solid #bd2b2b');
            $('banner_width').setAttribute('onclick', "dell_val('banner_width');");
        }
        if(!height.match(/[0-9]/)) {
            $('banner_height').setStyle('border', '1px solid #bd2b2b');
            $('banner_height').setAttribute('onclick', "dell_val('banner_height');");
        }
        if(!page.match(/[0-9]/)) {
            $('banner_page').setStyle('border', '1px solid #bd2b2b');
            $('banner_page').setAttribute('onclick', "dell_val('banner_page');");
        }
        if(place == "") {
            $('banner_page').setStyle('border', '1px solid #bd2b2b');
            $('banner_page').setAttribute('onclick', "dell_val('banner_page');");
        }
        kuznya_scroll('window_admin_middle');
    } else {
        window[func]();
    }
}

function banner_new() {
    $('banner_new').set('send', {
        url: '/ajax/ajax/reklama/add',
        method: 'POST',
        evalScripts: true,
        onComplete: function() {
            window.location.reload();
        }
    });
    $('banner_new').send();
}

function banner_save() {
    $('banner_new').set('send', {
        url: '/ajax/ajax/reklama/save',
        method: 'POST',
        evalScripts: true,
        onComplete: function() {
            window.location.reload();
        }
    });
    $('banner_new').send();
}

function show_place() {
    if($('banner_page')) {
        var place = $('banner_page').get('value');
        var pars = $H({
            place:place
        }).toQueryString();
        var myRequest = new Request.HTML({
            url: '/ajax/ajax/reklama/getplace',
            method: 'POST',
            onComplete: function(a,b,c) {
                $('update_place').innerHTML = c;
            }
        }).send(pars);
    }
}

function dell_ban(id) {
    new MooDialog.Confirm('Удалить баннер?', function(){
        var p = $H({
            id:id
        }).toQueryString();
        var myRequest = new Request.HTML({
            url: '/ajax/ajax/reklama/dellban',
            method: 'POST',
            onComplete: function(a,b,c) {
                document.location.reload();
            }
        }).send(p);
    });
}

function edit_ban(id) {
    draw_window();
    var pars = $H({ id:id }).toQueryString();
    var myRequest = new Request.HTML({
        url: '/ajax/ajax/reklama/edit',
        method: 'POST',
        onComplete: function(a,b,c) {
            $('div_abs').set('html', c);
            var inject = $('div_abs');
            new Picker.Date($$('input.date'), {
                timePicker: true,
                positionOffset: {
                    x: 5, 
                    y: 0
                },
                pickerClass: 'datepicker_vista',
                useFadeInOut: !Browser.ie,
                inject: inject
            });
        }
    }).send(pars);
}

function add_works() {
    draw_window();
    var myRequest = new Request.HTML({
        url: '/ajax/ajax/works/new/',
        method: 'POST',
        onComplete: function(a,b,c) {
            $('div_abs').set('html', c);
        }
    }).send();
}

function works_check(func) {
    if($('works_name').get('value') != "" && $('works_url').get('value') != "") {
        var works_name = $('works_name').get('value');
        var works_url = $('works_url').get('value');
        var table = "works";
        if($('dont')) {
            var dont = $('dont').get('value');
        } else {
            var dont = 0;
        }
        var pars = $H({
            works_name:works_name,
            works_url:works_url,
            table:table,
            dont:dont
        }).toQueryString();
        var myRequest = new Request.JSON({
            url: '/ajax/ajax/works/check_dubl',
            method: 'POST',
            evalScripts: true,
            dataType: 'json',
            onSuccess: function(a) {
                if(a.code == "OK") {
                    window[func]();
                } else {
                    $('works_url').setStyle('border', '1px solid #bd2b2b');
                    $('works_url').setAttribute('onclick', "dell_val('works_url');");
                    kuznya_scroll('works_url');
                }
            }
        }).send(pars);
    } else {
        if($('works_name').get('value') == "") {
            $('works_name').setStyle('border', '1px solid #bd2b2b');
            $('works_name').setAttribute('onclick', "dell_val('works_name');");
        }
        if($('works_url').get('value') == "") {
            $('works_url').setStyle('border', '1px solid #bd2b2b');
            $('works_url').setAttribute('onclick', "dell_val('works_url');");
        }
        kuznya_scroll('works_new');
    }
}

function works_new() {
    if($('works_new')) {
        $('works_new').set('send', {
            url: '/ajax/ajax/works/create',
            method: 'POST',
            evalScripts: true,
            dataType: 'json',
            onComplete: function(a, b, c) {
                document.location.reload();
            }
        });
        $('works_new').send();
    }
}

function stat_work(id, status) {
    var pars = $H({ id:id, status:status }).toQueryString();
    var myRequest = new Request.JSON({
        url: '/ajax/ajax/works/status/',
        method: 'POST',
        evalScripts: true,
        dataType: 'json',
        onSuccess: function(a) {
            if(a.code == "OK") {
                if(status == 0) {
                    $('str_a'+id).set("onclick", "stat_page('"+id+"', '1')");
                    $('str_img'+id).set("src", "http://"+domen+"/public/images/st_on_16.png ");
                } else {
                    $('str_a'+id).set("onclick", "stat_page('"+id+"', '0')");
                    $('str_img'+id).set("src", "http://"+domen+"/public/images/st_off_16.png ");
                }
            }
        }
    }).send(pars);
}

function dell_works(id) {
    new MooDialog.Confirm('Удалить работу?', function(){
        var p = $H({ id:id }).toQueryString();
        var myRequest = new Request.HTML({
            url: '/ajax/ajax/works/dell',
            method: 'POST',
            onComplete: function(a,b,c) {
                document.location.reload();
            }
        }).send(p);
    });
}

function edit_works(id) {
    draw_window();
    var p = $H({ id:id }).toQueryString();
    var myRequest = new Request.HTML({
        url: '/ajax/ajax/works/edit/',
        method: 'POST',
        onComplete: function(a,b,c) {
            $('div_abs').set('html', c);
        }
    }).send(p);
}

function works_edit() {
    if($('works_new')) {
        $('works_new').set('send', {
            url: '/ajax/ajax/works/update',
            method: 'POST',
            evalScripts: true,
            dataType: 'json',
            onComplete: function(a, b, c) {
                document.location.reload();
            }
        });
        $('works_new').send();
    }
}*/