$(document).ready(function($) {
	
	$('.datepicker').datepicker({
		closeText: 'Fechar',
		prevText: '&#x3c;Anterior',
		nextText: 'Seguinte',
		currentText: 'Hoje',
		monthNames: ['Janeiro','Fevereiro','Mar&ccedil;o','Abril','Maio','Junho',
		'Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
		monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun',
		'Jul','Ago','Set','Out','Nov','Dez'],
		dayNames: ['Domingo','Segunda-feira','Ter&ccedil;a-feira','Quarta-feira','Quinta-feira','Sexta-feira','S&aacute;bado'],
		dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','S&aacute;b'],
		dayNamesMin: ['Dom','Seg','Ter','Qua','Qui','Sex','S&aacute;b'],
		weekHeader: 'Sem',
		dateFormat: 'dd/mm/yy',
		firstDay: 0,
		isRTL: false,
		showMonthAfterYear: false,
		yearSuffix: ''
	});
		
//----------------------------------------------------------------------------------------------------------------------
    $('.mhn_records_value input').keydown(function (e) {
		// 48-57   0 to 9
		// 188      , <
		// 190      . >
		
		var tlen = $(this).val().length;
		
        // Allow: delete, backspace, enter, home, end, left, right, down, up
        if ($.inArray(e.keyCode, [46, 8, 27, 13]) !== -1 || (e.keyCode >= 35 && e.keyCode <= 40)) {
			return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }

		if (tlen>4) { e.preventDefault(); }

    });
//----------------------------------------------------------------------------------------------------------------------



}); // $
