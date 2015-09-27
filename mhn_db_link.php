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

?>
