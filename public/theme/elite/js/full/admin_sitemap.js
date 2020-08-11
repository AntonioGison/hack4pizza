$(document).ready(function() {
    $('.hdivsitemapselect').click(function(e){
        e.preventDefault();
        $.post(baseURL + "libs/classes/admin.php", {
            mode: "addspages",
            pages: $('#ppages').val()
        },
        function(data) { 
            if(data[0]=='@'){
                eval(data.substr(1));
            }else{
                $('#spages').html(data);
            }
        });
    });
    
    $('.hdivsitemapdeselect').click(function(e){
        e.preventDefault();
        $.post(baseURL + "libs/classes/admin.php", {
            mode: "removespages",
            pages: $('#spages').val()
        },
        function(data) { 
            if(data[0]=='@'){
                eval(data.substr(1));
            }else{
                $('#spages').html(data);
            }
        });
    });

    $('.generate_sitemap').click(function(e){
        e.preventDefault();
        $.post(baseURL + "libs/classes/admin.php", {
            mode: "generatesitemap",
			webshop: $('#webshop_sitemap').is(':checked')
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