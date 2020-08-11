$(document).ready(function() {
    page_id = $('#page_id').val();
    page_lang = $('#page_lang').val();
    
    $('.copypage').click(function(e){
        e.preventDefault();
        $.post(baseURL + "libs/classes/admin.php", {
            mode: "getelements_forcopy",
            page_lang : page_lang
        },
        function(data) {
            if(data[0]=='@'){
                eval(data.substr(1));
            }else{
                $('.hdivmessages').css('top','-' + $('.hdivcontent').height()/2-125 + 'px').html(data);
                $('.hdivmessages').fadeIn(300);
                $('.cancelcopy').click(function(ev){
                    ev.preventDefault();
                    $('.hdivmessages').css('top','-' + $('.hdivcontent').height()/2-125 + 'px').html('');
                    $('.hdivmessages').fadeOut(500);
                });
                $('.docopy').click(function(ev){
                    ev.preventDefault();
                    $.post(baseURL + "libs/classes/admin.php", {
                        mode: "docopy",
                        page_id: page_id,
                        page_lang : page_lang,
                        target: $('#copytarget').val(),
                        element: $('input[type=radio]:checked').val()
                    },
                    function(data) {
                        loadAdminContent(page_id, page_lang,'pages');
                        $('.hdivmessages').css('top','-' + $('.hdivcontent').height()/2-125 + 'px').html(data).delay(fadeTime).fadeOut(500);
                    });
                });
            }
        });
    });

    $('#selpage').change(function(){ 
        location.href = $(this).val();
    });

    $('.createpage').click(function(e){
        e.preventDefault();
        if($('#createpage').val().trim() != ''){
            
            $.post(baseURL + "libs/classes/admin.php", {
                mode: "createpage",
                page_lang : page_lang,
                page: $('#createpage').val().trim()
            },
            function(data) {
                if(data[0]=='@'){
                    eval(data.substr(1));
                }else{
                    $('.hdivmessages').css('top','-' + $('.hdivcontent').height()/2-125 + 'px').html(data).fadeIn(100).delay(fadeTime).fadeOut(500);
                    loadAdminContent(page_id, page_lang,'pages');
                }
            });
            
        }else{
            $('.hdivmessages').css('top','-' + $('.hdivcontent').height()/2-125 + 'px').html('<br/><div style="text-align: center;width: 240px;margin 0 auto;"><p style="color: #FF0000;font-weight: bold;font-size: 32px;">Error</p>&nbsp;<p style="color: #000;font-weight: bold;">Page name cannot be empty!</p></div>');
            $('.hdivmessages').fadeIn(100).delay(fadeTimev).fadeOut(500);
        }
    });

    $('.delpage').click(function(e){
        e.preventDefault();

        $('.hdivmessages').css('top','-' + $('.hdivcontent').height()/2-125 + 'px').html('<br/><div style="text-align: center;width: 240px;margin 0 auto;"><p style="color: #00FF00;font-weight: bold;font-size: 32px;">Confirm</p><p style="color: #000;font-weight: bold;width:230px;padding:0 10px;">Are you sure you want to delete <br/>' + $('#delpage option:selected').text() + '</p></div><div class="hdivgadgetrow" style="margin: 20px 0;"><a class="hdivbutton dodel" href="#" style="margin: 5px 5px 5px 65px;">Delete</a><a class="hdivbutton cancelcopy" href="#">Cancel</a></div>');
        $('.hdivmessages').fadeIn(200);
        $('.cancelcopy').click(function(ev){
            ev.preventDefault();
            $('.hdivmessages').css('top','-' + $('.hdivcontent').height()/2-125 + 'px').html('');
            $('.hdivmessages').fadeOut(500);
        });
        $('.dodel').click(function(ev){
            ev.preventDefault();
            $.post(baseURL + "libs/classes/admin.php", {
                mode: "delpage",
                page: $('#delpage option:selected').text(),
                pid: $('#delpage').val()
            },
            function(data) {
                if(data[0]=='@'){
                    eval(data.substr(1));
                }else{
                    $('.hdivmessages').css('top','-' + $('.hdivcontent').height()/2-125 + 'px').html(data);
                    $("#delpage option[value='"+$('#delpage').val()+"']").remove();
                    $("#p_"+$('#delpage').val()).remove();
                    $('.hdivmessages').delay(fadeTime).fadeOut(500);
                    if($('#delpage').val() == page_id){
                        location.reload();
                    }
                }
            });
        });
    });

    $('.pagepublish').click(function(e){
        e.preventDefault();
        $.post(baseURL + "libs/classes/admin.php", {
            mode: "publishpage",
            state: $('#pagestate').val(),
            page_id: page_id,
            page_lang: page_lang
        },
        function(data) {
            $('.hdivmessages').css('top','-' + $('.hdivcontent').height()/2-125 + 'px').fadeIn(200).html(data).delay(fadeTime).fadeOut(500);
            loadAdminContent(page_id, page_lang,'pages');
        });
    });

    $('.savemeta').click(function(e){
        e.preventDefault();
        $.post(baseURL + "libs/classes/admin.php", {
            mode: "savemeta",
            page_id: page_id,
            page_lang: page_lang,
            ptitle: $('#page_title').val(),
            pmtitle: $('#page_main_title').val(),
            pdescr: $('#page_descr').val(),
            pkeyw: $('#page_keywords').val(),
            pchangef: $('#changefreq').val(),
            ppriority: $('#priority').val()
        },
        function(data) {
            $('.hdivmessages').css('top','-' + $('.hdivcontent').height()/2-125 + 'px').fadeIn(200).html(data).delay(fadeTime).fadeOut(500);
        });
    });

    $('.addelement').click(function(e){
        e.preventDefault();
        if($('#element_list').val()!=''){
            $.post(baseURL + "libs/classes/admin.php", {
                mode: "addelement",
                page_id: page_id,
                page_lang: page_lang,
                element: $('#element_list').val()
            },
            function(data) {
                if(data[0]=='@'){
                    eval(data.substr(1));
                }else{
                    if(data[0]=='%'){
                        $('.elements_right').append(data.substr(1));
                    }else{
                        $('.elements').append(data);
                    }
                    $('.hdivmessages').css('top','-' + $('.hdivcontent').height()/2-125 + 'px').html('<br/><div style="text-align: center;width: 240px;margin 0 auto;"><p style="color: #00FF00;font-weight: bold;font-size: 32px;">Success</p>&nbsp;<p style="color: #000;font-weight: bold;">Element was added!</p></div>');
                    $('.hdivmessages').fadeIn(100).delay(fadeTime).fadeOut(500);
                    
                    //resize img - added to support resizing without reload
                    $('.advancedimageelement, .settableseparatorelement').resizable({
                        maxHeight: 600,
                        maxWidth: 740,
                        minHeight: 50,
                        minWidth: 200,
                        animate: false,
                        stop: function(event, ui) {
                            var width = ui.size.width;
                            var height = ui.size.height;
                            var id = ui.originalElement.attr("id").split('_')[1];
             
                            $.post(baseURL + "libs/classes/admin.php", {
                                mode: "edit_adv_image",
                                page_id: page_id,
                                page_lang: page_lang,
                                id: id,
                                width: width,
                                height: height
                            },
                            function(data) { 
                                if(data[0]=='@'){
                                    eval(data.substr(1));
                                }else{
                                //$('.elem_edit').trigger('click');
                                }
                            });
                        }
                    });
                }
            });
        }else{
            $('.hdivmessages').css('top','-' + $('.hdivcontent').height()/2-125 + 'px').html('<br/><div style="text-align: center;width: 240px;margin 0 auto;"><p style="color: #FF0000;font-weight: bold;font-size: 32px;">Error</p>&nbsp;<p style="color: #000;font-weight: bold;">Select an element first!</p></div>');
            $('.hdivmessages').fadeIn(100).delay(fadeTime).fadeOut(500);
        }
    });

    $('.savebanner').click(function(e){
        e.preventDefault();
        $.post(baseURL + "libs/classes/admin.php", {
            mode: "savebanner",
            page_id: page_id,
            page_lang: page_lang,
            banner_title: $('#banner_title').val(),
            banner_link: $('#banner_link').val()
        },
        function(data) {
            loadAdminContent(page_id, page_lang, 'pages');
        });
    });

    //upload bg images controls
    $('.page_banner_container').hide();
    $('.news_holder').hide();

    $('.show_meta').click(function(e){
        e.preventDefault();
        $('.page_banner_container:visible').hide();
        $('.page_detail_container').show('slide');
    });

    $('.show_banner').click(function(e){
        e.preventDefault();
        $('.page_detail_container:visible').hide();
        $('.page_banner_container').show('slide');
    });

    $('.show_news').click(function(e){
        e.preventDefault();
        $('.bgimage_uploader').hide();
        $('.news_holder').show('slide');
    });

    $('.save_admin_news').click(function(e){ 
        e.preventDefault();
        $.post(baseURL + "libs/classes/admin.php", {
            mode: "savenews",
            page_id: page_id,
            page_lang: page_lang,
            news1_title: $('#news_title_1').val().trim(),
            news1_link: $('#news_link_1').val().trim(),
            news2_title: $('#news_title_2').val().trim(),
            news2_link: $('#news_link_2').val().trim(),
            news3_title: $('#news_title_3').val().trim(),
            news3_link: $('#news_link_3').val().trim()
        },
        function(data) {
            if(data[0]=='@'){
                eval(data.substr(1));
            }else{
                $('.hdivmessages').css('top','-' + $('.hdivcontent').height()/2-125 + 'px').html(data).fadeIn(100).delay(fadeTime).fadeOut(500);
            }
        });
    });

    $('.remove_bgimage').dblclick(function(e){
        e.preventDefault();
        obj = $(this);
        $('.hdivmessages').css('top','-' + $('.hdivcontent').height()/2-125 + 'px').html('<br/><div style="text-align: center;width: 240px;margin 0 auto;"><p style="color: #00FF00;font-weight: bold;font-size: 32px;">Confirm</p><p style="color: #000;font-weight: bold;width:230px;padding:0 10px;">Are you sure you want to delete this image</p></div><div class="hdivgadgetrow" style="margin: 20px 0;"><a class="hdivbutton dodelbgimg" href="#" style="margin: 5px 5px 5px 65px;">Delete</a><a class="hdivbutton cancelcopy" href="#">Cancel</a></div>');
        $('.hdivmessages').fadeIn(200);
        $('.cancelcopy').click(function(ev){
            ev.preventDefault();
            $('.hdivmessages').css('top','-' + $('.hdivcontent').height()/2-125 + 'px').html('');
            $('.hdivmessages').fadeOut(500);
        });
        $('.dodelbgimg').click(function(ev){
            ev.preventDefault();
            $.post(baseURL + "libs/classes/admin.php", {
                mode: "delbgimg",
                simg: obj.attr('alt'),
                page_id: page_id,
                page_lang: page_lang
            },
            function(data) {
                if(data[0]=='@'){
                    eval(data.substr(1));
                }else{
                    if(data[0]=='%'){
                        obj.remove();
                        data = data.substr(1);
                    }
                    $('.hdivmessages').css('top','-' + $('.hdivcontent').height()/2-125 + 'px').html(data);
                    $('.hdivmessages').delay(fadeTime).fadeOut(500);
                }
            });
            
        });
    });


    //for upload of bg imgs
    /*$('#file_upload').uploadify({
        'uploader'  : baseURL + 'libs/uploadify/uploadify.swf',
        'script'    : baseURL + 'libs/classes/upload_image.php',
        'cancelImg' : baseURL + 'libs/uploadify/cancel.png',
        'folder'    : 'images',
        'scriptData': {
            'foldername':'images',
            'bgimages' : '1',
            'page_id' : page_id,
            'page_lang' : page_lang
        },
        'auto'      : true,
        'multi'       : true,
        'buttonText'  : 'Upload Images',
        'fileExt'     : '*.jpg;*.png;*.gif;',
        'fileDesc'    : 'Images',
        'onSelectOnce' : function(event,data) {
            $('.bgimages_list').html('<div style="display: block; float: none;width: 80px;margin:20px auto;"><object type="application/x-shockwave-flash" data="' + baseURL + 'files/swf/loader.swf" width="80" height="80"><param name="movie" value="' + baseURL + 'files/swf/loader.swf" /><param name="wmode" value="transparent"></object></div>');
        },
        //onComplete: function(event, queueID, fileObj, response, data) {
        //    alert(response);
        //},
        'onAllComplete' : function(event,data) {
            loadAdminContent(page_id, page_lang, 'pages');
        }
    });*/
    
});