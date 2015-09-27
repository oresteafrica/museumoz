$(document).ready(function($) {

$('#museumoz_ifr').attr('src','mhn_db.php?mhn_obj_pt_record=1');


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
			ifr.attr('src','mhn_db.php?mhn_obj_pt_record=1');
		break;
		case 1:
			ifr.attr('src','mhn_pesquisa.php');
		break;
		case 2:
			ifr.attr('src','nova_ficha_minima.php');
		break;
		case 3:
			ifr.attr('src','../maintenance.jpg');
		break;
		case 4:
			ifr.attr('src','../maintenance.jpg');
		break;
		default:
			return;
	}


});

}); // $
