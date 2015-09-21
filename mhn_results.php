<?php

$mhn_debug = false ;

if ($mhn_debug) {
foreach ($_GET as $key => $value) {
echo '<p>' . "\$key = $key" . '</p>' . "\n" ;
echo '<p>' . "\$value = $value" . '</p>' . "\n" ;
}
exit;
}

if ( count($_GET) == 0 ) { exit; }

require 'mhn_db_link.php';

$where = $_GET['s_script_criteria'];

// acquisizione lista id degli oggetti
$sql = "SELECT `id` FROM `obj_pt` WHERE $where";
$tabquery = $db->query($sql);
$tabquery->setFetchMode(PDO::FETCH_ASSOC);
$tot_fic = $tabquery->rowCount();
echo '<div style="float:left;width:100%;text-align:left;margin-bottom:20px;">'.
'<b>Número total de fichas: </b>'.$tot_fic.'</div>';
foreach ($tabquery as $tabres) {
$id_obj = $tabres['id'];
// acquisizione lista id delle immagini
$sql2 = "SELECT `id_ima` FROM `ima_obj_pt` WHERE `id_obj` = $id_obj AND ord = 1";
$tabquery2 = $db->query($sql2);
$tabquery2->setFetchMode(PDO::FETCH_ASSOC);
foreach ($tabquery2 as $tabres2) {
$id_ima = $tabres2['id_ima'];
$njpg = str_pad($id_ima,8,'0',STR_PAD_LEFT);
echo '<div style="border:solid 1px black;float:left;width:110px;height:110px;"><img alt="'.$id_ima.
'" src="'.$dirthu.$njpg.'.jpg?'.rand(1, 10000).
'" style="padding:4px 4px 4px 4px;cursor:pointer;" id="mhn_ima_'.$njpg.'" class="mhn_obj_'.$id_obj.'" /></div>';
}
}




?>
