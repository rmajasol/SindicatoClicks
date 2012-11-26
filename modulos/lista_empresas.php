<?php

// constantes
$miembros_1 = 5;
$miembros_2 = 10;
$miembros_3 = 20;
$c_ad_1 = 0.5;
$c_ad_2 = 0.9;
$c_ad_3 = 1.2;
$ads_dia_1 = 3;
$ads_dia_2 = 7;
$ads_dia_3 = 15;
$c_dia_1 = 4;
$c_dia_2 = 8;
$c_dia_3 = 20;
$porc_1 = 26;
$porc_2 = 51;
$porc_3 = 101;

$sql = "SELECT * FROM $TABLA_EMPRESAS";
if (isset($_GET['estado']))
	$sql .= " WHERE $ESTADO='".$_GET['estado']."'";
else
	$sql .= " WHERE $ESTADO!='scam'";
$sql .= " ORDER BY $NOMBRE_DE_EMPRESA ASC";
$res = mysql_query($sql) or die (mysql_error());
$count = mysql_num_rows($res);?>

<? //////////////////////////////// SUBMENU ////////////////////////////////////////////?>
<div id="submenu"><?
	include("./modulos/lista_empresas/submenu.php");?>
</div><?

//////////////////////////////// TITULO 2 ////////////////////////////////////////////?>
<div id="titulo2"><?
	include("./modulos/lista_empresas/titulo2.php");?>
</div><?

/////////////////////////////// CUADRITO ///////////////////////////////////////////////
if ($_GET['estado'] != 'scam'){?>
	<div class="texto1"><div class='boxtop2'><div></div></div><div class="content">
		Éstas son las PTCs que de momento tiene la comunidad en activo. Puedes ordenar la lista como prefieras pulsando en las cabeceras de la tabla. No obstante, si crees haber encontrado alguna interesante que no figure aquí te agradeceríamos que lo comunicases en <a href="./foro/viewtopic.php?t=16" target="_blank">este hilo</a>. Gracias!</div>
	</div><?
}

//////////////////////////////// TABLA ////////////////////////////////////////////
if ($_GET['estado'] == 'scam')
	include("./modulos/lista_empresas/tabla_scam.php");
else
	include("./modulos/lista_empresas/tabla.php");?>
