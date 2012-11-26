<?
if (isset($_POST['submit'])){
			
	$correcto = 1;
	$sql = "UPDATE $TABLA_USUARIOS SET ";
	if ($admin == 1){
		if (isset($_POST['todas_empresas']))
			$sql .= "$VER_TODAS_EMPRESAS = 1, ";
		else
			$sql .= "$VER_TODAS_EMPRESAS = 0, ";
	}
	
	// CONTRASEÑA
	if ($_POST['pass'] != NULL | $_POST['cpass'] != NULL) {
		if ($_POST['pass'] == $_POST['cpass']) {
			$sql .= "$PASSWORD_USUARIO = '" . $_POST['pass'] . "', ";
		} else if (minimopass($password)) {?>
			<div class="cuadro_error">
            	No se ha podido actualizar la contraseña debido a que debe tener 6 caracteres como mínimo.
            </div><?
			$correcto = 0;
		} else {?>
			<div class="cuadro_error">
            	No se ha podido actualizar la contraseña debido a que no se han repetido correctamente en el formulario.
            </div><?
			$correcto = 0;
		}
	}
		
	// AUTOPAPELERA
	if (isset($_POST['autopap_act']))
			$sql .= "$AUTOPAPELERA_ACT = 1, ";
		else
			$sql .= "$AUTOPAPELERA_ACT = 0, ";
	if (isset($_POST['dej_click_antiscam']))
			$sql .= "$DEJ_CLICK_ANTISCAM = 1, ";
		else
			$sql .= "$DEJ_CLICK_ANTISCAM = 0, ";
	$sql .= "$DEJ_CLICK_N_ADS = '" . $_POST['dej_click_n_ads'] . "', ";
	$sql .= "$DEJ_CLICK_N_DIAS = '" . $_POST['dej_click_n_dias'] . "', ";
	// fin AUTOPAPELERA
	
	$sql .= "$EMAIL = '" . $_POST['email'] . "', ";
	$sql .= "$PAIS = '" . $_POST['pais'] . "', ";
	$sql .= "$PAYPAL = '" . $_POST['paypal'] . "', ";
	$sql .= "$ALERTPAY = '" . $_POST['alertpay'] . "', ";
	$sql .= "$FORMA_DE_PAGO = '" . $_POST['forma_de_pago'] . "', ";
	$sql .= "$REFERIDO_POR = '" . $_POST['ref'] . "', ";
	$sql .= "$INTERVALO_EMPRESAS = '" . $_POST['intervalo'] . "', ";
	if (isset($_POST['mantener_pap']))
			$sql .= "$MANTENER_PAP = 1 ";
		else
			$sql .= "$MANTENER_PAP = 0 ";
	$sql .= "WHERE $ID=" . $id_usuario;
	$res = mysql_query($sql) or die(mysql_error());
	if ($correcto == 1) {?>
		<div class="cuadro_confirm_ok">Perfil de usuario actualizado con éxito!</div><?
	}
}

$sql = "SELECT * FROM $TABLA_USUARIOS WHERE $ID=" . $id_usuario;
$res = mysql_query($sql) or die (mysql_error());
$fila = mysql_fetch_array($res);

