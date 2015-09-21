jQuery(document).ready(function($) {

debug_mode = false;

//----------------------------------------------------------------------------------------------------------------------
$('#search_box_button_pesquisar').click(function() {
var rra = Math.round(Math.random() * 100) ;
var a_script_criteria = [];
var a_human_criteria = [];

var mhn_search_boxes = new Object();;
mhn_search_boxes['Numero de inventário'] = ['1_4'];
mhn_search_boxes['Nome geral do objecto'] = ['2_10'];
mhn_search_boxes['Forma e função'] = ['2_2_1_pt','2_2_2_pt'];
mhn_search_boxes['Função'] = ['3_6_pt'];
mhn_search_boxes['Técnica'] = ['2_3_1_pt','2_3_2_pt'];
mhn_search_boxes['Material'] = ['2_14_1_pt','2_14_2_pt','2_14_3_pt','2_14_4_pt'];
mhn_search_boxes['Descrição'] = ['2_17_pt']; 
mhn_search_boxes['Representação'] = ['2_18_pt'];
mhn_search_boxes['Etnia de produção'] = ['3_3_pt'];
mhn_search_boxes['Produtor, fabricante, autor'] = ['3_1_pt'];
mhn_search_boxes['Propriedade'] = ['1_3'];
mhn_search_boxes['Localização'] = ['1_2_pt'];

var vv ; // value
var ll ; // label
var ff ; // field
var vq ; // value quoted
var sq ; // select text
var et ; // element type
var lv ; // literal value

if (debug_mode) {
$('#mhn_test_div').html('');
$('#mhn_test_div').show();
$('#mhn_test_div').append('<table style="border-collapse:collapse;"><thead><th style="border:solid 1px black;">i</th><th style="border:solid 1px black;">$(e).is(\':checked\')</th><th style="border:solid 1px black;">e.id</th><th style="border:solid 1px black;">tag</th><th style="border:solid 1px black;">id</th><th style="border:solid 1px black;">value</th><th style="border:solid 1px black;">text</th><th style="border:solid 1px black;">label</th><th style="border:solid 1px black;">field criteria</th></thead><tbody></tbody></table>');
}

$('.mhn_chk_pesquisa').each(function (i,e) {
et = $('#search_box_'+e.id.substr(11,2)).prop("tagName");
if ( et.toLowerCase() == 'select' ) { lv = $('#search_box_'+e.id.substr(11,2)+' option:selected').text(); } else { lv = $('#search_box_'+e.id.substr(11,2)).val();; }
if ($(e).is(':checked')) {
	vv = $('#search_box_'+e.id.substr(11,2)).val();
	if ( $.isNumeric(vv) ) { vq = vv; } else { vq = '\''+vv+'\''; }
	ll = $('#search_box_label_'+e.id.substr(11,2)).text();
	ff = '(\`' + mhn_search_boxes[ll].join('\` = '+vq+' OR \`') + '\` = '+vq+')';
	a_script_criteria.push(ff); 
	a_human_criteria.push(ll+': '+lv); 
} else {
	vv = '';
	ll = '';
	ff = '';
}

if (debug_mode) {
$('<tr><td style="border:solid 1px black;">'+i+' </td><td style="border:solid 1px black;">'+$(e).is(':checked')+' </td><td style="border:solid 1px black;">'+e.id+'</td><td style="border:solid 1px black;">'+et+'</td><td style="border:solid 1px black;">'+e.id.substr(11,2)+'</td><td style="border:solid 1px black;">'+vv+'</td><td style="border:solid 1px black;">'+lv+'</td><td style="border:solid 1px black;">'+ll+'</td><td style="border:solid 1px black;">'+ff+'</td></tr>').appendTo('#mhn_test_div table');
}

}); // each

var s_script_criteria = a_script_criteria.join(' AND ');

if (debug_mode) {
$('<hr />').appendTo('#mhn_test_div');
$('<p>'+s_script_criteria+'</p>').appendTo('#mhn_test_div');
$('<hr />').appendTo('#mhn_test_div');
$('<p>'+a_human_criteria.join('<br />')+'</p>').appendTo('#mhn_test_div');
return;
} else {
//$('.mhn_chk_pesquisa').removeAttr('checked');
if ( s_script_criteria.length < 5 ) { alert('Não foi definido nenhum critério'); return; }
}


$.ajax({
url: mhn_var_topdir+'mhn_results.php',
data:'s_script_criteria='+s_script_criteria,
type: 'GET',
dataType: 'html',
beforeSend: function(a){
$('#search_box_button_pesquisar').hide();
},
success: function(a){
$('#mhn_thu_result_div').html('<div style="float:left;width:100%;text-align:left;margin-bottom:20px;"><b>Critério</b><br />'+
a_human_criteria.join('<br />')+'</div>'+a);
$('#mhn_thu_result_div').dialog({
			title: 'Resultado da pesquisa - clique a imagem para observar a ficha',
			modal: true,
			width: 720,
			height: 720,
			close: function( ev, ui ) { $('#mhn_criteria_div p').html(''); }
			});
$('img').click(function() {
var img_id = this.id.substr(9);
var fic_id = $(this).prop('class').substr(8);
$('#mhn_ficha_from_result_div').html('');
$('#mhn_ficha_from_result_div').append($('<iframe style="width:780px;height:780px" />').attr('src', mhn_var_topdir+'mhn_db.php?mhn_obj_pt_record='+fic_id+'&mhn_pesquisa=true')).dialog({
			title: 'ficha n. '+fic_id+' imagem n. '+img_id,
			modal: true,
			width: 800,
			height: 800
			});

});
}, // success
error: function(a,b,c){ alert( 'a.status = ' + a.status + '\na.responseText = ' + a.responseText + '\nb = ' + b + '\nc = ' + c ) },
complete: function(a,b){ $('#search_box_button_pesquisar').show(); }
});

}); // click

}); // $
