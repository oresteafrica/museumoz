<?php
$recno = $_GET['mhn_obj_pt_record'];
$pesquisa = false;
$pesquisa = $_GET['mhn_pesquisa'];
if ( empty($recno) ) { exit; }
if ( ! is_numeric($recno)) { exit; }
require 'mhn_db_link.php';

$fichas = $db->query('SELECT * FROM `obj_pt`');
$fichas->setFetchMode(PDO::FETCH_ASSOC);    
$num_rows = $fichas->rowCount();
$result = $db->query('SELECT * FROM `obj_pt` WHERE id = '.$recno);
$result->setFetchMode(PDO::FETCH_ASSOC);
$reimma = $db->query("SELECT id_ima FROM `ima_obj_pt` WHERE id_obj = $recno ORDER BY ord");
$reimma->setFetchMode(PDO::FETCH_OBJ);
$row  = $result->fetch();
$ficha_suce = $recno==$num_rows?1:($recno+1);
$ficha_prec = $recno==1?$num_rows:($recno-1);

$newkey = array(
'id' => '',
'1_1_pt' => '',
'1_2_pt' => 'Localização',
'1_3' => 'Propriedade',
'1_4' => 'Numero de inventário',
'1_5_pt' => '',
'1_6' => 'Data de aquisição',
'1_7_pt' => '', 
'1_8_pt' => '',
'2_2_1_pt' => 'Forma e função',
'2_2_2_pt' => 'Forma e função',
'2_3_1_pt' => 'Técnica',
'2_3_2_pt' => 'Técnica',
'2_10' => 'Nome geral do objecto',
'2_11' => '', 
'2_12' => '', 
'2_13_pt' => '', 
'2_14_1_pt' => 'Material',
'2_14_2_pt' => 'Material',
'2_14_3_pt' => 'Material',
'2_14_4_pt' => 'Material',
'2_15_1_pt' => '',
'2_15_2_pt' => '',
'2_16_x_mm' => 'Dimensão x mm',
'2_16_y_mm' => 'Dimensão y mm',
'2_16_z_mm' => 'Dimensão z mm',
'2_17_pt' => 'Descrição', 
'2_18_pt' => 'Representação',
'2_19_pt' => '', 
'2_20_pt' => '', 
'3_1_pt' => 'Produtor, fabricante, autor',
'3_2_pt' => 'Lugar de produção', 
'3_3_pt' => 'Etnia de produção',
'3_4_pt' => '',
'3_5' => '',
'3_6_pt' => 'Função',
'3_7_pt' => '', 
'3_8_pt' => '', 
'3_9_pt' => '', 
'3_10_pt' => '', 
'3_11_pt' => '', 
'3_12_pt' => '', 
'3_13_pt' => '', 
'3_14_pt' => '', 
'3_15_pt' => '', 
'3_16_pt' => ''
);

