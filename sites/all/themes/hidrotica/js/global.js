jQuery(window).load(function() {
  jQuery('.flexslider').flexslider({
    animation: "fade",
    directionNav: false,
  });

  //flexslider banner principal
  jQuery('#banner-principal').flexslider({
        animation: 'slide',
        slideshowSpeed: 3000,
        controlsContainer: ".flex-container",
    });

/*var jQuery(".mensaje-mas-autor .parrafo")
var removedSpanString = removeElements(jQuery(".mensaje-mas-autor .parrafo"), "p");*/

jQuery('.mensaje-mas-autor p').each(function(){
    var p = removeElements(jQuery(this), 'p');
    jQuery(this).after(p);
});

//remover todos los comentarios con etiqueta p
jQuery('.mensaje-mas-autor p').remove();

jQuery(".node-type-blog .sharethis-wrapper").after("<span>Compartir por correo</span>");

});

var removeElements = function(text, selector) {
    var wrapped = text;
    wrapped.find(selector).remove();
    return wrapped.html();
}