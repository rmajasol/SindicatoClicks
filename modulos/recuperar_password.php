<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<div class='boxtop2'><div></div></div>
<div class="content"><?
$correcto = 0;
if ($_POST['submit']) {
	$con = conectar();
	$sql = "SELECT $NOMBRE_DE_USUARIO,$PASSWORD_USUARIO FROM $TABLA_USUARIOS WHERE $EMAIL='" . $_POST['email'] . "'";
	$res = mysql_query($sql) or die (mysql_error());
	$existe = mysql_num_rows($res);
	if ($existe < 1) {?>
		<div class="cuadro_error">No existe ning&uacute;n usuario con ese email</div><?
	} else {
		$fila = mysql_fetch_array($res);
		$cuerpo = "Tus datos de acceso a Comunidadclickers.com: " . "\n\n";
		$cuerpo .= "Nombre de usuario: " . $fila[$NOMBRE_DE_USUARIO] . "\n";
		$cuerpo .= "Contraseña: " . $fila[$PASSWORD_USUARIO] . "\n\n";
		$cuerpo .= "Salu2!";
		mail($_POST['email'],"Comunidadclickers.com: contraseña recuperada",$cuerpo);?>
		<div class="cuadro_confirm_ok">Email introducido correctamente. Se le han enviado los datos.</div><?
		$correcto = 1;
  	}
}
 
if ($correcto == 0) {?>
    <form action="?mod=recuperar_password" method="post">
        Introduzca su email: <input type="text" name="email" size=16>
        <input type="submit" name="submit" value="Enviar">
    </form><?
}

?>
</div>
<div class='boxbottom2'><div></div></div>