<?php
// Primero incluimos el archivo de configuración
include('../config.php');
include('../funciones.php');
include('./config_modulos.php');

if (isset($_COOKIE["id_usuario_dw"]) && isset($_COOKIE["marca_aleatoria_usuario_dw"])){
	if ($_COOKIE["id_usuario_dw"]!="" || $_COOKIE["marca_aleatoria_usuario_dw"]!=""){
		$con = conectar();
     	$sql = "SELECT $ID,$NOMBRE_DE_USUARIO,$IS_COLABORADOR,$VER_TODAS_EMPRESAS "
				. "FROM $TABLA_USUARIOS WHERE $ID='" . $_COOKIE["id_usuario_dw"]
	  			. "' AND $COOKIE_SESION='" . $_COOKIE["marca_aleatoria_usuario_dw"] . "'";
      	$res = mysql_query($sql) or die (mysql_error());
		if (mysql_num_rows($res)==1){
	  		$fila = mysql_fetch_array($res);
			$id_usuario = $fila[$ID];
			$username = $fila[$NOMBRE_DE_USUARIO];
        	$admin = $fila[$IS_COLABORADOR];
			$ver_todas = $fila[$VER_TODAS_EMPRESAS];
			$ver_scam = $fila[$VER_SCAM];
 		}
		mysql_close($con);
   }
}

if($admin == 1){
	$con = conectar();

/** Verificamos que se haya escogido un modulo, sino
* tomamos el valor por defecto de la configuración.
* También debemos verificar que el valor que nos
* pasaron, corresponde a un modulo que existe.*/
if (!empty($_GET['mod']))
	$modulo = $_GET['mod'];
else
	$modulo = MODULO_DEFECTO;
       
/** También debemos verificar que el valor que nos
* pasaron, corresponde a un modulo que existe, caso
* contrario, cargamos el modulo por defecto*/
if (empty($conf[$modulo]))
	$modulo = MODULO_DEFECTO;

/** Ahora determinamos qué archivo de Layout tendrá
* este módulo, si no tiene ninguno asignado, utilizamos
* el que viene por defecto*/
if (empty($conf[$modulo]['layout']))
	$conf[$modulo]['layout'] = LAYOUT_DEFECTO;


/** Aqui podemos colocar todos los comandos necesarios para
* realizar las tareas que se deben repetir en cada recarga
* del index.php - En el ejemplo, conexión a la base de datos.*/


/** Finalmente, cargamos el archivo de Layout que a su vez, se
encargará de incluir al módulo propiamente dicho. si el archivo
no existiera, cargamos directamente el módulo. También es un
buen lugar para incluir Headers y Footers comunes.*/
$path_layout = LAYOUT_PATH.'/'.$conf[$modulo]['layout'];
$path_modulo = MODULO_PATH.'/'.$conf[$modulo]['archivo']; 
if (file_exists($path_layout)){
	include( $path_layout );
}else{
	if (file_exists( $path_modulo )){
		include( $path_modulo );
	}else{
  		die('Error al cargar el módulo <b>'.$modulo.'</b>. No existe el archivo <b>'.$conf[$modulo]['archivo'].'</b>');
	}
}
desconectar($con);
}else{?>Acceso denegado. <a href="../index.php">Volver</a><? }?>