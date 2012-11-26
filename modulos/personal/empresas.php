<?php

$sql = "SELECT $ULTIMOS_CLICKS,$ULTIMO_MANTENIM FROM $TABLA_USUARIOS WHERE $ID=" . $id_usuario;
$res = mysql_query($sql) or die (mysql_error());
$fila = mysql_fetch_array($res);
$ultimos_clicks = $fila[$ULTIMOS_CLICKS];
$ultimo_mantenimiento = substr($fila[$ULTIMO_MANTENIM],0,10);
if ($_GET['cat'] != 'mias') {
	$sql1 = "SELECT $TABLA_PAGOS.*,$TABLA_EMPRESAS.* FROM $TABLA_PAGOS RIGHT JOIN "
			. "$TABLA_EMPRESAS ON $WHERE $TABLA_PAGOS.$ID_EMPRESA=$TABLA_EMPRESAS.$ID "
			. "and $TABLA_PAGOS.$ID_USUARIO=" .$id_usuario;
	if (isset($_GET['estado']))
		$sql1 .= " WHERE $TABLA_EMPRESAS.$ESTADO='".$_GET['estado']."'";
	else
		$sql1 .= " WHERE $ESTADO!='scam'";	
	$sql2 = "SELECT $TABLA_PAGOS.*,$TABLA_EMPRESAS.* FROM $TABLA_EMPRESAS INNER JOIN "
			. "$TABLA_PAGOS ON $TABLA_PAGOS.$ID_EMPRESA=$TABLA_EMPRESAS.$ID "
			. "WHERE $TABLA_PAGOS.$ID_USUARIO=" .$id_usuario;
	if (isset($_GET['estado']))
		$sql2 .= " and $ESTADO='".$_GET['estado']."'";
	else
		$sql2 .= " and $ESTADO!='scam'";	
	$res1 = mysql_query($sql1) or die (mysql_error());
	$res2 = mysql_query($sql2) or die (mysql_error());
	$count = mysql_num_rows($res1)-mysql_num_rows($res2);
	$sql = "SELECT $TABLA_PAGOS.*,$TABLA_EMPRESAS.* FROM $TABLA_PAGOS RIGHT JOIN "
			. "$TABLA_EMPRESAS ON $WHERE $TABLA_PAGOS.$ID_EMPRESA=$TABLA_EMPRESAS.$ID "
			. "and $TABLA_PAGOS.$ID_USUARIO=".$id_usuario;
	if (isset($_GET['estado']))
		$sql .= " WHERE $ESTADO='".$_GET['estado']."'";
	else
		$sql .= " WHERE $ESTADO!='scam'";	
	$sql .= " ORDER BY $NOMBRE_DE_EMPRESA ASC";
	$res = mysql_query($sql) or die (mysql_error());	
} else {
	$sql = "SELECT $TABLA_PAGOS.*,$TABLA_EMPRESAS.* FROM $TABLA_EMPRESAS INNER JOIN " 
		. "$TABLA_PAGOS ON $TABLA_PAGOS.$ID_EMPRESA=$TABLA_EMPRESAS.$ID " 
		. "WHERE $TABLA_PAGOS.$ID_USUARIO=".$id_usuario;
	if (isset($_GET['estado']))
		$sql .= " and $ESTADO='" . $_GET['estado'] . "'";
	else
		$sql .= " and $ESTADO!='scam'";
	if ($_GET['estado'] != 'scam')
		$sql .= " and $PAPELERA=0"; 
		
	$res = mysql_query($sql) or die (mysql_error());
	$count = mysql_num_rows($res);
}



if (!(isset($_POST['añadir2']) | isset($_POST['añadir']))) {

	if (!isset($_GET['st'])) {
		/**
		* SUBMENU
		**/?>
		<div id="submenu"><?
			include("./modulos/personal/empresas/submenu.php");?>
		</div><?
	}
	
	if ($_GET['cat'] != 'mias'){
		/**
		*	CONTADORES DE ESPERA/ERROR
		**/
		$sql = "SELECT $ID FROM $TABLA_INSCRIPC_TEMP WHERE $ID_USUARIO=" . $id_usuario
				. " and $ESTADO_INSCRIP='espera'";
		$res2 = mysql_query($sql) or die (mysql_error());
		$count2 = mysql_num_rows($res2);
		$sql = "SELECT $ID FROM $TABLA_INSCRIPC_TEMP WHERE $ID_USUARIO=" . $id_usuario
				. " and $ESTADO_INSCRIP='error'";
		$res2 = mysql_query($sql) or die (mysql_error());
		$count3 = mysql_num_rows($res2);
	}
	
    /**
	*	TITULO 2 
	**/?>
    <div id="titulo2"><?
        include("./modulos/personal/empresas/titulo2.php");?>
    </div><?
	
	if ($_GET['cat'] != 'mias') {
		/**
		*	BOTONES DE ESPERA/ERROR
		**/?>
        <div class="texto1">
            <div class="boxtop2"><div></div></div>
            <div class="content">
            <div class="boton_espera">
                <a href="?mod=empresas&cat=otras&st=espera">
                    En espera de confirmación (<? echo $count2;?>)
                </a>
            </div>
            <div class="boton_error">
                <a href="?mod=empresas&cat=otras&st=error">
                    No apareces referido (<? echo $count3;?>)
                </a>
            </div>
            <div class="corte"></div>
            </div>
        </div><?
	}
}

/** 
*	TABLA 
**/
if ($_GET['estado'] == 'scam')
	include("./modulos/personal/empresas/tabla_scam.php");
else
	include("./modulos/personal/empresas/tabla.php");?>