$(document).ready(function(){ 
        
    //dropdowns
    $('.my-skinned-select').skinnedSelect();
    //search skining
    $("#default-usage-select").selectbox();
    
    //anim of banner
    /*var inter_id = setInterval( "slideSwitch()", 5000 );
    $('.bannernavleft, .bannernavright').live('click',function(e){
        e.preventDefault();
        clearInterval(inter_id);
        
        num = $(this).attr('rel')-0;
        $('#slideshow IMG.active').removeClass('active');
        $('#slideshow IMG:eq('+num+')').addClass('active');
        
        //slideSwitch();
        inter_id = setInterval( "slideSwitch()", 5000 );
    });*/

$('#slideshow').nivoSlider({
        effect: 'random', // Specify sets like: 'fold,fade,sliceDown'
        animSpeed: 500, // Slide transition speed
        pauseTime: 5000, // How long each slide will show
        startSlide: 0, // Set starting Slide (0 index)
        directionNav: true, // Next & Prev navigation
        directionNavHide: false, // Only show on hover
        controlNav: false, // 1,2,3... navigation
        controlNavThumbs: false, // Use thumbnails for Control Nav
        manualAdvance: false, // Force manual transitions
        prevText: '<img src="'+baseURL+'files/graphics/bannernavarrow_left.gif" width="6" height="10" alt="navigate banners to left" />', // Prev directionNav text
        nextText: '<img src="'+baseURL+'files/graphics/bannernavarrow_right.gif" width="6" height="10" alt="navigate banners to right" />' // Next directionNav text
    });
    
    //carousel
    $(".carousel").jCarouselLite({
        auto: 1,
        speed: 1500,
        visible: 9,
        circular: true
    });
    
    //sliders
    if($("#slider-range").length){
    
        $( "#slider-range" ).slider({
            range: true,
            min: 0,
            max: $('#maxp').val(),
            values: [parseInt($('#sel_p').val().split(',')[0]),parseInt($('#sel_p').val().split(',')[1])],
            slide: function( event, ui ) {
                $( "#amount" ).val(ui.values[ 0 ] + " - " + ui.values[ 1 ] + " Lei");
                $.post(baseURL + "libs/classes/ajax.php", {
                    mode: "price_range",
                    minp: ui.values[0],
                    maxp: ui.values[1]
                },
                function(data) {
            
                    });
            }
        });
        $( "#amount" ).val($( "#slider-range" ).slider( "values", 0 ) + " - " + $( "#slider-range" ).slider( "values", 1) +' Lei');

    }
        
    //menu editing
    $('.listTab').mouseover(function(e){
        $('.animcategory').removeClass('animcategory_active');
        id = $(this).attr('id').split('_')[1];
        $('#mainm_'+id+' > a').addClass('animcategory_active');
    }).mouseleave(function(e){
        $('.animcategory').removeClass('animcategory_active');
    });
    
    //hide addresses
    $('.personal_addr').hide();
    $('.company_addr').hide();
    
    //tip utilizator
    $('#tip_utilizator').change(function(e){
        if($(this).val()==1){
            $('.date_firma').removeClass('hiddendiv');
        }else{
            $('.date_firma').addClass('hiddendiv');
        }
    });
    
    $('.regsubmit').click(function(e){
        e.preventDefault();
        $.post(baseURL + "libs/classes/ajax.php", {
            mode: "register",
            data: $('#registerform').serialize()
        },
        function(data) {
            
            type = data[0];
            if(type == '@'){
                alert(sys_messages[data.substr(1)]);
            }else if(type == '%'){
                alert(sys_messages[data.substr(1)]);
                location.href = baseURL + lang + '/login.html';
            }
        });
    });

    $('.backtotop').click(function(e){
        e.preventDefault();
        $('body').animate({
            scrollTop : 0
        },'slow');
    });

    //detail tabs
    $('.commentstab').live('click', function(e){
        e.preventDefault();
        $('#comments').removeClass('hiddendiv');
        $('#writecomment').addClass('hiddendiv');
    });

    $('.writecommenttab').live('click', function(e){
        e.preventDefault();
        $('#writecomment').removeClass('hiddendiv');
        $('#comments').addClass('hiddendiv');
    });
    
    $('.rate').mouseover(function(e){
        r = $(this).attr('rel');
        $('.ratingstars').css('width', r+'%');
    }).click(function(e){
        e.preventDefault();
    });
        
    $('.pricefilter').click(function(e){
        e.preventDefault();
        location.href=location.href.replace(/-page[0-9]{1,3}/gi, "");
    });
    
    $('.resetsort').click(function(e){
        e.preventDefault();
        $.post(baseURL + "libs/classes/ajax.php", {
            mode: "resetsort"
        },
        function(data) {
            location.href=location.href.replace(/-page[0-9]{1,3}/gi, "");
        });
    });
    
    $('.resetfilter').click(function(e){
        e.preventDefault();
        $.post(baseURL + "libs/classes/ajax.php", {
            mode: "filtersortreset"
        },
        function(data) {
            location.href=location.href.replace(/-page[0-9]{1,3}/gi, "");
        });
    });
    
    $('select[name=filtersortselect]').live('change', function(e){
        type=$(this).attr('id');
        value=$(this).val();
        
        $.post(baseURL + "libs/classes/ajax.php", {
            mode: "filtersortselect",
            type: type,
            value: value
        },
        function(data) {
            location.reload();
        });
    });
        
    $('#per_page').change(function(e){
        
        $.post(baseURL + "libs/classes/ajax.php", {
            mode: "set_sort_ppage",
            type: "prod_per_page",
            value: $(this).val()
        },
        function(data) {
            location.href=location.href.replace(/-page[0-9]{1,3}/gi, "");
        });
    });
    
    $('.compare').click(function(e){
        e.preventDefault();
        id = $(this).attr('href');
        $.post(baseURL + "libs/classes/ajax.php", {
            mode: "compare",
            id: id
        },
        function(data) {
            $(data).insertAfter('.bottomborder');
            $('body').css({
                'overflow':'hidden'
            });
            $(document).bind('scroll',function () { 
                window.scrollTo(0,0); 
            });
        });
    });
    
    $('#compare_prod1, #compare_prod2').live('change', function(e){
        id = $('#compare_prod1').val();
        id2 = $('#compare_prod2').val();
        
        $.post(baseURL + "libs/classes/ajax.php", {
            mode: "compare",
            id: id,
            id2: id2
        },
        function(data) {
            $('.comparepopupholder').remove();
            $(data).insertAfter('.bottomborder');
            $('body').css({
                'overflow':'hidden'
            });
            $(document).bind('scroll',function () { 
                window.scrollTo(0,0); 
            });
        });
    });
    
    $('.closecompare').live('click', function(e){
        e.preventDefault();
        $('.comparepopupholder').remove();
        $(document).unbind('scroll'); 
        $('body').css({
            'overflow':'visible'
        });
    })
    
    $('#search_val').keypress(function(event) {
        if (event.keyCode == '13') {
            event.preventDefault();
            $('.searchsubmit').trigger('click');
        }
    });

    $('.searchsubmit').click(function(e){
        e.preventDefault();
        $.post(baseURL + "libs/classes/ajax.php", {
            mode: "search",
            sv: $('#search_val').val(),
            sc: $('#search_cat').val()
        },
        function(data) {
            location.href = baseURL + lang + '/search.html';
        });
    });
    
    $("#default-usage-select").selectbox().bind('change', function(){
        $('#search_cat').val($(this).val());
    });
    
    $('.recoverp').click(function(e){
        e.preventDefault();
		
        var name=prompt("Va rugam introduceti adresa de e-mail cu care v-ati inscris pe site!","");
        if (name!=null && name!=""){
            $.post(baseURL + "libs/classes/ajax.php", {
                mode: "recoverpass",
                mail: name
            },
            function(data) { 
                alert(sys_messages['messagesent']);
            });
        }
    });


    $('.add_new_address').click(function(e){
        e.preventDefault();
        sel = $('.add_address').val();
        $('#ctype').val(sel);
        $('#ptype').val(sel);
        
        $(':input','#personal_addr')
        .not(':button, :submit, :reset, :hidden')
        .val('')
        .removeAttr('checked')
        .removeAttr('selected');
        
        $(':input','#company_addr')
        .not(':button, :submit, :reset, :hidden')
        .val('')
        .removeAttr('checked')
        .removeAttr('selected');
        
        if(sel == 'psa'){
            $('.personal_addr > * > .myaccountformtitle > strong').html('Adresa livrare personala');
            //$('.personal_addr > * > .popupsmalltext').html('The Address where we will ship the goods you have ordered.');
            $('.personal_addr > * > #pid').val('');
            
            $('.company_addr').hide();
            $('.personal_addr').show('slow');
        }else if(sel == 'pba'){
            $('.personal_addr > * > .myaccountformtitle > strong').html('Adresa facturare personala');
            //$('.personal_addr > * > .popupsmalltext').html('The Address on the invoice.');
            $('.personal_addr > * > #pid').val('');
            
            $('.company_addr').hide();
            $('.personal_addr').show('slow');
        }else if(sel == 'csa'){
            $('.company_addr > * > .myaccountformtitle > strong').html('Adresa livrare firma');
            //$('.company_addr > * > .popupsmalltext').html('The Address where we will ship the goods you have ordered.');
            $('.personal_addr > * > #cid').val('');
            
            $('.personal_addr').hide();
            $('.company_addr').show('slow');
        }else if(sel == 'cba'){
            $('.company_addr > * > .myaccountformtitle > strong').html('Adresa facturare firma');
            //$('.company_addr > * > .popupsmalltext').html('The Address on the invoice.');
            $('.personal_addr > * > #cid').val('');
            
            $('.personal_addr').hide();
            $('.company_addr').show('slow');
        } else {
            alert('Va rugam alegeti o adresa');
            $('.personal_addr > * > #cid').val('');
            $('.personal_addr > * > #pid').val('');
        }
    });
    
    $('.savepaddress').live('click',function(e){
        e.preventDefault();
        
        $.post(baseURL + "libs/classes/ajax.php", {
            mode: "savepaddress",
            data: $('#personal_addr').serialize()
        },
        function(data) { 
            type = data[0];
            if(type == '@'){
                alert(sys_messages[data.substr(1)]);
            }else if(type == '%'){
                location.reload();
            }
        });
    });
    
    $('.savecaddress').click(function(e){
        e.preventDefault();
        
        $.post(baseURL + "libs/classes/ajax.php", {
            mode: "savecaddress",
            data: $('#company_addr').serialize()
        },
        function(data) { 
            type = data[0];
            if(type == '@'){
                alert(sys_messages[data.substr(1)]);
            }else if(type == '%'){
                location.reload();
            }
        });
    });
    
    $('.resetpassword').click(function(e){
        e.preventDefault();
        if($('#npass').val() == $('#rpass').val()){
            $.post(baseURL + "libs/classes/ajax.php", {
                mode: "resetpass",
                data: $('#res_pass').serialize()
            },
            function(data) { 
                alert('Parola schimbata');
                location.href=baseURL;
            });
        } else {
            alert('Parolele introduse nu coincid!');
        }
    });
	
    $('.select_address').change(function(e){
        data = $(this).val().split('::');
        sel = data[data.length-1];
        
        $('#ctype').val(sel);
        $('#ptype').val(sel);
        if(sel == 'psa'){
            $('.personal_addr > * > .myaccountformtitle > strong').html('Personal shipping address');
            $('.personal_addr > * > .popupsmalltext').html('The Address where we will ship the goods you have ordered.');
            $('.personal_addr > * > #pid').val(data[0]);
            $('#personal_addr > * > #paddress').val(data[1]);
            $('#personal_addr > * > #pname').val(data[2]);
            $('#personal_addr > * > #preg').val(data[3]);
            $('#personal_addr > * > #pcity').val(data[8]);
            $('#pcounty').val(data[7]);
            $('#personal_addr > * > #pcode').val(data[9]);
            
            $('.company_addr').hide();
            $('.personal_addr').show('slow');
        }else if(sel == 'pba'){
            $('.personal_addr > * > .myaccountformtitle > strong').html('Personal billing address');
            $('.personal_addr > * > .popupsmalltext').html('The Address on the invoice.');
            $('.personal_addr > * > #pid').val(data[0]);
            $('#personal_addr > * > #paddress').val(data[1]);
            $('#personal_addr > * > #pname').val(data[2]);
            $('#personal_addr > * > #preg').val(data[3]);
            $('#personal_addr > * > #pcity').val(data[8]);
            $('#pcounty').val(data[7]);
            $('#personal_addr > * > #pcode').val(data[9]);
            
            $('.company_addr').hide();
            $('.personal_addr').show('slow');
        }else if(sel == 'csa'){
            $('.company_addr > * > .myaccountformtitle > strong').html('Company shipping address');
            $('.company_addr > * > .popupsmalltext').html('The Address where we will ship the goods you have ordered.');
            $('.company_addr > * > #cid').val(data[0]);
            $('#company_addr > * > #caddress').val(data[1]);
            $('#company_addr > * > #ccity').val(data[8]);
            $('#company_addr').find('#ccounty option[value="'+data[7]+'"]').prop('selected', true);
            $('#company_addr > * > #ccode').val(data[9]);
            $('#company_addr > * > #cname').val(data[2]);
            $('#company_addr > * > #creg').val(data[3]);
            $('#company_addr > * > #creg2').val(data[4]);
            $('#company_addr > * > #caccount').val(data[5]);
            $('#company_addr > * > #cbank').val(data[6]);
            
            $('.personal_addr').hide();
            $('.company_addr').show('slow');
        }else if(sel == 'cba'){
            $('.company_addr > * > .myaccountformtitle > strong').html('Company billing address');
            $('.company_addr > * > .popupsmalltext').html('The Address on the invoice.');
            $('.company_addr > * > #cid').val(data[0]);
            $('#company_addr > * > #caddress').val(data[1]);
            $('#company_addr > * > #ccity').val(data[8]);
            $('#company_addr').find('#ccounty option[value="'+data[7]+'"]').prop('selected', true);
            $('#company_addr > * > #ccode').val(data[9]);
            $('#company_addr > * > #cname').val(data[2]);
            $('#company_addr > * > #creg').val(data[3]);
            $('#company_addr > * > #creg2').val(data[4]);
            $('#company_addr > * > #caccount').val(data[5]);
            $('#company_addr > * > #cbank').val(data[6]);
            
            $('.personal_addr').hide();
            $('.company_addr').show('slow');
        }else{
            $('.personal_addr').hide();
            $('.company_addr').hide();
            $('.personal_addr > * > #cid').val('');
            $('.personal_addr > * > #pid').val('');
        }
    });

    $('.checkoutbutton').click(function(e){
        e.preventDefault();
        if($('#animatedcart').is(':visible')){
            location.href = baseURL + 'en/my-account-checkout-a4.html';
        }else{
            $('#animatedcart:hidden').slideDown();
        }
    });


    $('.popupcancel').click(function(e){
        e.preventDefault();
        $('#popup-holder').addClass('hiddendiv');
        $('#rate_product').addClass('hiddendiv');
        $('#recpass').addClass('hiddendiv');
    });

    $('#login_email, #login_pass, #login_email2, #login_pass2').keypress(function(event) {
        if (event.keyCode == '13') {
            if($(this).attr('id') == 'login_email2' || $(this).attr('id') == 'login_pass2'){
                $('.loginsubmit2').trigger('click');
            }else{
                $('.loginsubmit').trigger('click');
            }
        }
    });

    $('.loginsubmit').click(function(e){
        e.preventDefault();
        if($('#login_email').val() == '' || $('#login_pass').val() == ''){
            alert(sys_messages['error_fillall']);
        }else{
            $.post(baseURL + "libs/classes/ajax.php", {
                mode: "userlogin",
                data: $('#loginform').serialize()
            },
            function(data) { 
                type = data[0];
                if(type == '@'){
                    alert(sys_messages[data.substr(1)]);
                }else if(type == '%'){
                    location.href = baseURL;
                }
            });
        }
    });
    
    $('.loginsubmit2').click(function(e){
        e.preventDefault();
        if($('#login_email2').val() == '' || $('#login_pass2').val() == ''){
            alert(sys_messages['error_fillall']);
        }else{
            $.post(baseURL + "libs/classes/ajax.php", {
                mode: "userlogin",
                data: $('#loginform2').serialize()
            },
            function(data) { 
                type = data[0];
                if(type == '@'){
                    alert(sys_messages[data.substr(1)]);
                }else if(type == '%'){
                    location.href = baseURL;
                }
            });
        }
    });

    $('.logoutsubmit').live('click',function(e){
        e.preventDefault();
        $.post(baseURL + "libs/classes/ajax.php", {
            mode: "userlogout"
        },
        function(data) {
            location.reload();
        });
    });

    $('.productratingholder').mousemove(function(e){
        e.preventDefault();
        var x = e.pageX - this.offsetLeft;

        if(x>100){
            x=100;
        }

        $('.productratingholder > .rating').css('width', x + 3);
        $('.productratingholder').find('.ratestar').attr('title', 'Rate ' + x/20 + '/5');
    });

    $('.productratingholder').mouseout(function(e){
        e.preventDefault();
        var x = $('#productratingholder').val();

        $('.productratingholder > .rating').css('width', x);
        $('.productratingholder').find('.ratestar').attr('title', x/20 + '/5');
    });
    
    $('.productratingholder').click(function(e){
        e.preventDefault();
        var x = e.pageX - this.offsetLeft;

        if(x>100){
            x=100;
        }
        
        $('#rate_product').removeClass('hiddendiv');
        $('#rate_product').find('.popuptitle').html('Rating ' + x/20 + '/5');
        $('#rate_product').find('#rating').val(x);
        $('#rate_product').find('.popupparagraph > textarea').html('');
        $('#rate_product').find('.popupbutton').html(' Rate ');
        
    });
    
    $('.rateprod').click(function(e){
        e.preventDefault();
        
        rate = Math.ceil($('#writecomment').find('.ratingstars').width()/10)*10;
        comment = $('#writecomment').find('.commentarea').val();
        
        $.post(baseURL + "libs/classes/ajax.php", {
            mode: "rate_prod",
            pid: $('#prod_id').val(),
            rate: rate,
            comment: comment
        },
        function(data) {
            type = data[0];
            if(type == '@'){
                alert(sys_messages[data.substr(1)]);
            }else{
                alert(sys_messages['success_rate']);
            }
        });
        
    });

    $('.addtocart').live('click',function(e){
        e.preventDefault();
        id = $(this).attr('rel');
        
        if($('.choice_list').length){
            var choice = $('.choice_list').map(function () {
                return $(this).attr('title')+'|'+this.value;
            }).get();
            choice = choice.join('::');
        }else{
            var choice = '';
        }
        
        $.post(baseURL + "libs/classes/ajax.php", {
            mode: "addtocart",
            id: id,
            choice: choice
        },
        function(data) { 
            if(data == 'added'){
                $.post(baseURL + "libs/classes/ajax.php", {
                    mode: "getcart"
                },
                function(data2) {
                    if(data2){
                        tmp = data2.toString().split('##');
                        //$('.cart_content').html(tmp[1]);
                        //$('.cart_total').html('Total: '+tmp[0]+' Ron');
                        $('.pnum').html(tmp[2]);
                        $('#pnum').val(tmp[2]);
                        $('.addtocartbutton').html('Ai adaugat in cos');
                        $('.addtocartbutton').css('background-position', '-318px');
                        setTimeout(function(){
                            $('.addtocartbutton').css('background-position', '0px').html('Adauga in cos');
                        },1000);
                    }
                });
            }else{
                alert(sys_messages[data.substr(1)]);
            }
        });
    });
    
    $('.addptocart').click(function(e){
        e.preventDefault();
        id = $(this).attr('href');
        
        if($('.choice_list').length){
            var choice = $('.choice_list').map(function () {
                return $(this).attr('title')+'|'+this.value;
            }).get();
            choice = choice.join('::');
        }else{
            var choice = '';
        }
        
        $.post(baseURL + "libs/classes/ajax.php", {
            mode: "addptocart",
            id: id,
            choice: choice
        },
        function(data) { 
            if(data == 'added'){
                $.post(baseURL + "libs/classes/ajax.php", {
                    mode: "getcart"
                },
                function(data2) {
                    if(data2){
                        tmp = data2.toString().split('##');
                        $('.cart_content').html(tmp[1]);
                        $('.cart_total').html('&pound;'+tmp[0]);
                        $('#animatedcart:hidden').slideDown();
                    }
                });
            }
        });
    });
    
    $('.seecart').click(function(e){
        e.preventDefault();
        if($('#pnum').val()==0){
            alert("Cosul Dvs. nu contine nimic!");
        }else{
            location.href=$(this).attr('href');
        }
    });

    $('.checkoutproductbuc').ForceNumericOnly();
    $('.checkoutproductbuc').live('change',function(e){
        id=$(this).attr('id');
        buc=$(this).val();
        $.post(baseURL + "libs/classes/ajax.php", {
            mode: "update_checkout",
            id: id,
            buc: buc
        },
        function(data) {
            if(data){
                $.post(baseURL + "libs/classes/ajax.php", {
                    mode: "getcart_checkout",
                    id: id
                },
                function(data2) {
                    if(data2){
                        tmp = data2.toString().split('##');
                        if(tmp[3]==0){
                            location.href = baseURL + lang;
                        }else{
                            $('.checkoutrow').remove();
                            $(tmp[1]).insertAfter('.checkout_content');
                            $('.checkout_total').html('Pret total: '+tmp[0].replace(".",'<sup>')+' ');
                            $('.checkout_tva').html(tmp[2]+' ');
                            $('.pnum').html(tmp[3]);
                            $('#pnum').val(tmp[3]);
                        }
                    }
                });
            }
        });
    });

    $('.shipping_type').change(function(e){
        d = $(this).val(); 
        $.post(baseURL + "libs/classes/ajax.php", {
            mode: "shipping_type",
            data: d
        },
        function(data) {
            $.post(baseURL + "libs/classes/ajax.php", {
                mode: "getcart_checkout"
            },
            function(data2) {
                if(data2){
                    tmp = data2.toString().split('##');
                    $('.checkoutrow').remove();
                    $(tmp[1]).insertAfter('.checkout_content');
                    $('.checkout_total').html('Pret total: '+tmp[0].replace(".",'<sup>')+' ');
                    $('.checkout_tva').html(tmp[2]+' ');
                    $('.pnum').html(tmp[3]);
                    $('#pnum').val(tmp[3]);
                }
            });
        });
    });
    
    $('.shipping_pay').change(function(e){
        $.post(baseURL + "libs/classes/ajax.php", {
            mode: "shipping_pay",
            data: $(this).val()
        },
        function(data) {
            $.post(baseURL + "libs/classes/ajax.php", {
                mode: "getcart_checkout"
            },
            function(data2) {
                if(data2){
                    tmp = data2.toString().split('##');
                    $('.checkoutrow').remove();
                    $(tmp[1]).insertAfter('.checkout_content');
                    $('.checkout_total').html('Pret total: '+tmp[0].replace(".",'<sup>')+' ');
                    $('.checkout_tva').html(tmp[2]+' ');
                    $('.pnum').html(tmp[3]);
                    $('#pnum').val(tmp[3]);
                }
            });
        });
    });

    $('.addtowish').click(function(e){
        e.preventDefault();
        id=$(this).attr('href');
        $.post(baseURL + "libs/classes/ajax.php", {
            mode: "addtowish",
            id: id
        },
        function(data) {
            type = data[0];
            if(type == '@'){
                webshop_alert($('#'+data.substr(1)).val()+'##','site');
            }else if(type == '%'){
                $('.addtowish').html(data.substr(1));
            }
        });
    });

    $('.addedtowish').click(function(e){
        e.preventDefault();
    });

    $('.removewish').click(function(e){
        e.preventDefault();
        id=$(this).attr('href');
        $.post(baseURL + "libs/classes/ajax.php", {
            mode: "removewish",
            id: id
        },
        function(data) {
            $('#hold_'+id).remove();
        });
    });

    $('.removeitemfromcart, .removeitemfromcheckout').live('click', function(e){
        e.preventDefault();
        $.post(baseURL + "libs/classes/ajax.php", {
            mode: "removecartitem",
            id: $(this).attr('href')
        },
        function(data) {
            type = data[0];
            if(type == '@'){
                $('.errortext').html($('#'+data.substr(1)).val());
            }else{
                location.reload();
            }
        });
    });

    $('.persinfosave').click(function(e){
        e.preventDefault();
        $.post(baseURL + "libs/classes/ajax.php", {
            mode: "savepersinfo",
            data: $('#persinfo_form').serialize()
        },
        function(data) { 
            type = data[0];
            if(type == '@'){
                alert(sys_messages[data.substr(1)]);
            }else if(type == '%'){
                alert(sys_messages[data.substr(1)]);
            }
        });
    });

    $('.popupaction').click(function(e){
        e.preventDefault();
        act = $('#nextstep').val();

        $('#popup-holder').find('.popuptitle').html('');
        $('#popup-holder').find('.popupparagraph').html('');
        $('#popup-holder').find('.popupbutton').html('');

        if(act == 'site'){
            $('#popup-holder').addClass('hiddendiv');
        }
    });

    $('.customer_rating_scroller').slimscroll({
        color: '#666',
        size: '5px',
        width: '99%',
        height: '300px'
    });

    $('#scrollbar').slimscroll({
        color: '#00f',
        size: '5px',
        width: '99%',
        height: '100px'
    });
    
    $('.express_checkout').click(function(e){
        e.preventDefault();
        billing = $('.invoice_address').val();
        shipping = $('.shipping_address').val();
		
        if(billing == '' || billing == 0 || billing == 'same'){
            billing = shipping;
        }
		
        shipping_type = $('.shipping_type').val();
        shipping_pay = $('.shipping_pay').val();
        
        if(billing == '' || shipping =='' || shipping_type =='' || shipping_pay ==''){
            alert('Va rugam alegeti adresa de facturare si livrare, precum si modul de transport si plata!');
        }else{
            $.post(baseURL + "libs/classes/ajax.php", {
                mode: "express_checkout",
                data: $('#express_data').serialize(),
                billing: billing,
                shipping: shipping
            },
            function(data) { 
                type = data[0];
                if(type == '@'){
                    alert(sys_messages[data.substr(1)]);
                }else{
                    alert('Am inregistrat comanda! Va multumim!');
                    location.href=baseURL;
                }
            });
        }
    });
    
    $('.login_checkout').click(function(e){
        e.preventDefault();
        billing = $('.invoice_address').val();
        shipping = $('.shipping_address').val();
		
        if(billing == '' || billing == 0 || billing == 'same'){
            billing = shipping;
        }
		
        shipping_type = $('.shipping_type').val();
        shipping_pay = $('.shipping_pay').val();
        
        if(billing == '' || shipping =='' || shipping_type =='' || shipping_pay ==''){
            alert('Va rugam alegeti adresa de facturare si livrare, precum si modul de transport si plata!');
        }else{
            $.post(baseURL + "libs/classes/ajax.php", {
                mode: "login_checkout",
                billing: billing,
                shipping: shipping
            },
            function(data) { 
                type = data[0];
                if(type == '@'){
                    alert(sys_messages[data.substr(1)]);
                }else{
                    alert('Am inregistrat comanda! Va multumim!');
                    location.href=baseURL;
                }
            });
        }
    });
    
    $('.slidernav').live('click',function(e){
        e.preventDefault();
        
        clearInterval(inter_id);
        
        num = $(this).index()-2;
        $('#slideshow IMG.active').removeClass('active');
        $('#slideshow IMG:eq('+num+')').addClass('active');
        
        slideSwitch();
        setInterval( "slideSwitch()", 5000 );
    });

});

