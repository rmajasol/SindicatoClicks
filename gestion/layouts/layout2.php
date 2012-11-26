<?
$id_usuario = $user->data['user_id'];
$sid = $user->data['session_id'];
if($user->data['is_registered']){  
	$registrado = 1;
	$avvy = "SELECT * FROM phpbb_users WHERE user_id =" . $id_usuario; 
	$result = mysql_query($avvy) or die (mysql_error()); 
	$row = mysql_fetch_array($result);
	$user = $row['user_type'];
	$username = $row['username'];
}else
	$registrado = 0;
	
if (esAdmin($user) == 1){

elegirScript("sorttable.js");
$sql = "SELECT $ESTILO_TABLA,$VER_TODAS_EMPRESAS,$VER_SCAM FROM $TABLA_USUARIOS WHERE $ID =" . $id_usuario; 
$res = mysql_query($sql) or die (mysql_error());
$fila = mysql_fetch_array($res);
elegirDisenioTabla($fila[$ESTILO_TABLA]);
$ver_todas = $fila[$VER_TODAS_EMPRESAS];
$ver_scam = $fila[$VER_SCAM];?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="shortcut icon" href="/files/images/icons/favicon.ico" >
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /><?
if ($registrado == 1 & esAdmin($user) == 1){?>
	<title>SindicatoClicks [gestión] [<? echo "$username";?>]</title><?
}else{?>
	<title>Acceso restringido</title><?
}?>
<link rel="STYLESHEET" type="text/css" href="/gestion/layouts/css/layout1.css">
</head>

<body>
<div id="pagina">
<div id="cabecera">
	<div id="titulo">Área de gestión [<? echo "$username";?>]</div>
	<div id="menu_gestion"><? include("/home/sv000004/public_html/gestion/layouts/layout1/menu_gestion.php");?></div>
</div>
<div id="contenido"><?
	if (file_exists( $path_modulo )) 
		include( $path_modulo );
	else 
		die('Error al cargar el módulo <b>'.$modulo.'. No existe el archivo <b>'.$conf[$modulo]['archivo'].'</b>');?>
</div><!--FIN PAGINA--><?
}else{?>
	Acceso restringido.<?
}?>
</div>
</body>
</html>