$(document).ready(function() {
//--------------------------------------------------------------------------------------------------
$('#mhn_records_bu_vai').click(function() {
	var mhn_var_nvai = $('#mhn_records_in_vai').val();
	var mhn_var_goto = mhn_var_topdir + 'mhn_db.php?mhn_obj_pt_record=' + mhn_var_nvai ;
	if (mhn_var_nvai < 1 || mhn_var_nvai > mhn_var_num_rows) {
		alert('não existe a ficha n. '+mhn_var_nvai);
		return false;
	}
	window.location.href = mhn_var_goto ;	
});
//--------------------------------------------------------------------------------------------------
$('.mhn_thumb').click(function() {
	$('#mhn_ima_big_wait').show();
	var mhn_var_thu_id = this.id;
	var mhn_int_img_obj = new Image();
	var mhn_int_img_src = mhn_var_imgdir + mhn_var_thu_id.substr(10, 8) + '.jpg';

	$(mhn_int_img_obj)
	.load(function() {
		var mhn_int_img_w = this.width + 50;
		var mhn_int_img_h = this.height + 76;
		$('#mhn_ima_big_ficha').html(mhn_int_img_obj);
		$('#mhn_ima_big_ficha').dialog({
			title: 'imagem n. ' + mhn_var_thu_id.substr(10, 8),
			position: { my: "left top", at: "left top", of: window },
			modal: true,
			width: mhn_int_img_w,
			height: mhn_int_img_h
			});
		$('#mhn_ima_big_wait').hide();
	})
	.error(function() {
		alert('Não consegue carregar a imagem, prova mais tarde.');
		})
	.attr('src', mhn_int_img_src );
});
//--------------------------------------------------------------------------------------------------



});
