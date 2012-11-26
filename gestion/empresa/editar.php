<?
if ($admin == 1){

$sql = "SELECT $ID,$DUEÑO,$ESTADO,$CAUSA_DE_SCAM,$PRUEBA_DE_SCAM,$GRAVEDAD_SCAM FROM $TABLA_EMPRESAS WHERE $NOMBRE_DE_EMPRESA='$_GET[n]'";
$res = mysql_query($sql) or die (mysql_error());
$fila = mysql_fetch_array($res);
$id_empresa = $fila[$ID];
$dueño = $fila[$DUEÑO];
$estado_empresa = $fila[$ESTADO];
$causa_de_scam = dec_utf8($fila[$CAUSA_DE_SCAM]);
$prueba_de_scam = $fila[$PRUEBA_DE_SCAM];
$gravedad_scam = $fila[$GRAVEDAD_SCAM];

if (isset($_POST['ha_pagado']) | $_GET['action2'] == 'ha_pagado'){
	
	/**
	*	BLOQUE QUE SE PROCESA UNA VEZ CONFIRMADO (PULSANDO '[SI]') EL PAGO RECIBIDO
	**/
	if (isset($_POST['yes'])){
		$sql = "SELECT $FECHA_PAGO_PEDIDO,$CANTIDAD_PEDIDO,$ESTADO FROM $TABLA_EMPRESAS WHERE $ID=".$id_empresa;
		$res = mysql_query($sql) or die (mysql_error());
		$fila = mysql_fetch_array($res);
		$fecha_pedido = $fila[$FECHA_PAGO_PEDIDO];
		$cantidad_pedido = $fila[$CANTIDAD_PEDIDO];
		$estado_ptc = $fila[$ESTADO];
		
		$sql = "SELECT $ID FROM $TABLA_TIEMPOS_PAGOS WHERE $ID_EMPRESA=".$id_empresa;
		$res = mysql_query($sql) or die (mysql_error());
		$count = mysql_num_rows($res);
		$count++;
		
		/**
		*	insertar nuevo registro en tabla de cobros (tiempos_pagos)
		**/
		$campos = "$ID_EMPRESA,$NUMERO_P,$FECHA_DE_PEDIDO,$FECHA_DE_COBRO,$CANTIDAD";
		$valores = "'" . $id_empresa . "',";
		$valores .= "'" . $count . "',";
		$valores .= "'" . $fecha_pedido . "',";
		$valores .= "'" . date("Y-m-d") . "',";
		$valores .= "'" . $cantidad_pedido . "'";
		$sql = "INSERT INTO $TABLA_TIEMPOS_PAGOS ($campos) VALUES ($valores)";
		$res = mysql_query($sql) or die (mysql_error());
		
		/**
		*	ACTUALIZAMOS 'POR PAGAR'
		**/
		$sql = "SELECT $ID_USUARIO FROM $TABLA_PAGOS WHERE $ID_EMPRESA =".$id_empresa;
		$res = mysql_query($sql) or die (mysql_error());
		$cantidad_cobrada = 0;
		while($fila = mysql_fetch_array($res)){
			$sql3 = "SELECT $TABLA_PAGOS.*,$TABLA_EMPRESAS.* FROM $TABLA_EMPRESAS INNER JOIN $TABLA_PAGOS ON "
					. "$TABLA_PAGOS.$ID_EMPRESA=$TABLA_EMPRESAS.$ID WHERE $TABLA_PAGOS.$ID_USUARIO=" . $fila[$ID_USUARIO]
					. " and $TABLA_PAGOS.$ID_EMPRESA=" . $id_empresa;
			$res3 = mysql_query($sql3) or die (mysql_error());
			$fila3 = mysql_fetch_array($res3);
			$divisa = dec_utf8($fila3[$DIVISA]);
			if ($fila3[$TIPO_GESTION] == 'c'){
				$neto = ($fila3[$GANADO_PROPIO]-$fila3[$GANADO_REFS])-$fila3[$GANANCIA_NETA_ANTERIOR];
				$cantidad = $neto*($fila3[$PORCENTAJE_REFS]/100)*$TARIFA1;
				$cantidad2 = $neto*($fila3[$PORCENTAJE_REFS]/100)*$TARIFA2;
				$cantidad3 = ($neto-$fila3[$GANANCIA_NETA_TEMP])*($fila3[$PORCENTAJE_REFS]/100);
				$sql2 = "UPDATE $TABLA_PAGOS SET $GANANCIA_NETA_TEMP=" . $neto . " WHERE $ID_USUARIO=" 
						. $fila[$ID_USUARIO] . " AND $ID_EMPRESA=" . $id_empresa;
				$res2 = mysql_query($sql2) or die (mysql_error());
				if ($divisa == '€'){
					$cantidad = conv_euro_a_dolar($cantidad);
					$cantidad2 = conv_euro_a_dolar($cantidad2);
					$cantidad3 = conv_euro_a_dolar($cantidad3);
				}
			}else{
				$neto = $fila3[$CLICKS]-$fila3[$CLICKS_PAGADOS];
				$cantidad = $neto*$fila3[$C_AD_REF]*$TARIFA1;
				$cantidad2 = $neto*$fila3[$C_AD_REF]*$TARIFA2;
				$cantidad3 = ($neto-$fila3[$CLICKS_NETOS_TEMP])*$fila3[$C_AD_REF]; //lo que cobramos gracias a sus clicks
				$sql2 = "UPDATE $TABLA_PAGOS SET $CLICKS_NETOS_TEMP=" . $neto . " WHERE $ID_USUARIO=" 
						. $fila[$ID_USUARIO] . " AND $ID_EMPRESA=" . $id_empresa;
				$res2 = mysql_query($sql2) or die (mysql_error());
				if ($divisa == '€'){
					$cantidad = conv_euro_a_dolar($cantidad);
					$cantidad2 = conv_euro_a_dolar($cantidad2);
					$cantidad3 = conv_euro_a_dolar($cantidad3);
				}
				$cantidad /=100;
				$cantidad2 /=100;
				$cantidad3 /=100;
			}
			$cantidad = redondear_dos_decimal($cantidad);
			$cantidad2 = redondear_dos_decimal($cantidad2);
			$cantidad3 = redondear_dos_decimal($cantidad3);
			$sql4 = "SELECT $NOMBRE_DE_USUARIO FROM $TABLA_USUARIOS WHERE $ID=".$fila[$ID_USUARIO];
			$res4 = mysql_query($sql4) or die (mysql_error());
			$fila4 = mysql_fetch_array($res4);
			if ($dueño != $fila4[$NOMBRE_DE_USUARIO])
				$cantidad_cobrada += $cantidad3;
			
			$sql2 = "UPDATE $TABLA_PAGOS SET $POR_PAGAR=" . $cantidad . ",$POR_COMISIONAR=" 
					. $cantidad2 . " WHERE $ID_USUARIO=" . $fila[$ID_USUARIO] 
					. " AND $ID_EMPRESA=" . $id_empresa;
			$res2 = mysql_query($sql2) or die (mysql_error());
		}
		
		/**
		*	CREAMOS DETALLES DE ESTA PTC PARA EL HISTORIAL DE PAGO DE CADA USER
		**/
		$sql = "SELECT $ID_USUARIO FROM $TABLA_PAGOS WHERE $ID_EMPRESA =".$id_empresa;
		$res = mysql_query($sql) or die (mysql_error());
		while($fila = mysql_fetch_array($res)){
			$sql2 = "SELECT $TABLA_EMPRESAS.*,$TABLA_PAGOS.* FROM $TABLA_EMPRESAS INNER JOIN $TABLA_PAGOS ON " 
					. "$TABLA_PAGOS.$ID_EMPRESA=$TABLA_EMPRESAS.$ID WHERE $TABLA_PAGOS.$ID_USUARIO=" 
					. $fila[$ID_USUARIO] . " AND $TABLA_EMPRESAS.$ID=" . $id_empresa;
			$res2 = mysql_query($sql2) or die (mysql_error());
			$fila2 = mysql_fetch_array($res2);
			$ya_existe = 0;
			$sql3 = "SELECT $ID FROM $TABLA_DETALLES_P WHERE $ID_USUARIO_D=" . $fila[$ID_USUARIO] 
					. " AND $ID_EMPRESA_D=" . $id_empresa . " AND $ID_HISTORIAL='0'";
			$res3 = mysql_query($sql3) or die (mysql_error());
			$fila3 = mysql_fetch_array($res3);
			if (mysql_num_rows($res3)>0)
				$ya_existe = 1;
			if ($fila2[$POR_PAGAR] > 0){
				if ($ya_existe==0){
					$campos = "$ID_HISTORIAL,$ID_USUARIO_D,$ID_EMPRESA_D,$EMPRESA_D,$GANADO_PROPIO_D,$GANADO_REFS_D,";
					$campos .= "$GANADO_NETO_ANTERIOR_D,$PORCENTAJE_REFS_D,$TARIFA_SINDIC_D,";
					$campos .= "$CLICKS_D,$CLICKS_PAGADOS_D,$PRECIO_CLICK_REF_D,$TIPO_GESTION_D,";
					$campos .= "$DIVISA_D,$PREMIUM_D,$E_DOLAR_D";
					$valores = "'0','".$fila[$ID_USUARIO]."','".$id_empresa."','".$fila2[$NOMBRE_DE_EMPRESA]."',";
					$valores .= "'".$fila2[$GANADO_PROPIO]."','".$fila2[$GANADO_REFS]."',";
					$valores .= "'".$fila2[$GANANCIA_NETA_ANTERIOR]."','".$fila2[$PORCENTAJE_REFS]."',";
					$valores .= "'".$TARIFA1."','".$fila2[$CLICKS]."',";
					$valores .= "'".$fila2[$CLICKS_PAGADOS]."','".$fila2[$C_AD_REF]."',";
					$valores .= "'".$fila2[$TIPO_GESTION]."','".$fila2[$DIVISA]."',";
					$valores .= "'".$fila2[$PREMIUM]."','".$TASA_E_D."'";
					$sql4 = "INSERT INTO $TABLA_DETALLES_P ($campos) VALUES($valores)";
					$res4 = mysql_query($sql4) or die (mysql_error());
				}else{
					//updatamos
					$sql4 = "UPDATE $TABLA_DETALLES_P SET ";
					$sql4 .= "$EMPRESA_D = '".$fila2[$NOMBRE_DE_EMPRESA]."',";
					$sql4 .= "$GANADO_PROPIO_D = '".$fila2[$GANADO_PROPIO]."',";
					$sql4 .= "$GANADO_REFS_D = '".$fila2[$GANADO_REFS]."',";
					$sql4 .= "$GANADO_NETO_ANTERIOR_D = '".$fila2[$GANANCIA_NETA_ANTERIOR]."',";
					$sql4 .= "$PORCENTAJE_REFS_D = '".$fila2[$PORCENTAJE_REFS]."',";
					$sql4 .= "$TARIFA_SINDIC_D = '".$TARIFA1."',";
					$sql4 .= "$CLICKS_D = '".$fila2[$CLICKS]."',";
					$sql4 .= "$CLICKS_PAGADOS_D = '".$fila2[$CLICKS_PAGADOS]."',";
					$sql4 .= "$PRECIO_CLICK_REF_D = '".$fila2[$C_AD_REF]."',";
					$sql4 .= "$TIPO_GESTION_D = '".$fila2[$TIPO_GESTION]."',";
					$sql4 .= "$DIVISA_D = '".$fila2[$DIVISA]."',";
					$sql4 .= "$PREMIUM_D = '".$fila2[$PREMIUM]."', ";
					$sql4 .= "$E_DOLAR_D = '".$TASA_E_D."' ";
					$sql4 .= "WHERE $ID_USUARIO_D=".$fila[$ID_USUARIO]." AND $ID_EMPRESA_D=".$id_empresa;
					$res4 = mysql_query($sql4) or die (mysql_error());
				}
			}
		}
		
		/**
		*	actualizamos lo que lleva cobrado el dueño
		**/
		$sql = "SELECT $COBRADO FROM $TABLA_USUARIOS WHERE $NOMBRE_DE_USUARIO='".$dueño."'";
		$res = mysql_query($sql) or die (mysql_error());
		$fila = mysql_fetch_array($res);
		$cobrado = $fila[$COBRADO];
		$cobrado += $cantidad_cobrada;
		$sql = "UPDATE $TABLA_USUARIOS SET $COBRADO=".$cobrado." WHERE $NOMBRE_DE_USUARIO='".$dueño."'";
		$res = mysql_query($sql) or die (mysql_error());
		
		/**
		*	insertamos nuevo registro en TABLA DE ACCIONES
		**/
		$sql = "SELECT $ID FROM $TABLA_USUARIOS WHERE $NOMBRE_DE_USUARIO='".$dueño."'";
		$res = mysql_query($sql) or die (mysql_error());
		$fila = mysql_fetch_array($res);
		$id_usuario = $fila[$ID];
		$campos = "$ID_USUARIO,$ID_EMPRESA_F,$ACCION,$CANTIDAD,$FECHA";
		$valores = "'" . $id_usuario . "',";
		$valores .= "'" . $id_empresa . "',";
		$valores .= "'cobra',";
		$valores .= "'" . $cantidad_cobrada . "',";
		$valores .= "'" . date("Y-m-d H:i:s") . "'";
		$sql = "INSERT INTO $TABLA_ACCIONES ($campos) VALUES ($valores)";
		$res = mysql_query($sql) or die (mysql_error());
		
		/**
		*	reseteamos ciertos datos de la empresa y la cambiamos a 'segura'
		**/
		$sql = "UPDATE $TABLA_EMPRESAS SET $PAGO_PEDIDO = '0', $FECHA_PAGO_PEDIDO = '0000-00-00', $CANTIDAD_PEDIDO = '0', $PROGRESO = '0', $ESTADO = 'segura' WHERE $ID=".$id_empresa;
		$res = mysql_query($sql) or die (mysql_error());?>
		
		<div class="cuadro_confirm_ok">Acción ejecutada correctamente!</div><?
		
	}else if (isset($_POST['no'])){
	}else{?>
    	<div class="cuadro_confirm">
			¿Confirma que ha pagado <b><? echo "$_GET[n]";?></b>?
			<form action="?mod=ver_empresa&n=<? echo "$_GET[n]";?>&action=editar&action2=ha_pagado" method="post">
				<input type="submit" name="yes" value="SI" />&nbsp;
				<input type="submit" name="no" value="NO" />
          	</form>
		</div><?
	}
	
	
}else{

	/**
	*	SI NO HA PAGADO EDITAMOS SIMPLEMENTE--
	**/
	if (isset($_POST['scam'])){
		$causa = enc_utf8($_POST['causa_scam']);
		$sql = "UPDATE $TABLA_EMPRESAS SET ";
		$sql .= "$ESTADO='".$_POST['estado']."',";
		$sql .= "$CAUSA_DE_SCAM='".$causa."',";
		$sql .= "$PRUEBA_DE_SCAM='".$_POST['prueba_scam']."',";
		$sql .= "$GRAVEDAD_SCAM='".$_POST['gravedad']."'";
		$sql .= " WHERE $ID=" . $id_empresa;
		$res = mysql_query($sql) or die(mysql_error());
		$sql = "SELECT $ID,$DUEÑO,$ESTADO,$CAUSA_DE_SCAM,$PRUEBA_DE_SCAM,$GRAVEDAD_SCAM FROM " 
				. "$TABLA_EMPRESAS WHERE $NOMBRE_DE_EMPRESA='$_GET[n]'";
		$res = mysql_query($sql) or die (mysql_error());
		$fila = mysql_fetch_array($res);
		$id_empresa = $fila[$ID];
		$dueño = $fila[$DUEÑO];
		$estado_empresa = $fila[$ESTADO];
		$causa_de_scam = dec_utf8($fila[$CAUSA_DE_SCAM]);
		$prueba_de_scam = $fila[$PRUEBA_DE_SCAM];
		$gravedad_scam = $fila[$GRAVEDAD_SCAM];?>
		<div class="cuadro_confirm_ok">Empresa editada con éxito!</div><?
		
	}else if (isset($_POST['submit'])){
	
		$sql = "UPDATE $TABLA_EMPRESAS SET ";
		$sql .= "$ADS_DIA = '" . $_POST['adsXdia'] . "', ";
		if ($_POST['gestion'] == 'b'){
			$cobrado = 0;
			$mensaje = "SELECT $CANTIDAD FROM $TABLA_TIEMPOS_PAGOS WHERE $ID_EMPRESA=".$id_empresa;
			$peticion = mysql_query($mensaje) or die (mysql_error());
			$count = mysql_num_rows($peticion);
			if ($count = 0)
				$cobrado = 0;
			else
				while($fila = mysql_fetch_array($peticion))
					$cobrado += $fila[$CANTIDAD];
			$c_ad_global = (($_POST['progreso'] + $cobrado)*100)/($_POST['own_clicks']+$_POST['ref_clicks']);
			$ganado_refs = $c_ad_global*($_POST['ref_clicks']*($_POST['ref']/100))/100;
			$ganado_propio = ($_POST['progreso'] + $cobrado)-$ganado_refs;
			$c_ad_own = ($ganado_propio*100)/$_POST['own_clicks'];
			$c_ad_ref = ($ganado_refs*100)/$_POST['ref_clicks'];
			$c_ad_global =  redondear_dos_decimal($c_ad_global);
			$ganado_refs =  redondear_dos_decimal($ganado_refs);
			$ganado_propio =  redondear_dos_decimal($ganado_propio);
			$c_ad_own =  redondear_dos_decimal($c_ad_own);
			$c_ad_ref =  redondear_dos_decimal($c_ad_ref);
			if (isset($_POST['own_clicks']) & isset($_POST['ref_clicks'])){
				$sql .= "$CLICKS_PROPIO = " . $_POST['own_clicks'] . ", ";
				$sql .= "$CLICKS_REF = " . $_POST['ref_clicks'] . ", ";
			}
			$sql .= "$C_AD_GLOBAL = " . $c_ad_global . ", ";
			$sql .= "$C_AD_PROPIO = " . $c_ad_own . ", ";
			$sql .= "$C_AD_REF = " . $c_ad_ref . ", ";
			$sql .= "$GANADO_PROPIO_E = " . $ganado_propio . ", ";
			$sql .= "$GANADO_REFS_E = " . $ganado_refs . ", ";
		}else{
			$sql .= "$C_AD_PROPIO = '" . $_POST['centsXad'] . "', ";
			$cent_ad_ref = $_POST['centsXad'] * ($_POST['ref']/100);
			$sql .= "$C_AD_REF = '" . $cent_ad_ref . "', ";
		}
		
		$sql .= "$DIVISA = '" . $_POST['divisa'] . "', ";
		$sql .= "$DUEÑO = '" . $_POST['dueño'] . "', ";
		$sql .= "$ESTADO = '" . $_POST['estado'] . "', ";
		$sql .= "$FECHA_LANZAMIENTO = '" . $_POST['f_año_lanzamiento'] . "-" 
				. $_POST['f_mes_lanzamiento'] . "-" . $_POST['f_dia_lanzamiento'] . "', ";
		$sql .= "$PROGRESO = '" . $_POST['progreso'] . "', ";
		$sql .= "$LINK_PAGO_PEDIDO = '" . $_POST['linkPagosPed'] . "', ";
		$sql .= "$LINK_COMPROBANTES_PAGO = '" . $_POST['linkPagos'] . "', ";
		$sql .= "$LINK_BASE = '" . $_POST['linkBase'] . "', ";
		$sql .= "$LINK_REGISTRO = '" . $_POST['linkReg'] . "', ";
		$sql .= "$LINK_SURF = '" . $_POST['linkSurf'] . "', ";
		$sql .= "$LINK_STATS = '" . $_POST['linkStats'] . "', ";
		$sql .= "$METODO_DE_PAGO = '" . $_POST['pago'] . "', ";
		$sql .= "$MINIMO = '" . $_POST['minimo'] . "', ";
		$sql .= "$NIVELES_REF = '" . $_POST['niveles'] . "', ";
		$sql .= "$NOMBRE_DE_EMPRESA = '" . $_POST['nombre'] . "', ";
		$sql .= "$NUM_REFS_EXTERNOS = '" . $_POST['refs_externos'] . "', ";
		$sql .= "$PORCENTAJE_REFS = '" . $_POST['ref'] . "', ";
		if (isset($_POST['premium']))
			$sql .= "$PREMIUM = '1', ";
		else
			$sql .= "$PREMIUM = '0', ";
		$sql .= "$TIPO_GESTION = '" . $_POST['gestion'] . "', ";
		if (isset($_POST['con_cheatlink']))
			$sql .= "$CON_CHEATLINK = '1', ";
		else
			$sql .= "$CON_CHEATLINK = '0', ";
		$sql .= "$CHEATLINK_SCR = '" . $_POST['cheatlink_scr'] . "' ";
		$sql .= "WHERE $ID=" . $id_empresa;
		$res = mysql_query($sql) or die(mysql_error());
		
		/**
		*	para que aparezca ya el editar en SCAM justo al darle a submit
		**/
		$sql = "SELECT $ID,$DUEÑO,$ESTADO,$CAUSA_DE_SCAM,$PRUEBA_DE_SCAM,$GRAVEDAD_SCAM FROM $TABLA_EMPRESAS WHERE $NOMBRE_DE_EMPRESA='$_GET[n]'";
		$res = mysql_query($sql) or die (mysql_error());
		$fila = mysql_fetch_array($res);
		$id_empresa = $fila[$ID];
		$dueño = $fila[$DUEÑO];
		$estado_empresa = $fila[$ESTADO];
		$causa_de_scam = $fila[$CAUSA_DE_SCAM];
		$prueba_de_scam = $fila[$PRUEBA_DE_SCAM];
		$gravedad_scam = $fila[$GRAVEDAD_SCAM];?>
		<div class="cuadro_confirm_ok">Empresa editada con éxito!</div><?
		
		
	}else if (isset($_POST['pago_pedido'])){
		$sql = "UPDATE $TABLA_EMPRESAS SET ";
		$sql2 = "SELECT $FECHA_PAGO_PEDIDO,$CANTIDAD_PEDIDO,$PROGRESO FROM $TABLA_EMPRESAS WHERE $ID=".$id_empresa;
		$res2 = mysql_query($sql2) or die (mysql_error());
		$fila2 = mysql_fetch_array($res2);
		if ($fila2[$FECHA_PAGO_PEDIDO] == '0000-00-00')
			$sql .= "$FECHA_PAGO_PEDIDO = '" . date("Y-m-d") . "', ";
		if ($fila2[$CANTIDAD_PEDIDO] == '0')
			$sql .= "$CANTIDAD_PEDIDO = '" . $_POST['progreso'] . "', ";
		$sql .= "$PROGRESO = '" . $fila2[$PROGRESO] . "', ";
		$sql .= "$PAGO_PEDIDO = '1' ";
		$sql .= "WHERE $ID=" . $id_empresa;
		$res3 = mysql_query($sql) or die (mysql_error());
	
	}else if (isset($_POST['pedido_cancelado'])){
		$sql = "UPDATE $TABLA_EMPRESAS SET ";
		$sql2 = "SELECT $FECHA_PAGO_PEDIDO,$CANTIDAD_PEDIDO,$PROGRESO FROM $TABLA_EMPRESAS WHERE $ID=".$id_empresa;
		$res2 = mysql_query($sql2) or die (mysql_error());
		$fila2 = mysql_fetch_array($res2);
		if ($fila2[$FECHA_PAGO_PEDIDO] != '0000-00-00')
			$sql .= "$FECHA_PAGO_PEDIDO = '0000-00-00', ";
		if ($fila2[$CANTIDAD_PEDIDO] != '0')
			$sql .= "$CANTIDAD_PEDIDO = '0', ";
		$sql .= "$PROGRESO = '" . $fila2[$PROGRESO] . "', ";
		$sql .= "$PAGO_PEDIDO = '0' ";
		$sql .= "WHERE $ID=" . $id_empresa;
		$res3 = mysql_query($sql) or die (mysql_error());
	}
}


/**
*
*	IMPRIMIMOS LOS FORMULARIOS
*
**/
	
if ($estado_empresa == 'scam'){
	include ('./empresa/editar/formulario_scam.php');
}else{
	include ('./empresa/editar/formulario.php');
}

}else{?>acceso denegado.<? }?>