$(document).ready(function($) {

$('#museumoz_ifr').attr('src','http://museumoz.org/php/mhn_db.php?mhn_obj_pt_record=1');


$('#museumoz_menu li span').click(function() {
	var par = $(this).parents();
	var gra = $(this).parents().parents();
	var ifr = $('#museumoz_ifr');
	var ind = par.index();
	var tag = par.prop('tagName');
	var act = par.hasClass('active');
	gra.children().removeClass('active');
	par.addClass('active');
	$(this).blur();

	switch (ind) {
		case 0:
			ifr.attr('src','http://museumoz.org/php/mhn_db.php?mhn_obj_pt_record=1');
		break;
		case 1:
			ifr.attr('src','http://museumoz.org/php/mhn_pesquisa.php');
		break;
		case 2:
			ifr.attr('src','http://museumoz.org//maintenance.jpg');
		break;
		case 3:
			ifr.attr('src','http://museumoz.org//maintenance.jpg');
		break;
		default:
			return;
	}


});

}); // $
