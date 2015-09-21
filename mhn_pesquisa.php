
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Pesquisa</title>
<meta charset='utf-8'>
<link href="js/jquery-ui/jquery-ui.min.css" rel="stylesheet">
<script src="js/jquery-2.1.3.min.js"></script>
<script src="js/jquery-ui/jquery-ui.min.js"></script>
<script src="js/pesquisa.js"></script>
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
#mhn_div_search_boxes {
float:left;
width:270px;
background-color:#C3A64A;
margin-top:20px;
margin-left:20px;
}
#search_box_button_pesquisar {
margin-top:10px;
margin-bottom:20px;
margin-left:20px;
}
.mhn_search_wrap_p {
font-size:small;
margin-bottom:-2px;
margin-top:-8px;
}
.mhn_search_box_p {
background-color:#C3A64A;
color:#000000;
padding-left:6px;
padding-top:6px;
margin-top:-4px;
height:26px;
}
.mhn_search_box_label {
background-color:#000000;
color:#ffffff;
padding-left:6px;
padding-right:6px;
height:26px;
}
.mhn_sel_pesquisa {
font-size:x-small;
width:88%;
float:left;
padding-left:6px;
}
.mhn_inp_pesquisa {
font-size:x-small;
width:82%;
float:left;
padding-left:6px;
}
.mhn_dat_pesquisa {
font-size:x-small;
width:30%;
float:left;
margin-left:8px;
}
.mhn_chk_pesquisa {
float:left;
}
#mhn_test_div {
display:none;
float:right;
margin-right:20px;
font-size:small;
width:70%;
}
#mhn_thu_result_div {
display:none;
}
#mhn_ficha_from_result_div {
display:none;
}
#mhn_criteria_div {
float:left;
font-size:small;
}
#mhn_criteria_div p {
float:left;
margin-right:4px;
margin-left:4px;
}
</style>
</head>
<body>

<?php

require 'mhn_db_link.php';

$search_boxes = array(
array('input' , 'Numero de inventário','1_4'),
array('nome_geral_objecto' , 'Nome geral do objecto','2_10'),
array('form_fun_pt' , 'Forma e função','2_2_1_pt','2_2_2_pt'),
array('fun_obj_pt' , 'Função','3_6_pt'),
array('cat_tec_pt' , 'Técnica','2_3_1_pt','2_3_2_pt'),
array('mat_x_pt' , 'Material','2_14_1_pt','2_14_2_pt','2_14_3_pt','2_14_4_pt'),
array('input' , 'Descrição','2_17_pt'), 
array('input' , 'Representação','2_18_pt'),
array('etn_pt' , 'Etnia de produção','3_3_pt'),
array('per_pt' , 'Produtor, fabricante, autor','3_1_pt'),
array('ist_pt' , 'Propriedade','1_3'),
array('ist_pt' , 'Localização','1_2_pt')
);

echo '<div id="mhn_div_search_boxes">';

echo '<button id="search_box_button_pesquisar">Pesquisar</button>';

foreach ($search_boxes as $numitem => $tbs) {
$iditem = str_pad($numitem, 2, '0', STR_PAD_LEFT);
echo '<p class="mhn_search_wrap_p">';
echo '<label class="mhn_search_box_label" id="search_box_label_'.$iditem.'">'.$tbs[1].'</label>';
echo '<p class="mhn_search_box_p">';
echo '<input class="mhn_chk_pesquisa" id="search_box_'.$iditem.'_chk" type="checkbox" />';
switch ($tbs[0]) {
case 'date':
echo '<input class="mhn_dat_pesquisa" id="search_box_'.$iditem.'" type="text" />';
break;
case 'input':
echo '<input class="mhn_inp_pesquisa" id="search_box_'.$iditem.'" type="text" />';
break;
case 'mat_x_pt':
echo '<select class="mhn_sel_pesquisa" id="search_box_'.$iditem.'">';

echo '<optgroup label="Material de origem animal">';
$sql = "SELECT id,nome FROM mat_ani_pt ORDER BY nome";
$tabquery = $db->query($sql);
$tabquery->setFetchMode(PDO::FETCH_ASSOC);
foreach ($tabquery as $tabres) {
$mat_ani_id = 1000 + $tabres['id'];
echo '<option value="'.$mat_ani_id.'">'.$tabres['nome'].'</option>';
}
echo '</optgroup>';

echo '<optgroup label="Material de origem vegetal">';
$sql = "SELECT id,nome FROM mat_veg_pt ORDER BY nome" ;
$tabquery = $db->query($sql);
$tabquery->setFetchMode(PDO::FETCH_ASSOC);
foreach ($tabquery as $tabres) {
$mat_veg_id = 2000 + $tabres['id'];
echo '<option value="'.$mat_veg_id.'">'.$tabres['nome'].'</option>';
}
echo '</optgroup>';

echo '<optgroup label="Material de origem mineral">';
$sql = "SELECT id,nome FROM mat_min_pt ORDER BY nome" ;
$tabquery = $db->query($sql);
$tabquery->setFetchMode(PDO::FETCH_ASSOC);    
foreach ($tabquery as $tabres) {
$mat_min_id = 3000 + $tabres['id'];
echo '<option value="'.$mat_min_id.'">'.$tabres['nome'].'</option>';
}
echo '</optgroup>';
echo '</select>';
break;
case 'etn_pt':
$sql = "SELECT id,nome FROM $tbs[0]" ;
$tabquery = $db->query($sql);
$tabquery->setFetchMode(PDO::FETCH_ASSOC);    
echo '<select class="mhn_sel_pesquisa" id="search_box_'.$iditem.'">';
echo '<option value=""></option>'; // primo item in bianco
foreach ($tabquery as $tabres) {
echo '<option value="'.$tabres['id'].'">'.$tabres['nome'].'</option>';
}
echo '</select>';
break;
case 'per_pt':
$sql = "SELECT id,nome FROM $tbs[0] WHERE professione = 'A' ORDER BY nome" ;
$tabquery = $db->query($sql);
$tabquery->setFetchMode(PDO::FETCH_ASSOC);    
echo '<select class="mhn_sel_pesquisa" id="search_box_'.$iditem.'">';
echo '<option value=""></option>'; // primo item in bianco
foreach ($tabquery as $tabres) {
echo '<option value="'.$tabres['id'].'">'.$tabres['nome'].'</option>';
}
echo '</select>';
break;
default:
$sql = "SELECT id,nome FROM $tbs[0] WHERE nome <> '' ORDER BY nome" ;
$tabquery = $db->query($sql);
$tabquery->setFetchMode(PDO::FETCH_ASSOC);    
echo '<select class="mhn_sel_pesquisa" id="search_box_'.$iditem.'">';
echo '<option value=""></option>'; // primo item in bianco
foreach ($tabquery as $tabres) {
echo '<option value="'.$tabres['id'].'">'.$tabres['nome'].'</option>';
}
echo '</select>';
} // end switch

echo '</p>';
echo '</p>';

} // end foreach $search_boxes

?>       

</div>

<div id="mhn_thu_result_div"></div>
<div id="mhn_ficha_from_result_div"></div>

<div id="mhn_test_div"></div>

</body>
</html>