$prevkey = '';

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Ficha</title>
<meta charset='utf-8'>
<link href="js/jquery-ui/jquery-ui.min.css" rel="stylesheet">
<script src="js/jquery-2.1.3.min.js"></script>
<script src="js/jquery-ui/jquery-ui.min.js"></script>
<script src="js/ficha.js"></script>
<script>
<?php
echo 'mhn_var_topdir = \'' . $topdir_html . '\'' . ";\n";
echo 'mhn_var_imgdir = \'' . $dirimma . '\'' . ";\n";
echo 'mhn_var_recno = ' . $recno . ";\n";
echo 'mhn_var_num_rows = ' . $num_rows . ";\n";
?>
</script>
<style>
body {
font-family:Arial;
}
#mhn_records_from_db {
float:left;
width:50%;
}
.mhn_records_key {
background-color:#000000;
color:#ffffff;
padding-left:6px;
width:50%;
}
.mhn_records_value {
background-color:#C3A64A;
color:#000000;
padding-left:6px;
width:50%;
}
.mhn_records_nav {
text-align:center;
background-color:#000000;
color:#ffffff;
padding-left:6px;
width:50%;
}
.mhn_records_nav a {
text-decoration:none;
color:#ffffff;
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
</style>
</head>
<body>

<?php

echo '<table id="mhn_records_from_db"><tbody>';

if ($pesquisa) {} else {

echo '<tr><td class="mhn_records_nav"><a href="'.$topdir_html . 'mhn_db.php?mhn_obj_pt_record=' . $ficha_prec.'">ficha precedente</a></td><td class="mhn_records_nav"><a href="'.$topdir_html . 'mhn_db.php?mhn_obj_pt_record=' . $ficha_suce.'">ficha sucessiva</a></td></tr>'."\n" ;

echo '<tr><td></td><td></td></tr>'."\n" ;
echo '<tr><td></td><td></td></tr>'."\n" ;
echo '<tr><td></td><td></td></tr>'."\n" ;

echo '<tr><td class="mhn_records_key">Ficha '.$recno.'/'.$num_rows.'</td><td class="mhn_records_key">Vai para ficha n. <input type="number" inputmode="Numeric" id="mhn_records_in_vai" style="width:50px;margin-right:20px;" maxlength="4" min="1" max="'.$num_rows.'" /><button id="mhn_records_bu_vai">Vai</button></td></tr>'."\n" ;
}

echo '<tr><td></td><td></td></tr>'."\n" ;
echo '<tr><td></td><td></td></tr>'."\n" ;
echo '<tr><td></td><td></td></tr>'."\n" ;


foreach ($row as $key => $value) {
if ($newkey[$key]=='') continue;
$newvalue = $value;
$newswitch = true;
if ( ! empty($value) ) {
switch ($key):
case '1_2_pt':
case '1_3':
$sql2 = "SELECT nome FROM `ist_pt` WHERE id = $value";
break;
case '2_2_1_pt':
case '2_2_2_pt':
$sql2 = "SELECT nome FROM `form_fun_pt` WHERE id = $value";
break;
case '2_3_1_pt':
case '2_3_2_pt':
$sql2 = "SELECT nome FROM `cat_tec_pt` WHERE id = $value";
break;
case '2_10':
$sql2 = "SELECT nome FROM `nome_geral_objecto` WHERE id = $value";
break;
case '2_14_1_pt':
case '2_14_2_pt':
case '2_14_3_pt':
case '2_14_4_pt':
$sql2 = 'SELECT nome FROM `mat_ani_pt` WHERE id = 1';
if ($value < 1000 || $value > 3999) { $newswitch = false ; break ; }
if ($value > 999 && $value < 2000) { $sql2 = 'SELECT nome FROM `mat_ani_pt` WHERE id = ' . ($value - 1000) ; }
if ($value > 1999 && $value < 3000) { $sql2 = 'SELECT nome FROM `mat_veg_pt` WHERE id = ' . ($value - 2000) ; }
if ($value > 2999 && $value < 4000) { $sql2 = 'SELECT nome FROM `mat_min_pt` WHERE id = ' . ($value - 3000) ; }
break;
case '3_1_pt':
$sql2 = "SELECT nome FROM `per_pt` WHERE id = $value";
break;
case '3_3_pt':
$sql2 = "SELECT nome FROM `etn_pt` WHERE id = $value";
break;
case '3_6_pt':
$sql2 = "SELECT nome FROM `fun_obj_pt` WHERE id = $value";
break;
default:
$newswitch = false ;
endswitch;

if ($newswitch) {
$result2 = $db->query($sql2);
$result2->setFetchMode(PDO::FETCH_ASSOC);   
$newvalue = $result2->fetch()['nome'];
} else {
$newvalue = $value;
}

} else {  // fine if ( ! empty($value) )
$newvalue='&nbsp;';
}

echo '<tr>'."\n";
if ( $prevkey != $newkey[$key] ) {
echo '<td class="mhn_records_key">'.$newkey[$key].'</td>';
} else { echo '<td class="mhn_records_key"></td>'; }
echo '<td class="mhn_records_value">'.print_r($newvalue,1).'</td>';
echo '</tr>'."\n";

$prevkey = $newkey[$key];
} // fine foreach

echo '</tbody></table>';

echo '<div style="float:right;width:50%;">'."\n";

$thus = '<div style="float:left;width:98%;height:120px;overflow-x:auto;overflow-y:hidden;margin-bottom:20px;white-space:nowrap;">'."\n";
while ($idimma = $reimma->fetch()) {
$njpg = str_pad($idimma->id_ima,8,'0',STR_PAD_LEFT);
$thus .= '<img alt="'.$idimma->id_ima.
'" src="'.$dirthu.$njpg.
'.jpg?'.rand(1, 10000).'" style="margin-right:10px;cursor:pointer;display:inline;" id="mhn_thumb_'.$njpg.'" class="mhn_thumb" />';
}
$thus .= '<div style="float:left;width:98%;height:20px;font-size:x-small;">Clique para aumentar</div>';
$thus .= '</div>';

echo $thus;

echo '<div id="mhn_ima_big_ficha" style="display:none;">'."\n";
echo '</div>'."\n" ;

echo '<div id="mhn_ima_big_wait" style="display:none;">'."\n";
echo '<img alt="wait" src="'.$topdir_html.'gif/ajax-loader_03.gif" />'."\n" ;
echo '</div>'."\n" ;


?>       




</body>
</html>