function slideSwitch() {
    var $active = $('#slideshow IMG.active');

    if ( $active.length == 0 ) $active = $('#slideshow IMG:last');

    // use this to pull the images in the order they appear in the markup
    var $next =  $active.next().length ? $active.next() : $('#slideshow IMG:first');

    $('.bannernavleft').attr('rel', $next.index()-1);
    $('.bannernavright').attr('rel', $next.index()+1);

    // uncomment the 3 lines below to pull the images in random order
    
    //var $sibs  = $active.siblings();
    //var rndNum = Math.floor(Math.random() * $sibs.length );
    //var $next  = $( $sibs[ rndNum ] );

    $active.addClass('last-active');

    $next.css({
        opacity: 0.0
    })
    .addClass('active')
    .animate({
        opacity: 1.0
    }, 1000, function() {
        $active.removeClass('active last-active');
    });
}

function webshop_alert(message_holder, options){
    if(jQuery.isArray(options)){

    }
    else{
        $('#popup-holder').removeClass('hiddendiv');
        tmp = message_holder.split('##');
        $('#popup-holder').find('.popuptitle').html(tmp[0]);
        $('#popup-holder').find('.popupparagraph').html(tmp[1]);
        $('#popup-holder').find('.popupbutton').html('Back ');
        $('#nextstep').val(options);
    }
}

jQuery.fn.ForceNumericOnly = function(){
    return this.each(function() {
        $(this).keydown(function(e) {
            var key = e.charCode || e.keyCode || 0;
            // allow backspace, tab, delete, arrows, numbers and keypad numbers ONLY
            return (
                key == 8 ||
                key == 9 ||
                key == 46 ||
                (key >= 37 && key <= 40) ||
                (key >= 48 && key <= 57) ||
                (key >= 96 && key <= 105));
        });
    });
};