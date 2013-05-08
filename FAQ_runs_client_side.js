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