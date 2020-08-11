//remove empty images *************************************************************************
$("img").each
    (
      function () {
          var elem = $(this);
          if (elem.attr("src") == "" || elem.attr("src") == undefined) {
              elem.remove();
          }
      }
    );


/* Isotype */

// cache container
var $container = $('#portfolio');
// initialize isotope
$container.isotope({
  // options...
});

// filter items when filter link is clicked
$('#filters a').click(function(){
  var selector = $(this).attr('data-filter');
  $container.isotope({ filter: selector });
  return false;
});