if (mysql_num_rows($res) > 0){?>
	<div id="formulario">
	<form method="post" action="?mod=perfil">
		<table id="form"><?
			if ($admin == 1 & $nombre_usuario == 'saitonrock'){?>
				<tr>
					<td class="derecha">Ver todas las empresas en gestión: </td><?
					if ($fila[$VER_TODAS_EMPRESAS] == 1){?>
						<td><input name="todas_empresas" type="checkbox" checked></td><?
					}else{?>
						<td><input name="todas_empresas" type="checkbox"></td><?
					}?>
				</tr><?
			}?>
			<tr>
				<td class="derecha">email: </td>
				<td><input name="email" type="text" value="<? echo $fila[$EMAIL];?>"></td>
			</tr>
			<tr>
				<td class="derecha">país: </td>
				<td><input name="pais" type="text" value="<? echo $fila[$PAIS];?>"></td>
			</tr>
			<tr>
				<td class="derecha">paypal: </td>
				<td><input name="paypal" type="text" value="<? echo $fila[$PAYPAL];?>"></td>
			</tr>
			<tr>
				<td class="derecha">alertpay: </td>
				<td><input name="alertpay" type="text" value="<? echo $fila[$ALERTPAY];?>"></td>
			</tr>
			<tr>
				<td class="derecha">Forma de pago: </td>
				<td><select name="forma_de_pago"><?
					switch ($fila[$FORMA_DE_PAGO]){
						case 'paypal':?>
							<option value="paypal" selected>Paypal</option>
							<option value="alertpay">Alertpay</option><?
						break;
						case 'alertpay':?>
							<option value="paypal">Paypal</option>
							<option value="alertpay" selected>Alertpay</option><?
						break;
						case NULL:?>
							<option value="" selected="selected"></option>
							<option value="paypal">Paypal</option>
							<option value="alertpay">Alertpay</option><?
						break;
					}?></select>
				</td>
			</tr>
			<tr>
				<td class="derecha">Referido por: </td>
				<td><? 
					if ($fila[$REFERIDO_POR] == NULL){?>
						<select name="ref">
							<option value="" selected></option><?
							$sql2 = "SELECT $NOMBRE_DE_USUARIO FROM $TABLA_USUARIOS ORDER BY $NOMBRE_DE_USUARIO ASC";
							$res2 = mysql_query($sql2) or die (mysql_error());
							while($fila2 = mysql_fetch_array($res2)){
								if ($fila2[$NOMBRE_DE_USUARIO] != $nombre_usuario){?>
									<option value="<? echo "$fila2[$NOMBRE_DE_USUARIO]";?>">
									<? echo "$fila2[$NOMBRE_DE_USUARIO]";?></option><?
								}
							}?>
						</select><?
					}else{
						echo "$fila[$REFERIDO_POR]";?>
						<input type="hidden" name="ref" value="<? echo "$fila[$REFERIDO_POR]";?>" /><?
					}?>
				</td>
			</tr>
    	</table>
        
        <fieldset><legend>Cambiar contraseña</legend>
        <table id="form">
            <tr>
                <td class="derecha">Nueva contraseña:</td>
                <td class="derecha"><input name="pass" type="password" value=""></td>
            </tr>
            <tr>
                <td class="derecha">Repite nueva contraseña:</td>
                <td class="derecha"><input name="cpass" type="password" value=""></td>
            </tr>
        </table>
        </fieldset>
        
        <table id="form">
			<tr>
				<td class="derecha">Intervalo de nº empresas para clickear: </td>
				<td><input name="intervalo" type="text" value="<? echo $fila[$INTERVALO_EMPRESAS];?>" size="3"></td>
			</tr>
			<tr>
				<td class="derecha">Incluir empresas de papelera para mantener: </td><?
				if ($fila[$MANTENER_PAP] == 1){?>
					<td><input name="mantener_pap" type="checkbox" checked></td><?
				}else{?>
					<td><input name="mantener_pap" type="checkbox"></td><?
				}?>
			</tr>
			<tr>
				<td class="derecha">Activar autopapelera: </td><?
				if ($fila[$AUTOPAPELERA_ACT] == 1){?>
					<td><input name="autopap_act" type="checkbox" checked></td><?
				}else{?>
					<td><input name="autopap_act" type="checkbox"></td><?
				}?>
			</tr>
		</table>
	  	
		<fieldset>
		<legend>Autopapelera</legend>
	  	<table id="form">
			<tr>
				<td class="derecha">Dejar de clickear en antiscam esperando pago: </td><?
				if ($fila[$DEJ_CLICK_ANTISCAM] == 1){?>
					<td><input name="dej_click_antiscam" type="checkbox" checked></td><?
				}else{?>
					<td><input name="dej_click_antiscam" type="checkbox"></td><?
				}?>
			</tr>
			<tr>
				<td class="derecha">Dejar de clickear en empresas con nº ads igual o menor que: </td>
				<td><input name="dej_click_n_ads" type="text" value="<? echo $fila[$DEJ_CLICK_N_ADS];?>" size="3"></td>
			</tr>
            <tr>
				<td class="derecha">Dejar de clickear en empresas seguras que no paguen en menos de 
				<input name="dej_click_n_dias" type="text" value="<? echo $fila[$DEJ_CLICK_N_DIAS];?>" size="3"> días</td>
			</tr>
		</table>
		</fieldset>
		
		<table id="form">
			<tr>
				<td colspan="2" class="submit"><input name="submit" type="submit" value="Editar"></td>
			</tr>
		</table>
	</form>
	</div><?
} else
	echo "no se obtuvieron resultados o acceso denegado. Debes <a href='http://www.sindicatoclicks.net/'>loguearte</a> antes de entrar.";?>