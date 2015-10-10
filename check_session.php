<?php
if (! check_get('opt') ) { exit; }
$opt = $_GET['opt'];
session_start();
if ($opt == 'login') {
	$ca = $_GET['ca'];
	$ca = stripslashes($ca);
	if ( $_SESSION['res'] != $ca ) {echo '<p style="color:red;font-weight:bold;">Resultado não correto</p>'; exit;}
	if (! check_get('no') ) {echo '<p style="color:red;font-weight:bold;">Nome ou senha não correta</p>'; exit; }
	if (! check_get('se') ) {echo '<p style="color:red;font-weight:bold;">Nome ou senha não correta</p>'; exit; }
	require 'mhn_db_link.php';
	$no = $_GET['no'];
	$no = stripslashes($no);
	$no = $db->quote($no);
	$se = $_GET['se'];
	$se = stripslashes($se);
	$se = $db->quote($se);
	$result = $db->query('SELECT * FROM `login` WHERE name = '.$no.' AND pass = '.$se);
	// il risultato può soilo essere uno perché la tabella non può accettare doppioni (see contrain)
	//$result->setFetchMode(PDO::FETCH_OBJ);
	if ($result->rowCount() > 0) {$_SESSION['vai'] = true; echo '<p style="color:blue;font-weight:bold;">Está autorizado</p>'; exit;
	} else {echo '<p style="color:red;font-weight:bold;">Nome ou senha não correta</p>'; exit;}
}
if ($_SESSION['vai']) {

} else { echo '<p style="color:red;font-weight:bold;">Esta opção é disponível apenas para administradores</p>'; exit;}
//----------------------------------------------------------------------------------------------------------------------
function check_get ($var) {
	if($_GET[$var] === '') {
		//echo '<p style="color:red;font-weight:bold;">'.$var.' is an empty string</p>';
		return false;
	}
	if($_GET[$var] === false) {
		//echo '<p style="color:red;font-weight:bold;">'.$var.' is false</p>';
		return false;
	}
	if($_GET[$var] === null) {
		//echo '<p style="color:red;font-weight:bold;">'.$var.' is null</p>';
		return false;
	}
	if(!isset($_GET[$var])) {
		//echo '<p style="color:red;font-weight:bold;">'.$var.' is not set</p>';
		return false;
	}
	if(empty($_GET[$var])) {
		//echo '<p style="color:red;font-weight:bold;">'.$var.' is empty</p>';
		return false;
	}
	return true;
}
//----------------------------------------------------------------------------------------------------------------------
?>
