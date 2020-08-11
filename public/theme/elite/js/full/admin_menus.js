$(document).ready(function() {
    $('.save_menus').click(function(e){
        e.preventDefault();
        $.post(baseURL + "libs/classes/admin.php", $('#menuparts').serialize(),
            function(data) {
                if(data[0]=='@'){
                    eval(data.substr(1));
                }else{
                    $('.hdivmessages').css('top','-' + $('.hdivcontent').height()/2-125 + 'px').html(data).fadeIn(100).delay(fadeTime).fadeOut(500);
                }
            });
    });

    $('.delete_menu').click(function(e){
        e.preventDefault();
        obj = $(this);
        data = '<br/><div style="text-align: center;width: 240px;margin 0 auto;"><p style="color: #0000FF;font-weight: bold;font-size: 32px;">Confirm</p>&nbsp;<p style="color: #000;font-weight: bold;width:230px;padding:0 10px;">Are you sure you want to delete this menu?</p><a class="hdivbutton dodelmenu" href="#" style="margin: 5px 5px 5px 65px;">Delete</a><a class="hdivbutton canceldelmenu" href="#">Cancel</a></div>';
        $('.hdivmessages').css('top','-' + $('.hdivcontent').height()/2-125 + 'px').html(data);
        $('.hdivmessages').fadeIn(300);
        $('.canceldelmenu').click(function(ev){
            ev.preventDefault();
            $('.hdivmessages').css('top','-' + $('.hdivcontent').height()/2-125 + 'px').html('');
            $('.hdivmessages').fadeOut(500);
        });
        $('.dodelmenu').click(function(ev){
            ev.preventDefault();
            $.post(baseURL + "libs/classes/admin.php",
            {
                mode: 'removemenu',
                id: obj.attr('href')
            },
            function(data) {
                if(data[0]=='@'){
                    eval(data.substr(1));
                }else{
                    obj.parent().remove();
                    $('.hdivmessages').fadeOut(500);
                }
            });
        });
    });

    $('.addnewmenu').click(function(ev){
        ev.preventDefault();
        l = $('#page_lang').val();
        $.post(baseURL + "libs/classes/admin.php",
        {
            mode: 'addnewmenu',
            page_lang: $('#page_lang').val(),
            nmenu: $('#nmenu').val(),
            nlink: $('#nlink').val(),
            type: $('.hdivsubtab_active').attr('href')
        },
        function(data) {
            if(data[0]=='@'){
                eval(data.substr(1));
            }else{
                $('.hdivmessages').css('top','-' + $('.hdivcontent').height()/2-125 + 'px').html(data).fadeIn(100).delay(fadeTime).fadeOut(500);
                loadAdminContent(1,l,'menus');
            }
        });
    });

    //submenu part
    $('.hdivsubmenuholder').slideUp();
    $('#bottom_menu').hide();
    $('#side_menu').hide();

    $('.hdivhidemenubutton').click(function(e){
        e.preventDefault();
        id = $(this).attr('href');
        $('.smh_' + id).toggle();
    });

    $('.addsubmenu').click(function(e){
        e.preventDefault();
        obj = $(this);
        id = $(this).attr('href');
        l = $('#page_lang').val();
        mtitle = $(this).parent().find('#newsubmenu').val();
        mlink = $(this).parent().find('#newsubmenulink').val();

        $.post(baseURL + "libs/classes/admin.php",
        {
            mode: 'addnewsubmenu',
            page_lang: $('#page_lang').val(),
            nmenu: mtitle,
            nlink: mlink,
            mparent: id
        },
        function(data) {
            if(data[0]=='@'){
                eval(data.substr(1));
            }else{
                $('.hdivmessages').css('top','-' + $('.hdivcontent').height()/2-125 + 'px').html(data).fadeIn(100).delay(fadeTime).fadeOut(500);
                loadAdminContent(1,l,'menus');
            }
        });
    });

    $('#tmenu, #smenu, #bmenu').live('click',function(e){
        e.preventDefault();
        $('#tmenu, #smenu, #bmenu').attr('class','hdivsubtab_inactive');
        $(this).attr('class','hdivsubtab_active');
        $('#top_menu, #bottom_menu, #side_menu').hide();
        $('#' + $(this).attr('href') + '_menu').show('slow');
    //$('.hdivsubmenuholder').slideUp();
    });
    
    $('.upl_menu_img').each(function( index ) { 
        id = $(this).attr('id');
        $('#'+id).uploadify({
            'uploader'  : baseURL + 'libs/uploadify/uploadify.swf',
            'script'    : baseURL + 'libs/classes/upload_image.php',
            'cancelImg' : baseURL + 'libs/uploadify/cancel.png',
            'buttonImg': " ",
            'wmode': "transparent",
            'folder'    : 'images',
            'width': 20, 
            'height': 20,
            'scriptData': {
                'foldername':'images',
                'menuimages' : $(this).val(),
                'page_id' : page_id,
                'page_lang' : page_lang
            },
            'auto'      : true,
            'multi'       : false,
            'buttonText'  : 'Upload Images',
            'fileExt'     : '*.jpg;*.png;*.gif;',
            'fileDesc'    : 'Images',
            'onSelect':  function(file) { 
                $('.hdivcollapsebutton').addClass('mnloading');
            },
            'onComplete': function(event, queueID, fileObj, response, data) {
                $('.hdivcollapsebutton').removeClass('mnloading');
                tmp = response.split('#');
                $('#mtext2_'+tmp[1]).val(tmp[0]);
                $('#mtext22_'+tmp[1]).val(tmp[0]);
            }
        });
    });
});