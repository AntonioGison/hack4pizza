$(document).ready(function() {

    //init menu
    var disableGadget = 0;
    page_id = $('#page_id').val();
    page_lang = $('#page_lang').val();
    $('#gadgetDiv').hide();
    $('.hdivmessages').html('');
    $('.hdivmessages').fadeOut();
    loadAdminMenu();
    loadAdminContent(page_id, page_lang);
    $('.hdinactivetabicon, .hdivactivetabcontent').live({
        mouseenter:function () {
            $(this).parent().parent().find('.tabdisplay').html($(this).attr('title'));
        },
        mouseleave:function () {
            $(this).parent().parent().find('.tabdisplay').html($(this).parent().parent().find('.hdivactivetabcontent').attr('title'));
        }
    });
        
            
    //resize img
    $('.advancedimageelement, .settableseparatorelement, .advancedparagraph').resizable({
        maxHeight: 600,
        maxWidth: 690,
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
	
    $('.get_original_size').live('click', function(e){
        e.preventDefault();
        $.post(baseURL + "libs/classes/admin.php", {
            mode: "get_orig_size",
            img: $('.filenameholder').val()
        },
        function(data) { 
            if(data[0]=='@'){
                eval(data.substr(1));
            }else{
                t = data.split('::');
                $('#e_ewidth').val(t[0]);
                $('#e_eheight').val(t[1]);
            }
        });
    });
        
    $('.hdinactivetabicon').live("click",function(e){
        if (e.button != 0) {
            // wasn't the left button - ignore
            return true;
        }
        e.preventDefault();
        $('.hdivmessages').html('');
        $('.hdivmessages').hide();
        showLoader();
        obj = $(this);
        loadAdminMenu(obj.attr('title').toLowerCase());
        loadAdminContent(page_id,page_lang,obj.attr('title').toLowerCase());
        return false;
    });

    $(".elements").sortable({
        cursor: 'move',
        start: function( event, ui ) {
            $('#gadgetDiv').hide();
            disableGadget = 1;
        },
        update: function() {
            var order = $(this).sortable("serialize") + '&mode=updateRecordsListings';
            $.post(baseURL + "libs/classes/admin.php", order, function(theResponse){ 

                });
        },
        stop: function( event, ui ) {
            $('#gadgetDiv').css('top', $('#'+ui.item.attr('id')).offset().top);
            $('#gadgetDiv').css('left', $('#'+ui.item.attr('id')).offset().left);
            $('#gadgetDiv').fadeIn(400);
            disableGadget = 0;
        }
    });
    
    $(".elements_right").sortable({
        cursor: 'move',
        start: function( event, ui ) {
            $('#gadgetDiv').hide();
            disableGadget = 1;
        },
        update: function() {
            var order = $(this).sortable("serialize") + '&mode=updateRecordsListings_right';
            $.post(baseURL + "libs/classes/admin.php", order, function(theResponse){
                
                });
        },
        stop: function( event, ui ) {
            $('#gadgetDiv').css('top', $('#'+ui.item.attr('id')).offset().top);
            $('#gadgetDiv').css('left', $('#'+ui.item.attr('id')).offset().left);
            $('#gadgetDiv').fadeIn(400);
            disableGadget = 0;
        }
    });

    $("[id^=elementlistline_]").live("mouseenter",function(e){
        e.preventDefault();
        if(e.type=="mouseenter" && !disableGadget){
            $('#gadgetDiv').hide();
            $("[id^=elementlistline_]").removeClass('eHighlight');
            $("[id^=elementlistline_]").css('opacity','1');
            $(this).addClass('eHighlight');
            $(this).css('opacity','0.7');
            
            ew = 0;
            eh = 0;
            
            $('#gadgetDiv').css('top', eh + $(this).offset().top);
            $('#gadgetDiv').css('left', ew + $(this).offset().left);
            $('#gadgetDiv').fadeIn(400);

            id = $(this).attr('id').split('elementlistline_')[1];
            $('#gadgetDiv').attr('title',id);
            if($(this).next().length){
                id = $(this).next().attr('id').split('elementlistline_')[1];
            }
            $('#gadgetDiv').attr('rel',id);
        }
    });

    $('.elem_edit').live("click",function(e){
        e.preventDefault();
        $('.hdivmessages').fadeOut(100);
        loadAdminMenu('elements');
        id = $(this).parent().attr('title');
        $.post(baseURL + "libs/classes/admin.php", {
            mode: "edit_element",
            page_id: page_id,
            page_lang: page_lang,
            id: id
        },
        function(data) {
            if(data[0]=='@'){
                eval(data.substr(1));
            }else{
                $('.hdivcontent').html(data);
            }
        });
    });
    
    $('.elem_copy').live("click",function(e){
        e.preventDefault();
        $('.hdivmessages').fadeOut(100);
        loadAdminMenu('elements');
        id = $(this).parent().attr('title');
        $.post(baseURL + "libs/classes/admin.php", {
            mode: "copy_element",
            page_id: page_id,
            page_lang: page_lang,
            id: id
        },
        function(data) {
            if(data[0]=='@'){
                eval(data.substr(1));
            }else{
                $('.hdivcontent').html(data);
            }
        });
    });

    $('.copyelemetopage').live("click",function(e){
        e.preventDefault();
        $('.hdivmessages').fadeOut(100);
        loadAdminContent(page_id,page_lang,'pages');
		loadAdminMenu('pages');
		
        eid = $('#eid').val();
        pid = $('#pid').val();
        $.post(baseURL + "libs/classes/admin.php", {
            mode: "copy_element_topage",
            pid: pid,
            id: eid
        },
        function(data) {
            if(data[0]=='@'){
                eval(data.substr(1));
            }else{
                $('.hdivmessages').css('top','-' + $('.hdivcontent').height()/2-125 + 'px').html(data).fadeIn(100).delay(fadeTime).fadeOut(500);
            }
        });
    });

    $('.elem_delete').live("click",function(e){
        e.preventDefault();
        id = $(this).parent().attr('title');
        idx = $(this).parent().attr('rel');
        $.post(baseURL + "libs/classes/admin.php", {
            mode: "delete_element",
            page_id: page_id,
            page_lang: page_lang,
            id: id
        },
        function(data) {
            if(data[0]=='@'){
                eval(data.substr(1));
            }else{
                $('#gadgetDiv').attr('title',$('#gadgetDiv').attr('rel'));
                if($('#elementlistline_' + idx).next().length){
                    idx = $('#elementlistline_' + idx).next().attr('id').split('elementlistline_')[1];
                    $('#gadgetDiv').attr('rel',idx);
                }
                if($('#gadgetDiv').attr('rel') == $('#gadgetDiv').attr('title')){
                    $('#gadgetDiv').attr('rel','');
                    $('#gadgetDiv').addClass('gadgetHiddenDiv');
                }
                $('#elementlistline_' + id).remove();
            }
        });
    });
    
    $('.elem_totop').live("click",function(e){
        e.preventDefault();
        id = $(this).parent().attr('title');
        
        $.post(baseURL + "libs/classes/admin.php", {
            mode: "totop_element",
            page_id: page_id,
            page_lang: page_lang,
            id: id
        },
        function(data) {
            if(data[0]=='@'){
                eval(data.substr(1));
            }else{
                if(data[0]!='%'){
                    $('#elementlistline_' + data).before($('#elementlistline_' + id));
                    //$('#elementlistline_' + id).remove();
                    $('body').scrollTo('#elementlistline_' + id,{
                        duration:500
                    });
                }
            }
        });
    });
    
    $('.elem_tobottom').live("click",function(e){
        e.preventDefault();
        id = $(this).parent().attr('title');
        
        $.post(baseURL + "libs/classes/admin.php", {
            mode: "tobottom_element",
            page_id: page_id,
            page_lang: page_lang,
            id: id
        },
        function(data) {
            if(data[0]=='@'){
                eval(data.substr(1));
            }else{
                if(data[0]!='%'){
                    $('#elementlistline_' + data).after($('#elementlistline_' + id));
                    //$('#elementlistline_' + id).remove();
                    $('body').scrollTo('#elementlistline_' + id,{
                        duration:500
                    });
                }
            }
        });
    });
    
    $('.hide_form').live('click', function(e){
        id = $(this).attr('id');
        $.post(baseURL + "libs/classes/admin.php", {
            mode: "hideform",
            page_id: page_id,
            page_lang: page_lang,
            id: id
        },
        function(data) {
        
            });
    });

    $('.savegadget').live("click",function(e){
       e.preventDefault();
       pd = $('#selratingpage').val();
       l = $('#ratinglimit').val();
       $.post(baseURL + "libs/classes/admin.php", {
            mode: "savegadget",
            pd: pd,
            limit: l
        },
        function(data) {
            $('.hdivmessages').css('top','-' + $('.hdivcontent').height()/2-125 + 'px').html(data).fadeIn(100).delay(fadeTime).fadeOut(500);
            });
    });

    $('.save_var').live("click",function(e){
        e.preventDefault();
        tinyMCE.triggerSave(); 
        $('.loadeditor').each(function(e){
            $(this).html(tinyMCE.get($(this).attr('id')).getContent());
        });

        $.post(baseURL + "libs/classes/admin.php", $('#elemlist').serialize(),
            function(data) { 
                if(data[0]=='@'){
                    eval(data.substr(1));
                }else{
                    if(data[0]=='%'){
                        $('.hdivmessages').css('top','-' + $('.hdivcontent').height()/2-125 + 'px').html(data.substr(1)).fadeIn(100).delay(fadeTime).fadeOut(500);
                    }else{ 
                        if($('#elementlistline_'+$('#content_id').val()).hasClass('ui-resizable')){
                            location.reload();
                        }else{
                            $('#elementlistline_'+$('#content_id').val()).replaceWith(data);    
                            data2 = '<br/><div style="text-align: center;width: 240px;margin 0 auto;"><p style="color: #00FF00;font-weight: bold;font-size: 32px;">Success</p>&nbsp;<p style="color: #000;font-weight: bold;">Element was updated!</p></div>';
                            $('.hdivmessages').css('top','-' + $('.hdivcontent').height()/2-125 + 'px').html(data2).fadeIn(100).delay(fadeTime).fadeOut(500);
                        }
                    }
                }
                $('.slideshow > img').css({
                    opacity: 0.0
                }).hide();
            });
    });

    $('.add_emenu').live("click",function(e){
        e.preventDefault();
        elem_no = parseInt($('#emenu_num').val())
        $('#emenu_num').val(elem_no + 1); 
        $('<div class="hdivgadgetrow emenurow">' + $('.emenurow:eq(0)').html().replace(/e_t_emenu_0/gi, 'e_t_emenu_' + elem_no) + '</div><br/>&nbsp;').insertBefore(this);
        $('<div class="hdivgadgetrow emenurow">' + $('.emenurow:eq(1)').html().replace(/e_l_emenu_0/gi, 'e_l_emenu_' + elem_no) + '</div><br/>&nbsp;').insertBefore(this);
    });
    
    $('.add_emenu2').live("click",function(e){
        e.preventDefault();
        elem_no = parseInt($('#emenu_num').val())
        $('#emenu_num').val(elem_no + 1); 
        $('<div class="hdivgadgetrow">' + $('.hdivgadgetrow:eq(2)').html().replace(/e_t_emenu2_0/gi, 'e_t_emenu2_' + elem_no) + '</div><br/>&nbsp;').insertBefore(this);
        $('<div class="hdivgadgetrow">' + $('.hdivgadgetrow:eq(3)').html().replace(/e_l_emenu2_0/gi, 'e_l_emenu2_' + elem_no) + '</div><br/>&nbsp;').insertBefore(this);
    //$('<div class="hdivgadgetrow">' + $('.hdivgadgetrow:eq(2)').html().replace(/e_i_emenu2_0/gi, 'e_i_emenu2_' + elem_no) + '</div><br/>&nbsp;').insertBefore(this);       
    });

    $('.remove_gallery_img').live("dblclick",function(e){
        e.preventDefault();
        im = $(this).attr('rel');
        $(this).remove();
        $('.filenameholder_img').val($('.filenameholder_img').val().replace(im,'').replace('#M##M#','#M#'));
    });
	
});

function showLoader(){
    $('.hdivcontent').html('<div style="display: block; float: none;width: 80px;margin:20px auto;"><object type="application/x-shockwave-flash" data="' + baseURL + 'files/swf/loader.swf" width="80" height="80"><param name="movie" value="' + baseURL + 'files/swf/loader.swf" /><param name="wmode" value="transparent"></object></div>');
}

function loadEditor(id){

    tinyMCE.init({
        theme : "advanced",
        mode: "exact",
        elements : id,
        plugins : "paste,searchreplace",
        theme_advanced_toolbar_location : "top",
        theme_advanced_buttons1 : "bold,italic,underline,separator,"
        + "justifyleft,justifycenter,justifyright,justifyfull,separator," + "bullist,numlist,outdent,indent",
        theme_advanced_buttons2 : "undo,redo,separator,copy,cut,paste,selectall,separator,search,replace,separator,charmap,cleanup,removeformat,code",
        theme_advanced_buttons3 : "link,unlink,separator,"
        +"sub,sup,separator,forecolor,backcolor,separator,fontsizeselect",
        paste_auto_cleanup_on_paste : true,
        theme_advanced_toolbar_align : "left",
        height:"190px",
        width:"335px"
    });
	
}

function loadSimpleEditor(id){

    tinyMCE.init({
        theme : "advanced",
        mode: "exact",
        elements : id,
        theme_advanced_toolbar_location : "top",
        theme_advanced_buttons1 : "",
        theme_advanced_buttons2 : "",
        theme_advanced_buttons3 : "",
        height:"50px",
        width:"335px"
    });
}

function loadAdminMenu(selected){
    if(selected){
        s = selected;
    }else{
        s = $('#admintab').val().toLowerCase();
    }
    $.post(baseURL + "libs/classes/admin.php", {
        mode: "getmenu",
        tab: s
    },
    function(data) { 
        if(data[0]=='@'){
            eval(data.substr(1));
        }else{
            $('.hdivmainmenu').html(data);
        }
    });
}

function loadAdminContent(page_id,page_lang,selected){
    if(selected){
        s = selected;
    }else{
        s = $('#admintab').val().toLowerCase();
    }

    $.post(baseURL + "libs/classes/admin.php", {
        mode: "tabchange",
        page_id: page_id,
        page_lang : page_lang,
        tab: s
    },
    function(data) {
        if(data[0]=='@'){
            eval(data.substr(1));
        }else{
            $('.hdivcontent').html(data);
        }
    });
}

// getPageScroll() by quirksmode.com
function getPageScroll() {
    var xScroll, yScroll;
    if (self.pageYOffset) {
        yScroll = self.pageYOffset;
        xScroll = self.pageXOffset;
    } else if (document.documentElement && document.documentElement.scrollTop) {
        yScroll = document.documentElement.scrollTop;
        xScroll = document.documentElement.scrollLeft;
    } else if (document.body) {// all other Explorers
        yScroll = document.body.scrollTop;
        xScroll = document.body.scrollLeft;
    }
    return new Array(xScroll,yScroll)
}

// Adapted from getPageSize() by quirksmode.com
function getPageHeight() {
    var windowHeight
    var windowWidth
    if (self.innerHeight) { // all except Explorer
        windowHeight = self.innerHeight;
    } else if (document.documentElement && document.documentElement.clientHeight) {
        windowHeight = document.documentElement.clientHeight;
    } else if (document.body) { // other Explorers
        windowHeight = document.body.clientHeight;
    }
    if (self.innerWidth) { // all except Explorer
        windowWidth = self.innerWidth;
    } else if (document.documentElement && document.documentElement.clientWidth) {
        windowWidth = document.documentElement.clientWidth;
    } else if (document.body) { // other Explorers
        windowWidth = document.body.clientWidth;
    }
    return new Array(windowWidth,windowHeight)
}