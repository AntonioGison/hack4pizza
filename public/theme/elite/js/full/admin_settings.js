$(document).ready(function() {

    //for bg music upload
    $('#file_upload').uploadify({
        'uploader'  : baseURL + 'libs/uploadify/uploadify.swf',
        'script'    : baseURL + 'libs/classes/upload_image.php',
        'cancelImg' : baseURL + 'libs/uploadify/cancel.png',
        'folder'    : 'audio',
        'scriptData': {
            'foldername':'audio',
            'type' : 'bgaudio'
        },
        'auto'      : true,
        'multi'       : false,
        'buttonText'  : 'Upload File',
        'fileExt'     : '*.mp3;',
        'fileDesc'    : 'Mp3',
        'onSelectOnce' : function(event,data) {
            $('.fupload_placeholder').css('height','80px');
        },
        'onComplete' : function(event, ID, fileObj, response, data) {
            $('.fupload_placeholder').css('height','25px');
            if(response[0]=='@'){
                eval(data.substr(1));
            }else{
                $('.filenameholder').val(response);
            }
        }
    });

    $('.change_bgmusic').click(function(e){
        e.preventDefault();
        $.post(baseURL + "libs/classes/admin.php", {
            mode: "changebgmusic",
            state: $('.mp3_state').val(),
            mp3: $('.filenameholder').val()
        },
        function(data) {
            if(data[0]=='@'){
                eval(data.substr(1));
            }else{
                $('.hdivmessages').css('top','-' + $('.hdivcontent').height()/2-125 + 'px').html(data).fadeIn(100).delay(fadeTime).fadeOut(500);
            }
        });
    });

    $('.change_admin_mail').click(function(e){
        e.preventDefault();
        
        $.post(baseURL + "libs/classes/admin.php", {
            mode: "changemail",
            mail: $('.admin_mail').val().trim(),
            omail: $('.order_mail').val().trim()
        },
        function(data) {
            if(data[0]=='@'){
                eval(data.substr(1));
            }else{
                $('.hdivmessages').css('top','-' + $('.hdivcontent').height()/2-125 + 'px').html(data).fadeIn(100).delay(fadeTime).fadeOut(500);
            }
        });
    });

    $('.changeadminpass').click(function(e){
        e.preventDefault();
        $.post(baseURL + "libs/classes/admin.php", {
            mode: "changeadminpass",
            opass: $('#old_pass').val().trim(),
            pass: $('#pass').val().trim(),
            npass: $('#new_pass').val().trim()
        },
        function(data) {
            if(data[0]=='@'){
                eval(data.substr(1));
            }else{
                $('.hdivmessages').css('top','-' + $('.hdivcontent').height()/2-125 + 'px').html(data).fadeIn(100).delay(fadeTime).fadeOut(500);
                $('#old_pass').val('');
                $('#pass').val('');
                $('#new_pass').val('');
            }
        });
    });

    $('.save_admin_details').click(function(e){
        e.preventDefault();

        $.post(baseURL + "libs/classes/admin.php", {
            mode: "savedetails",
            social_net_fb: $('#social_facebook').val().trim(),
            social_net_tw: $('#social_twitter').val().trim(),
            social_net_tb: $('#social_tumblr').val().trim(),
            tel1: $('#tel1').val().trim(),
            tel2: $('#tel2').val().trim()
        },
        function(data) {
            if(data[0]=='@'){
                eval(data.substr(1));
            }else{
                $('.hdivmessages').css('top','-' + $('.hdivcontent').height()/2-125 + 'px').html(data).fadeIn(100).delay(fadeTime).fadeOut(500);
            }
        });
    });

    

});