<!doctype html>
<head>
	<meta charset='utf-8'>
	<link rel="stylesheet" href="css/menu.css">
	<link href="js/jquery-ui/jquery-ui.min.css" rel="stylesheet">
	<script src="js/jquery-2.1.3.min.js" type="text/javascript"></script>
	<script src="js/jquery-ui/jquery-ui.min.js"></script>
	<script>
<?php
require 'mhn_db_link.php';
echo 'var topdir_html = \'' . $topdir_html . '\';';
?>
	</script>
	<script src="js/menu.js"></script>
	<title>Museumoz</title>
</head>
<body>
<div id='museumoz_menu'>
<ul>
	<li class='active'><span>Ficha</span></li>
	<li><span>Pesquisa</span></li>
	<li><span>Nova</span></li>
	<li><span>Imagens</span></li>
	<li><span>Suporte</span></li>
	<li><span>Pessoas</span></li>
	<li><span>Modifica</span></li>
	<li><span>Login</span></li>
</ul>
</div>
<div id="museumoz_login">
<label>Nome</label>
<input type="text" />
<label>Senha</label>
<input type="password" />
<image src="" alt="captcha" />
<label>Resultado</label>
<input type="text" />
<button>Login</button>
</div>
<iframe id="museumoz_ifr" src="http://localhost/museumoz.org/php/mhn_db.php?mhn_obj_pt_record=1" frameborder="0" style="width:100%;min-height:700px;">
 <p>Your browser does not support iframes. Use a different one.</p>
</iframe>
</body>
<html>
