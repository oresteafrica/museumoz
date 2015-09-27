<?php

ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);

$slash = (strtoupper(substr(PHP_OS, 0, 3))=='WIN')?'\\':'/';

$serv = $_SERVER['SERVER_NAME'];

$ini_array = parse_ini_file('../cron/museumoz.ini');
$dsn = $ini_array['dsn'];
$host = $ini_array['host'];
$dbname = $ini_array['dbname'];
$user = $ini_array['user'];
$pass = $ini_array['pass'];
$topdir_html = $ini_array['topdir_html'];
$dirgif = $ini_array['dirgif'];
$dirtab = $ini_array['dirtab'];
$dirtemp = $ini_array['dirtemp'];
$dirthu = $ini_array['dirthu'];
$dirtxt = $ini_array['dirtxt'];
$dirimma = $ini_array['dirimma'];

try {
    $db = new PDO($dsn, $user, $pass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die('Problemas de conexão à base de dados:<br/>' . $e);
}


//----------------------------------------------------------------------------------------------------------------------
function make_select_from_table ($db,$table,$field_value,$field_text) {
$sql = "SELECT $field_value,$field_text FROM $table ORDER BY $field_text";
echo '<select>';
foreach ($db->query($sql) as $row) {
	echo '<option value="'.$row[$field_value].'">'.$row[$field_text].'</option>';
}
echo '</select>';
return;
}
//----------------------------------------------------------------------------------------------------------------------
function make_select_from_table_material ($db) {
echo '<select>';
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
return;
}
//----------------------------------------------------------------------------------------------------------------------

?>
