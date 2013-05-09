// Turn simple header and paragraph HTML into an indexed FAQ, client side and lite!

$('#FAQ section h2, #FAQ section h3').each(function( index, domEle ) {
  index = index + 1;
  
  var $class = '';
	if ( $(domEle).is('h3') ) { $class = 'class="space-left"'; }
	
  $('#FAQ .side-nav').append('<li><a points="h-' + index + '"' + $class + '">' + $(domEle).clone().text() + '</a></li>');
  
  $(this).attr('id', 'h-' + index );
});

$('#FAQ .side-nav a').click( function() {
	
  nameTag = $('#' + $(this).attr('points') );
  $('html,body').animate({scrollTop: nameTag.offset().top - 100},'slow');
  return false;
  
});


// Then also bind a search form to a smooth search, tag and scroll to function

jQuery.fn.highlight = function (str, className) {
  if ( str != '' ) {
	$('.' + className).removeClass(className);
	var regex = new RegExp(str, "gi");
	this.each(function () {
		$(this).contents().filter(function() {
			return this.nodeType == 3 && regex.test(this.nodeValue);
		}).replaceWith(function() {
			return (this.nodeValue || "").replace(regex, function(match) {
				return "<span class=\"" + className + "\">" + match + "</span>";
			});
		});
	});
	return $('html,body').animate({scrollTop: $('.' + className + ':first').offset().top - 100},'slow');
  }
};

// Edit these #search-button and #FAQ-search to match your HTML
$('#search-button').click( function() { $("#FAQ section *").highlight($( '#FAQ-search').val(), "label"); });
$('#FAQ-search').keypress( function(e) { if(e.keyCode == 13) { $("#FAQ section *").highlight($( '#FAQ-search').val(), "label"); } } );