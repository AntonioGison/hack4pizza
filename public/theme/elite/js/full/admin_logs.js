$(document).ready(function() {
    $('.logdate').change(function(e){
        $.post(baseURL + "libs/classes/admin.php", {
            mode: "getlog",
            date: $(this).val()
        },
        function(data) {
            if(data[0]=='@'){
                eval(data.substr(1));
            }else{
                $('.hdivmaillist').html(data);
            }
        });
    });

    $('.update_ips').click(function(e){
        e.preventDefault();
        $.post(baseURL + "libs/classes/admin.php", {
            mode: "updateips",
            ips: $('#ips').html()
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