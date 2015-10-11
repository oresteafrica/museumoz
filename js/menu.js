$(document).ready(function($) {
//----------------------------------------------------------------------------------------------------------------------
$('#museumoz_ifr').attr('src','mhn_db.php?mhn_obj_pt_record=1');
$('#museumoz_login').dialog({
	autoOpen: false,
	modal: true,
	title: 'Administração',
	resizable: false
	//close: function( ev, ui ) { $('#museumoz_menu li span').eq(0).click(); }
});
//----------------------------------------------------------------------------------------------------------------------
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
			ifr.attr('src','check_session.php?opt=nova');
		break;
		case 3:
			ifr.attr('src','check_session.php?opt=imagens');
		break;
		case 4:
			ifr.attr('src','check_session.php?opt=suporte');
		break;
		case 5:
			ifr.attr('src','check_session.php?opt=pessoas');
		break;
		case 6:
			ifr.attr('src','check_session.php?opt=modifica');
		break;
		case 7:
			$('#museumoz_login img').attr('src','png_code.php?'+ (Math.random() * (90) + 10) );
			$('#museumoz_login input').eq(0).val('');
			$('#museumoz_login input').eq(1).val('');
			$('#museumoz_login input').eq(2).val('');
			$('#museumoz_login').dialog('open');
		break;
		default:
			return;
	}
});
//----------------------------------------------------------------------------------------------------------------------
$('#museumoz_login button').eq(0).click(function() {
	var ifr = $('#museumoz_ifr');
	var no = $('#museumoz_login input').eq(0).val();
	var se = $('#museumoz_login input').eq(1).val();
	var ca = $('#museumoz_login input').eq(2).val();
	var wo = (Math.random() + 1).toString(36).substring(2, 5);
	//http://stackoverflow.com/questions/1349404/generate-a-string-of-5-random-characters-in-javascript
	//alert('trabalho em curso\n\n'+no+'\n'+se+'\n'+ca);
	ifr.attr('src','check_session.php?opt=login&no='+no+'&se='+se+'&ca='+ca+'&wo='+wo);
	$('#museumoz_login').dialog('close');
});
//----------------------------------------------------------------------------------------------------------------------
function ajax_call(url, data, target) {
$.ajax({
url: url,
data: data,
type: 'GET',
dataType: 'html',
beforeSend: function(a){  },
success: function(a){
//alert(a);
target.html(a);
},
error: function(a,b,c){ alert( 'a = ' + a.responseText + '\nb = ' + b + '\nc = ' + c ) },
complete: function(a,b){  }
});
}
//----------------------------------------------------------------------------------------------------------------------
}); // $
