<?php
session_start();
if (! $_SESSION['vai']) {echo '<p style="color:red;font-weight:bold;">Esta op&ccedil;&atilde;o &eacute; dispon&iacute;vel apenas para administradores</p>'; exit;}
require 'mhn_db_link.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Nova ficha minima</title>
<meta charset='utf-8'>
<link href="js/jquery-ui/jquery-ui.min.css" rel="stylesheet">
<script src="js/jquery-2.1.3.min.js"></script>
<script src="js/jquery-ui/jquery-ui.min.js"></script>
<script src="js/nova_ficha_minima.js"></script>
<script>
<?php
echo 'mhn_var_topdir = \'' . $topdir_html . '\'' . ";\n";
echo 'mhn_var_imgdir = \'' . $dirimma . '\'' . ";\n";
?>
</script>
<style>
body {
	font-family:Arial;
}
#nova_ficha_minima {
	float:left;
	width:100%;
}
#mhn_records_from_db {
	float:left;
	width:60%;
}
.mhn_records_key {
	background-color:#000000;
	color:#ffffff;
	padding-left:6px;
	width:50%;
}
.mhn_records_value {
	background-color:transparent;
	padding-left:6px;
	width:50%;
}
.mhn_records_value select,
.mhn_records_value input {
	background-color:#C3A64A;
	color:#000000;
	width:100%;
}
#mhn_ima_big_wait {
    display:    none;
    position:   fixed;
    z-index:    1000;
    top:        0;
    left:       0;
    height:     100%;
    width:      100%;
    background: rgba( 255, 255, 255, .8 ) 
                url('<?php echo $topdir_html; ?>gif/ajax-loader_03.gif') 
                50% 50% 
                no-repeat;
}
#debug {
	float:left;
	border:solid red 2px;
	padding: 4px 4px 4px 4px;
	display: none;
}
</style>
</head>
<body>
<div id="nova_ficha_minima">
<table id="mhn_records_from_db">
<tbody>
<td class="mhn_records_key">Localização</td>
<td class="mhn_records_value"><?php make_select_from_table($db,'ist_pt','id','nome') ?> </td>
</tr>
<tr>
<td class="mhn_records_key">Propriedade</td>
<td class="mhn_records_value"><?php make_select_from_table($db,'ist_pt','id','nome') ?> </td>
</tr>
<tr>
<td class="mhn_records_key">Numero de inventário</td>
<td class="mhn_records_value"><input type="text" /></td>
</tr>
<tr>
<td class="mhn_records_key">Data de aquisição</td>
<td class="mhn_records_value"><input type="text" class="datepicker" id="data_acq" readonly /></td>
</tr>
<tr>
<td class="mhn_records_key">Forma e função</td>
<td class="mhn_records_value"><?php make_select_from_table($db,'form_fun_pt','id','nome') ?> </td>
</tr>
<tr>
<td class="mhn_records_key"></td>
<td class="mhn_records_value"><?php make_select_from_table($db,'form_fun_pt','id','nome') ?> </td>
</tr>
<tr>
<td class="mhn_records_key">Técnica</td>
<td class="mhn_records_value"><?php make_select_from_table($db,'tec_pt','id','nome') ?> </td>
</tr>
<tr>
<td class="mhn_records_key"></td>
<td class="mhn_records_value"><?php make_select_from_table($db,'tec_pt','id','nome') ?> </td>
</tr>
<tr>
<td class="mhn_records_key">Nome geral do objecto</td>
<td class="mhn_records_value"><?php make_select_from_table($db,'nome_geral_objecto','id','nome') ?> </td>
</tr>
<tr>
<td class="mhn_records_key">Material</td>
<td class="mhn_records_value"><?php make_select_from_table_material($db) ?> </td>
</tr>
<tr>
<td class="mhn_records_key"></td>
<td class="mhn_records_value"><?php make_select_from_table_material($db) ?> </td>
</tr>
<tr>
<td class="mhn_records_key"></td>
<td class="mhn_records_value"><?php make_select_from_table_material($db) ?> </td>
</tr>
<tr>
<td class="mhn_records_key"></td>
<td class="mhn_records_value"><?php make_select_from_table_material($db) ?> </td>
</tr>
<tr>
<td class="mhn_records_key">Dimensão x mm</td>
<td class="mhn_records_value"><input type="number" min="0" max="99999" value="0" /></td>
</tr>
<tr>
<td class="mhn_records_key">Dimensão y mm</td>
<td class="mhn_records_value"><input type="number" min="0" max="99999" value="0" /></td>
</tr>
<tr>
<td class="mhn_records_key">Dimensão z mm</td>
<td class="mhn_records_value"><input type="number" min="0" max="99999" value="0" /></td>
</tr>
<tr>
<td class="mhn_records_key">Descrição</td>
<td class="mhn_records_value"><input type="text" /></td>
</tr>
<tr>
<td class="mhn_records_key">Representação</td>
<td class="mhn_records_value"><input type="text" /></td>
</tr>
<tr>
<td class="mhn_records_key">Produtor, fabricante, autor</td>
<td class="mhn_records_value"><?php make_select_from_table($db,'per_pt','id','nome') ?> </td>
</tr>
<tr>
<td class="mhn_records_key">Lugar de produção</td>
<td class="mhn_records_value"><input type="text" /></td>
</tr>
<tr>
<td class="mhn_records_key">Etnia de produção</td>
<td class="mhn_records_value"><?php make_select_from_table($db,'etn_pt','id','nome') ?> </td>
</tr>
<tr>
<td class="mhn_records_key">Função</td>
<td class="mhn_records_value"><?php make_select_from_table($db,'fun_obj_pt','id','nome') ?> </td>
</tr>
</tbody>
</table>
</div>
<div id="mhn_ima_big_wait" style="display:none;">
<img alt="wait" src="http://localhost/museumoz.org/php/gif/ajax-loader_03.gif" />
</div>
<div id="debug"></div>
</body>
</html>
