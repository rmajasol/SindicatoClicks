<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="shortcut icon" href="./files/images/icons/favicon.ico" >
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>SindicatoClicks [gestión] [<? echo "$username";?>]</title>
    
<link rel="STYLESHEET" type="text/css" href="../common.css">
<link rel="STYLESHEET" type="text/css" href="./layouts/style_layout1_gestion.css">
<link rel="STYLESHEET" type="text/css" href="styles_gestion.css">
</head>

<body>
<script type='text/javascript' src='../files/javascripts/sorttable.js'></script>
<div id="pagina">
	<div id="cabecera">
		<div class="titulo">Área de gestión [<? echo "$username";?>]</div>
		<div id="menu_gestion"><? include("./layouts/layout1/menu_gestion.php");?></div>
	</div>
	<div id="contenido"><div id="<? echo "$modulo";?>"><?
		if (file_exists( $path_modulo )) 
			include( $path_modulo );
		else 
			die('Error al cargar el módulo <b>'.$modulo.'. No existe el archivo <b>'.$conf[$modulo]['archivo'].'</b>');?>
	</div></div><!--FIN PAGINA-->
</div>
</body>
</html>
