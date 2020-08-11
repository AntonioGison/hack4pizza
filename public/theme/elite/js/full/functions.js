(function($) {
    $(document).ready(function() {

        //select country / city
        $('#CategoryDropdown').change(function(e){
            l = $('.languageSelector').find('.selected').attr('rel');
            location.href = baseURL+l+'/'+$(this).val();
        });

		//detail view photo manage
		$('.galleryPhotos').find('.img-rounded').click(function(e){
			e.preventDefault();
			im = $(this).attr('src').split('=').reverse()[0];
			$('.firtsPhoto>a').attr('href','../'+im+'');
			$('.firtsPhoto>a>img').attr('src',''+baseURL+'thumb2.php?mode=99&x=600&y=600&file='+im+'');
		});
		
        //vip login
        $('#viplogin').keypress(function(event) {
            if (event.keyCode == '13') {
                event.preventDefault();
                $('#vipsubmit').trigger('click');
            }
        });

        $('#vipsubmit').click(function(e){
            e.preventDefault();
            $.post(baseURL + "libs/classes/ajax.php", {
                mode: "viplogin",
                code: $('#viplogin').val()
            },
            function(data) {
                location.reload();
            });
        });
        
        $('#viplogout').click(function(e){
            e.preventDefault();
            $.post(baseURL + "libs/classes/ajax.php", {
                mode: "viplogout"
            },
            function(data) {
                location.reload();
            });
        });
		
		//image enlarge
		$(".popup").click(function (e) {
            e.preventDefault();
            $(".fullscreenImageViewer").fadeIn(200);
            var w = $(".fullscreenImageViewer").width();
            var h = $(".fullscreenImageViewer").height();
            var styleAppend = "";
            if (w >= h) styleAppend = "width:100%";
            else styleAppend = "height:100%";
            
            var imageUrl = $(this).attr("href");
            console.log(imageUrl);
            $(".fullscreenImageViewer").empty();
            $(".fullscreenImageViewer").append('<a class="closePopup" title="Normal" href="#"><img src="' + imageUrl + '" style="' + styleAppend + '" alt=" " /></a>');

            // $(".fullscreenImageViewer").append('<a class="closePopup" title="Normal" href="#"><img src="' + imageUrl + '" style="' + styleAppend + '" alt=" " /><button class="closePopup" id = "close-image" title="Normal">X</button></a>');
        });

        $(".closePopup").live('click', function (e) {
            e.preventDefault();
            $(".fullscreenImageViewer").fadeOut(200);
        });


        //admin login related
        $('#draggable').draggable({
            cursor: "move",
            handle: ".collapser, .hdivmainmenu",
            stop: function(event, ui) { 
                // Show dropped position.
                var Stoppos = $(this).offset();

                $.post(baseURL + "libs/classes/ajax.php", {
                    mode: "draggable_move",
                    left: Stoppos.left,
                    top: Stoppos.top,
                    scroll: getPageScroll(),
                    psize: getPageHeight(),
                    gsize: new Array($(this).width(),$(this).height())
                });
            }
        });

        $('.admcancel').click(function(e){
            e.preventDefault();
            $.post(baseURL + "libs/classes/ajax.php", {
                mode: "admin_logout"
            },
            function(data) {
                location.reload();
            });
        });

        $('#admu, #admp').keypress(function(event) {
            if (event.keyCode == '13') {
                event.preventDefault();
                $('.admlogin').trigger('click');
            }
        });

        $('.admlogin').click(function(e){
            e.preventDefault();
            $.post(baseURL + "libs/classes/ajax.php", {
                mode: "admin_login",
                data: $('#admloginForm').serialize()
            },
            function(data) {
                if(data == 'login'){
                    location.reload();
                } else {
                    $('.admloginerror').slideUp().html(data);
                    $('.admloginerror').slideDown().delay(fadeTime).slideUp();
                }
            });
        });

    });
})(jQuery);

//Functions

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