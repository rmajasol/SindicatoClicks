<?
if ($admin == 1){
if (isset($_POST['pagar'])){
	if (isset($_POST['yes'])){
	
		/**
		*	AHORA INSERTAMOS UN NUEVO REGISTRO EN SU HISTORIAL DE PAGOS
		**/
		$campos = "$ID_USUARIO,$NUMERO,$FECHA,$METODO,$CANTIDAD";
		$valores = "'" . $_GET['id'] . "',";
		$sql = "SELECT $ID FROM $TABLA_HISTORIAL_PAGOS WHERE $ID_USUARIO=".$_GET['id'];
		$res = mysql_query($sql) or die (mysql_error());
		$count = mysql_num_rows($res);
		$count++;
		$valores .= "'" . $count . "',";
		$valores .= "'" . date("Y-m-d") . "',";
		$sql = "SELECT $POR_PAGAR FROM $TABLA_PAGOS WHERE $ID_USUARIO=".$_GET['id'];
		$res = mysql_query($sql) or die (mysql_error());
		$cantidad = 0;
		while($fila = mysql_fetch_array($res))
			$cantidad += $fila[$POR_PAGAR];
		$sql = "SELECT $CANTIDAD_EX FROM $TABLA_EXTRAS WHERE $ID_USUARIO_EX=".$_GET['id']." AND $PAGADO_EX=0";
		$res = mysql_query($sql) or die (mysql_error());
		while($fila = mysql_fetch_array($res))
			$cantidad += $fila[$CANTIDAD_EX];
		$valores .= "'" . $_POST['met_pago'] . "',";
		$valores .= "'" . $cantidad . "'";
		$sql = "INSERT INTO $TABLA_HISTORIAL_PAGOS ($campos) VALUES($valores)";
		$res = mysql_query($sql) or die (mysql_error());
		
		/**
		*	AVERIGUAMOS LA ID DE ESTE ÚLTIMO REGISTRO DEL HISTORIAL DE PAGOs
		**/
		$sql = "SELECT $ID FROM $TABLA_HISTORIAL_PAGOS WHERE $ID_USUARIO=".$_GET['id']." and $NUMERO=".$count;
		$res = mysql_query($sql) or die (mysql_error());
		$fila = mysql_fetch_array($res);
		$id_hist = $fila[$ID];
		
		/**
		*	AHORA LINKAMOS LAS 'ID' DE LOS DETALLES DEL PAGO DEL USER CON ESTE NUEVO PAGO
		**/
		$sql = "UPDATE $TABLA_DETALLES_P SET $ID_HISTORIAL=".$id_hist." WHERE $ID_USUARIO_D=".$_GET['id']." AND $ID_HISTORIAL='0'";
		$res = mysql_query($sql) or die (mysql_error());
		
		/**
		*	LINKAMOS TAMBIEN LOS EXTRAS AL HISTORIAL
		**/ 
		$sql = "SELECT $ID_EX FROM $TABLA_EXTRAS WHERE $ID_USUARIO_EX=".$_GET['id']." AND $PAGADO_EX=0";
		$res = mysql_query($sql) or die (mysql_error());
		$campos = "$ID_HISTORIAL,$ID_EXTRA";
		while($fila = mysql_fetch_array($res)){
			$valores = "'".$id_hist."','".$fila[$ID_EX]."'";
			$sql2 = "INSERT INTO $TABLA_DETALLES_P_EXTRA ($campos) VALUES($valores)";
			$res2 = mysql_query($sql2) or die (mysql_error());
		}
		
		/**
		*	ACTUALIZAR "PAGADO" EN COLABORADOR
		**/
		$sql = "SELECT $PAGADO FROM $TABLA_USUARIOS WHERE $ID=".$id_usuario;
		$res = mysql_query($sql) or die (mysql_error());
		$fila = mysql_fetch_array($res);
		$total_pagado = $fila[$PAGADO];
		$total_pagado += $_POST['pagado'];
		$sql = "UPDATE $TABLA_USUARIOS SET $PAGADO=".$total_pagado." WHERE $ID=".$id_usuario;
		$res = mysql_query($sql) or die (mysql_error());	
		
		/**
		*	insertamos nuevo registro en TABLA DE ACCIONES
		**/
		$sql = "SELECT $ID FROM $TABLA_USUARIOS WHERE $ID=".$_GET['id'];
		$res = mysql_query($sql) or die (mysql_error());
		$fila = mysql_fetch_array($res);
		$id_usuario_to = $fila[$ID];
		$campos = "$ID_USUARIO,$ID_USUARIO_T,$ACCION,$CANTIDAD,$FECHA";
		$valores = "'" . $id_usuario . "',";
		$valores .= "'" . $id_usuario_to . "',";
		$valores .= "'paga',";
		$valores .= "'" . $_POST['pagado'] . "',";
		$valores .= "'" . date("Y-m-d H:i:s") . "'";
		$sql = "INSERT INTO $TABLA_ACCIONES ($campos) VALUES ($valores)";
		$res = mysql_query($sql) or die (mysql_error());
		
		/**
		*	vamos cambiando los valores de los registros de inscripciones
		**/
		$sql = "SELECT $ID_EMPRESA,$PAGADO,$COMISION,$POR_PAGAR,$POR_COMISIONAR,$CLICKS,$CLICKS_PAGADOS," 
				. "$GANANCIA_NETA_ANTERIOR,$GANADO_PROPIO,$GANADO_REFS FROM $TABLA_PAGOS "
				. "WHERE $ID_USUARIO=".$_GET['id'];
		$res = mysql_query($sql) or die (mysql_error());
		while($fila = mysql_fetch_array($res)){
			$pagado = $fila[$PAGADO];
			$comision = $fila[$COMISION];
			$pagado += $fila[$POR_PAGAR];
			$comision += $fila[$POR_COMISIONAR];
			$sql2 = "SELECT $TIPO_GESTION FROM $TABLA_EMPRESAS WHERE $ID=".$fila[$ID_EMPRESA];
			$res2 = mysql_query($sql2) or die (mysql_error());
			$fila2 = mysql_fetch_array($res2);
			if ($fila2[$TIPO_GESTION] == 'c'){
				$neto_actual = $fila[$GANADO_PROPIO] - $fila[$GANADO_REFS];
				$sql3 = "UPDATE $TABLA_PAGOS SET $GANANCIA_NETA_ANTERIOR=".$neto_actual." WHERE $ID_EMPRESA="
						.$fila[$ID_EMPRESA]." and $ID_USUARIO=".$_GET['id'];
				$res3 = mysql_query($sql3) or die (mysql_error());
			}else{
				$clicks_ant = $fila[$CLICKS];
				$sql3 = "UPDATE $TABLA_PAGOS SET $CLICKS_PAGADOS=".$clicks_ant.",$CLICKS=".$clicks_ant
						." WHERE $ID_EMPRESA=".$fila[$ID_EMPRESA]." and $ID_USUARIO=".$_GET['id'];
				$res3 = mysql_query($sql3) or die (mysql_error());
			}
			$sql3 = "UPDATE $TABLA_PAGOS SET $POR_PAGAR=0,$POR_COMISIONAR=0,$PAGADO=".$pagado
					.",$COMISION=".$comision." WHERE $ID_USUARIO=".$_GET['id']." and $ID_EMPRESA="
					.$fila[$ID_EMPRESA];
			$res3 = mysql_query($sql3) or die (mysql_error());
		}
		
		/**
		*	reseteamos NETOS TEMPS DE LAS INSCRIPCIONES, ya que el user 
		*	no tiene que seguir sosteniendo temporales
		**/
		$sql = "UPDATE $TABLA_PAGOS SET $CLICKS_NETOS_TEMP=0,$GANANCIA_NETA_TEMP=0 WHERE $ID_USUARIO=".$_GET['id'];
		$res = mysql_query($sql) or die (mysql_error());
		
		/**
		*	ponemos los EXTRAS como pagados
		**/
		$sql = "UPDATE $TABLA_EXTRAS SET $FECHA_EX='".date("Y-m-d")."' WHERE $ID_USUARIO_EX=".$_GET['id']." AND $PAGADO_EX=0";
		$res = mysql_query($sql) or die (mysql_error());
		$sql = "UPDATE $TABLA_EXTRAS SET $PAGADO_EX=1 WHERE $ID_USUARIO_EX=".$_GET['id']." AND $PAGADO_EX=0";
		$res = mysql_query($sql) or die (mysql_error());?>
		<div class="cuadro_confirm_ok">Pago realizado correctamente!</div><?
		
	}else if (isset($_POST['no'])){
	
	}else{?>
    
		<form action="?mod=lista_usuarios&id=<? echo "$_GET[id]";?>" method="post">
		Pagado mediante:
		<select name="met_pago">
			<option value="Paypal">Paypal</option>
			<option value="Alertpay">Alertpay</option>
			<option value="Egold">Egold</option>
		</select>
		¿Confirma que ya ha pagado a este usuario?
		
			<input type="submit" name="yes" value="SI" />
			<input type="submit" name="no" value="NO" />
			<input type="hidden" name="pagar" value="<? echo "$_POST[pagar]";?>" />
			<input type="hidden" name="pagado" value="<? echo "$_POST[pagado]";?>" />
		</form><?
	}
}





$sql = "SELECT * FROM $TABLA_USUARIOS ORDER BY $NOMBRE_DE_USUARIO ASC";
$res = mysql_query($sql) or die (mysql_error());
$count = mysql_num_rows($res);?>


<!-- ZONA DE IMPRESIÓN -->

<h1>Lista de usuarios (<? echo "$count";?>)</span><a href="./">[Volver]</a></h1><?

if ($count > 0){?>
<table class="sortable" id="tabla">
<thead>
	<tr>
		<th>Nombre</th>
		<th>Mét. pago</th>
		<th>ID cuenta</th>
		<th>A pagar</th>
		<th>Rasgón</th>
		<th>Pagado</th>
		<th>Comisión</th>
		<th>#ptcs</th>
		<th>Ingreso</th>
		<th>Upline</th>
		<th></th>
	</tr>
</thead>
<tbody><?
	while($fila = mysql_fetch_array($res)){
		$por_pagarle = 0;
		$por_comisionarle = 0;
		$pagado = 0;
		$comision = 0;
		$por_pagarle_ex = 0;
		$pagado_ex = 0;
		$num_empresas = 0;?>
		<tr>
			<form action="?mod=lista_usuarios&id=<? echo "$fila[$ID]";?>" method="post">
			<td><a href="?mod=ver_usuario&n=<? echo "$fila[$NOMBRE_DE_USUARIO]";?>" target="_blank"><? echo "$fila[$NOMBRE_DE_USUARIO]";?></a></td>
			<td><? echo "$fila[$FORMA_DE_PAGO]";?></td><?
			switch ($fila[$FORMA_DE_PAGO]){
				case 'paypal':
					$id_cuenta = $fila[$PAYPAL];
					break;
				case 'alertpay':
					$id_cuenta = $fila[$ALERTPAY];
					break;
				case 'egold':
					$id_cuenta = $fila[$EGOLD];
					break;
				default:
					$id_cuenta = "";
					break;
			}?>
			<td><? echo "$id_cuenta";?></td><?
			$sql2 = "SELECT $POR_PAGAR,$POR_COMISIONAR,$PAGADO,$COMISION FROM $TABLA_PAGOS WHERE $ID_USUARIO=".$fila[$ID];
			$res2 = mysql_query($sql2) or die (mysql_error());
			while($fila2 = mysql_fetch_array($res2)){
				$por_pagarle += $fila2[$POR_PAGAR];
				$por_comisionarle += $fila2[$POR_COMISIONAR];
				$pagado += $fila2[$PAGADO];
				$comision += $fila2[$COMISION];
				$num_empresas++;
			}
			$sql2 = "SELECT $CANTIDAD_EX FROM $TABLA_EXTRAS WHERE $PAGADO_EX=0 AND $ID_USUARIO_EX=".$fila[$ID];
			$res2 = mysql_query($sql2) or die (mysql_error());
			while($fila2 = mysql_fetch_array($res2)){
				$por_pagarle_ex += $fila2[$CANTIDAD_EX];
			}
			$sql2 = "SELECT $CANTIDAD_EX FROM $TABLA_EXTRAS WHERE $PAGADO_EX=1 AND $ID_USUARIO_EX=".$fila[$ID];
			$res2 = mysql_query($sql2) or die (mysql_error());
			while($fila2 = mysql_fetch_array($res2)){
				$pagado_ex += $fila2[$CANTIDAD_EX];
			}
			$por_pagarle2=$por_pagarle+$por_pagarle_ex;
			$pagado2=$pagado+$pagado_ex;?>
			<td><? echo "$por_pagarle2";?></td>
			<td><? echo "$por_comisionarle";?></td>
			<td><? echo "$pagado2";?></td>
			<td><? echo "$comision";?></td>
			<td><? echo "$num_empresas";?></td>
			<td><? echo "$fila[$FECHA_DE_INSCRIPCION]";?></td><?
			if ($pagado >=20 & $fila[$REFERIDO_PAGADO] == 0){?>
				<td class="color0"><a href="?mod=ver_usuario&n=<? echo "$fila[$REFERIDO_POR]";?>&action=cargar_extras&action2=cargar_extra_ref&from=<? echo "$fila[$NOMBRE_DE_USUARIO]";?>" target="_blank"><? echo "$fila[$REFERIDO_POR]";?></a></td><?
			}else if($fila[$REFERIDO_PAGADO] == 1){?>
				<td class="color1"><? echo "$fila[$REFERIDO_POR]";?></td><?
			}else{?>
				<td><? echo "$fila[$REFERIDO_POR]";?></td><?
			}?>
			<td><input type="submit" name="pagar" value="Pagado" /></td>
			<input type="hidden" name="pagado" value="<? echo "$por_pagarle";?>" />
			</form>
		</tr><?
	}?>
</tbody>
</table><?
}else{?>
	no se obtuvieron resultados<?
}
}else{?>Acceso restringido.<? }?>