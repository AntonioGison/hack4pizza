$(document).ready(function() {
    $('.add_newsletter_user').click(function(e){
        e.preventDefault();
        if($('#newsletter_email').val()!=''){
            $.post(baseURL + "libs/classes/admin.php", {
                mode: "addnewsletteruser",
                user: $('#newsletter_user').val(),
                email: $('#newsletter_email').val()
            },
            function(data) {
                if(data[0]=='@'){
                    eval(data.substr(1));
                }else{
                    loadAdminContent(page_id,page_lang,'newsletter');
                    $('.hdivmessages').css('top','-' + $('.hdivcontent').height()/2-125 + 'px').html(data);
                    $('.hdivmessages').fadeIn(100).delay(fadeTime).fadeOut(500);
                }
            });
        }else{
            $('.hdivmessages').css('top','-' + $('.hdivcontent').height()/2-125 + 'px').html('<br/><div style="text-align: center;width: 240px;margin 0 auto;"><p style="color: #FF0000;font-weight: bold;font-size: 32px;">Error</p>&nbsp;<p style="color: #000;font-weight: bold;">E-mail cannot be empty!</p></div>');
            $('.hdivmessages').fadeIn(100).delay(fadeTime).fadeOut(500);
        }
    });

    $('.remove_user').click(function(e){
        e.preventDefault();
    });

    $('.remove_user').dblclick(function(e){
        id = $(this).attr('href');
        $('.hdivmessages').css('top','-' + $('.hdivcontent').height()/2-125 + 'px').html('<br/><div style="text-align: center;width: 240px;margin 0 auto;"><p style="color: #00FF00;font-weight: bold;font-size: 32px;">Confirm</p><p style="color: #000;font-weight: bold;width:230px;padding:0 10px;">Are you sure you want to delete this user?</p></div><div class="hdivgadgetrow" style="margin: 20px 0;"><a class="hdivbutton doremove" href="#" style="margin: 5px 5px 5px 65px;">Delete</a><a class="hdivbutton cancelcopy" href="#">Cancel</a></div>');
        $('.hdivmessages').fadeIn(200);
        $('.cancelcopy').click(function(ev){
            ev.preventDefault();
            $('.hdivmessages').css('top','-' + $('.hdivcontent').height()/2-125 + 'px').html('');
            $('.hdivmessages').fadeOut(500);
        });
        $('.doremove').click(function(ev){
            ev.preventDefault();
            $.post(baseURL + "libs/classes/admin.php", {
                mode: "deleteuser",
                user: id
            },
            function(data) {
                if(data[0]=='@'){
                    eval(data.substr(1));
                }else{
                    $('.hdivmessages').css('top','-' + $('.hdivcontent').height()/2-125 + 'px').html(data);
                    loadAdminContent(page_id,page_lang,'newsletter');
                    $('.hdivmessages').delay(fadeTime).fadeOut(500);
                }
            });
        });
    });

    $('.send_newsletter').click(function(e){ 
        e.preventDefault();
        $.post(baseURL + "libs/classes/admin.php", {
            mode: "sendnewsl",
            page_id: $('#newsletter_page').val(),
            page_lang: $('#newsletter_page').attr('title'),
            subject: $('#newsletter_subject').val()
        },
        function(data) {
            if(data[0]=='@'){
                eval(data.substr(1));
            }else{ 
                $('.hdivmessages').css('top','-' + $('.hdivcontent').height()/2-125 + 'px').fadeIn(100).html(data);
                $('.hdivmessages').delay(fadeTime).fadeOut(500);
            }
        });
    });

});