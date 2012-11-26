<?php
session_start();

include('./config.php');
include('./funciones2.php');

if($_GET['action'] == 'logout'){
	eliminar_cookies($_COOKIE);
	header ("Location: index.php");
}

$con = conectar();

//validación de login
$registrado = 0;
if (isset($_COOKIE["id_usuario_dw"]) && isset($_COOKIE["marca_aleatoria_usuario_dw"])){
	if ($_COOKIE["id_usuario_dw"]!="" || $_COOKIE["marca_aleatoria_usuario_dw"]!=""){
     	$sql = "SELECT $NOMBRE_DE_USUARIO,$IS_COLABORADOR,$ID FROM $TABLA_USUARIOS WHERE $ID='" . $_COOKIE["id_usuario_dw"]
	  		. "' AND $COOKIE_SESION='" . $_COOKIE["marca_aleatoria_usuario_dw"] . "'";
      	$res = mysql_query($sql) or die (mysql_error());
		if (mysql_num_rows($res)==1){
	  		$fila = mysql_fetch_array($res);
        	$registrado = 1;
        	$admin = $fila[$IS_COLABORADOR];
			$nombre_usuario = $fila[$NOMBRE_DE_USUARIO];
			$id_usuario = $fila[$ID];
 		}
   }
}

if ($_POST['login']){
	if (strtolower($_POST['code'])!= strtolower($_SESSION['texto'])) {
		header("Location: index.php?errorlogin=code");
	} else {
		$sql = "SELECT $ID,$IP FROM $TABLA_USUARIOS WHERE $NOMBRE_DE_USUARIO='" . $_POST["username"]
			 . "' AND $PASSWORD_USUARIO='" . $_POST["password"] . "'";
		$res = mysql_query($sql) or die (mysql_error());
		if (mysql_num_rows($res)==1){
			$usuario_encontrado = mysql_fetch_array($res);
			mt_srand (time());
			$numero_aleatorio = mt_rand(1000000,999999999);
			$sql = "UPDATE $TABLA_USUARIOS SET $COOKIE_SESION='$numero_aleatorio' WHERE $ID=" . $usuario_encontrado[$ID];
			$res = mysql_query($sql) or die(mysql_error());
			if ($usuario_encontrado[$IP] == NULL) {
				$ip = getIPreal();
				$sql = "UPDATE $TABLA_USUARIOS SET $IP='$ip' WHERE $ID=" . $usuario_encontrado[$ID];
				$res = mysql_query($sql) or die(mysql_error());
			}	
			if ($_POST["autologin"]=="1") {
				setcookie("id_usuario_dw", $usuario_encontrado[$ID], time()+(60*60*24*365));
				setcookie("marca_aleatoria_usuario_dw", $numero_aleatorio, time()+(60*60*24*365));
			}else{
				setcookie("id_usuario_dw", $usuario_encontrado[$ID]);
				setcookie("marca_aleatoria_usuario_dw", $numero_aleatorio);
			}
			header ("Location: index.php");
	   }else{
			header("Location: index.php?errorlogin=datos");
	   }
	}
}

include('./config_modulos.php');
include('./funciones.php');


/*$fila = db_consulta("SELECT $NOMBRE_DE_USUARIO FROM $TABLA_USUARIOS WHERE $FORMA_DE_PAGO='paypal'");
echo $fila[$NOMBRE_DE_USUARIO];
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

desconectar($con);?>






