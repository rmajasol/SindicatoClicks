<? 
if ($admin == 1){
if (isset($_POST['añadir_empresas'])){
			$sql = "SELECT $ID FROM $TABLA_USUARIOS WHERE $NOMBRE_DE_USUARIO='$_GET[n]'";
			$res = mysql_query($sql) or die (mysql_error());
			$fila = mysql_fetch_array($res);
			$id_usuario = $fila[$ID];
			$salida = "";
			$salir = 0;
			$e = "empresa0";
			for ($i=0;$i<$_POST['num_empresas'] & $salir == 0 & $e != 'null';){
				$e = "empresa".$i;
				$emp = $_POST[$e];
				if ($emp == 'null')
					$salir = 1;
				else{
					$sql = "SELECT $ID,$NOMBRE_DE_EMPRESA FROM $TABLA_EMPRESAS WHERE $NOMBRE_DE_EMPRESA='$emp'";		
					$res = mysql_query($sql) or die (mysql_error());
					$fila = mysql_fetch_array($res);
					$campos = "$ID_USUARIO,$ID_EMPRESA,$NICK,$FECHA_INSCRIPCION";
					$valores = "'" . $id_usuario . "',";
					$valores .= "'" . $fila[$ID] . "',";
					$nick = "nick"."$i";
					if ($_POST[$nick] == NULL)
						$valores .= "'" . $_GET['n'] . "',";
					else
						$valores .= "'" . $_POST[$nick] . "',";
					$valores .= "'" . date("Y-m-d") . "'";
					$sql = "INSERT INTO $TABLA_PAGOS ($campos) VALUES ($valores)";
					$res = mysql_query($sql) or die (mysql_error());
					$salida .= "Empresa: <b>".$fila[$NOMBRE_DE_EMPRESA]."</b> añadida correctamente.<br>";
					$j = $i+1;
					$emp = "empresa".$j;
					if ($_POST[$emp] == 'null')
						$salir = 1;
					$i++;
				}
			}
			if ($i == 0){?>
				No se le ha añadido ninguna empresa. <a href="/gestion/?mod=ver_usuario&n=<? echo "$_GET[n]";?>">Volver</a><?
			}else if ($i>1){
				echo "$salida";?>
				<br /><? echo "$i";?> empresa/s añadida/s correctamente. <a href="/gestion/?mod=ver_usuario&n=<? echo "$_GET[n]";?>">Volver</a><?
			}else
				echo "$salida";
			exit;
}
}else{?>acceso denegado.<? }?>
