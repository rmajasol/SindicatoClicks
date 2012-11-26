<link rel="STYLESHEET" type="text/css" href="/gestion/modulos/css/dar.css">

<div id="dar">

<? //////////////////////////////// TITULO ////////////////////////////////////////////?>
<div class="titulo">Dar dinero</div><?

if (isset($_POST['dado'])){
	if (isset($_POST['yes'])){
		$sql = "SELECT $COBRADO FROM $TABLA_USUARIOS WHERE $ID=".$_GET['id'];
		$res = mysql_query($sql) or die (mysql_error());
		$fila = mysql_fetch_array($res);
		$cobrado = $fila[$COBRADO];
		$cobrado += $_POST['cantidad'];
		$sql = "SELECT $PAGADO FROM $TABLA_USUARIOS WHERE $ID=".$id_usuario;
		$res = mysql_query($sql) or die (mysql_error());
		$fila = mysql_fetch_array($res);
		$pagado = $fila[$PAGADO];
		$pagado += $_POST['cantidad'];
		$sql = "UPDATE $TABLA_USUARIOS SET $COBRADO=".$cobrado." WHERE $ID=".$_GET['id'];
		$res = mysql_query($sql) or die (mysql_error());
		$sql = "UPDATE $TABLA_USUARIOS SET $PAGADO=".$pagado." WHERE $ID=".$id_usuario;
		$res = mysql_query($sql) or die (mysql_error());
		
		
		//insertamos registro en TABLA DE ACCIONES
		/*$sql = "SELECT $ID FROM $TABLA_USUARIOS WHERE $NOMBRE_DE_USUARIO='".$dueño."'";
		$res = mysql_query($sql) or die (mysql_error());
		$fila = mysql_fetch_array($res);
		$id_usuario = $fila[$ID];*/
		$campos = "$ID_USUARIO,$ID_USUARIO_T,$ACCION,$CANTIDAD,$FECHA";
		$valores = "'" . $id_usuario . "',";
		$valores .= "'" . $_GET['id'] . "',";
		$valores .= "'pasa a',";
		$valores .= "'" . $_POST['cantidad'] . "',";
		$valores .= "'" . date("Y-m-d H:i:s") . "'";
		$sql = "INSERT INTO $TABLA_ACCIONES ($campos) VALUES ($valores)";
		$res = mysql_query($sql) or die (mysql_error());?>
		
		Se le ha dado el dinero correctamente.
		<a href="/gestion/?mod=gestion_cobros">Volver</a><?
		exit;
	}else if (isset($_POST['no'])){?>
		<a href="/gestion/?mod=dar&id=<? echo "$_GET[id]";?>">Volver</a><?
	}else{
		if (($_POST['sobrante'] < $_POST['a_darle']) & ($_POST['cantidad'] > $_POST['sobrante'])){?>
			No tienes sobrante suficiente como para darle esa cantidad.
			<a href="/gestion/?mod=gestion_cobros">Volver</a><?
			exit;
		}else if ($_POST['cantidad'] > $_POST['a_darle']){?>
			Esta cantidad supera el tope que le puedes dar.
			<a href="/gestion/?mod=gestion_cobros">Volver</a><?
			exit;
		}else{
			echo "¿Confirma que le ha dado a ".$_POST['nombre']." la cantidad de $".$_POST['cantidad']."?";?>
			<form action="/gestion/?mod=dar&id=<? echo "$_GET[id]";?>" method="post">
				<input type="submit" name="yes" value="SI" />
				<input type="submit" name="no" value="NO" />
				<input type="hidden" name="cantidad" value="<? echo "$_POST[cantidad]";?>" />
				<input type="hidden" name="dado" value="<? echo "$_POST[dado]";?>" />
			</form><?
		}
	}
	
}else{

	if ($_GET['sobrante'] <= 0){?>
		<div class="mensaje">No tienes sobrante para dar.</div><?
	}else{?>
		<form action="/gestion/?mod=dar&id=<? echo "$_GET[id]";?>" method="post">
		<table border="1" align="center">
			<tr>
				<td>
					Cantidad a dar:
				</td>
				<td>
					<input type="text" name="cantidad" size="7" />
					<input type="submit" name="dado" value="Dado" />
				</td>
			</tr>
			<tr>
				<td colspan="2"><?
					$sql = "SELECT * FROM $TABLA_USUARIOS WHERE $ID=".$_GET['id'];
					$res = mysql_query($sql) or die (mysql_error());
					$fila = mysql_fetch_array($res);
					$benef_suyo = $fila[$COBRADO] - $fila[$PAGADO];
					$benef_u_suyo = $_GET['b_total'] * ($fila[$PORCENTAJE_COLAB]/100);
					$a_darle = $benef_u_suyo - $benef_suyo;
					$a_darle = redondear_dos_decimal($a_darle);
					if ($_GET['sobrante'] < $a_darle){?>
						Máximo que le puedes dar: $<? echo "$_GET[sobrante]";
					}else{?>
						Máximo que le puedes dar: $<? echo "$a_darle";
					}?>
					<input type="hidden" name="a_darle" value="<? echo "$a_darle";?>" />
					<input type="hidden" name="sobrante" value="<? echo "$_GET[sobrante]";?>" />
					<input type="hidden" name="nombre" value="<? echo "$fila[$NOMBRE_DE_USUARIO]";?>" />
				</td>
			</tr>
			<tr>
				<td>
					Preferido:
				</td>
				<td width="300px"><?
					switch ($fila[$FORMA_DE_PAGO]){
						case 'paypal':
							echo "Paypal -> ".$fila[$PAYPAL];
							break;
						case 'alertpay':
							echo "Alertpay -> ".$fila[$ALERTPAY];
							break;
						case 'egold':
							echo "E-gold -> ".$fila[$EGOLD];
							break;
					}?>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<table border="1">
						<tr>
							<td>
								Alternativo: 
							</td>
							<td><?
								switch ($fila[$FORMA_DE_PAGO]){
									case 'paypal':?>
										Alertpay -> <? echo "$fila[$ALERTPAY]<br>";?>
										E-gold -> <? echo "$fila[$EGOLD]";
										break;
									case 'alertpay':?>
										Paypal -> <? echo "$fila[$PAYPAL]<br>";?>
										E-gold -> <? echo "$fila[$EGOLD]";
										break;
									case 'egold':?>
										Paypal -> <? echo "$fila[$PAYPAL]<br>";?>
										Alertpay -> <? echo "$fila[$ALERTPAY]";
										break;
								}?>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		</form><?
	}
}?>											
</div>
