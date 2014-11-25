jQuery(window).load(function() {
  jQuery('.flexslider').flexslider({
    animation: "fade",
    directionNav: false,
  });

/*var jQuery(".mensaje-mas-autor .parrafo")
var removedSpanString = removeElements(jQuery(".mensaje-mas-autor .parrafo"), "p");*/

jQuery(".mensaje-mas-autor .parrafo p").each(function(e){
	console.log(e);
});

});

var removeElements = function(text, selector) {
    var wrapped = $("<div>" + text + "</div>");
    wrapped.find(selector).remove();
    return wrapped.html();
}