<?
if ($admin == 1){

//BLOQUE PARA EDITAR SUSCRIPCIÓN
if (isset($_POST['editar'])){
	$sql2 = "UPDATE $TABLA_PAGOS SET ";
	$sql2 .= "$NICK = '" . $_POST['nick'] . 		"', ";
	$sql2 .= "$POR_PAGAR= '" . $_POST['por_pagar'] . 		"', ";
	$sql2 .= "$POR_COMISIONAR = '" . $_POST['por_comisionar'] . 		"', ";
	$sql2 .= "$PAGADO = '" . $_POST['pagado'] . 		"', ";
	$sql2 .= "$COMISION = '" . $_POST['comision'] . 		"', ";
	$sql2 .= "$FECHA_INSCRIPCION = '" . $_POST['f_año_fecha'] . "-" . $_POST['f_mes_fecha'] . "-" . $_POST['f_dia_fecha']	. "' ";
	$sql2 .= "WHERE $ID=" . $_GET['id'];
	$res2 = mysql_query($sql2) or die(mysql_error());?>
	<div class="cuadro_confirm_ok">Subscripción editada correctamente!</div><?
}

//BLOQUE PARA ELIMINAR SUSCRIPCIÓN
if ($_GET['action2'] == 'eliminar'){
	if (isset($_POST['yes'])){
		$sql2 = "DELETE FROM inscripciones WHERE id=" . $_GET['id'];
		$res2 = mysql_query($sql2) or die (mysql_error());?>
		<div class="cuadro_confirm_ok">Subscripción eliminada correctamente!</div><?
	}else if (isset($_POST['no'])){
	}else{
		$sql2 = "SELECT $TABLA_EMPRESAS.$NOMBRE_DE_EMPRESA FROM $TABLA_EMPRESAS INNER JOIN $TABLA_PAGOS ON $TABLA_PAGOS.$ID_EMPRESA=$TABLA_EMPRESAS.$ID WHERE $TABLA_PAGOS.$ID=$_GET[id]";
		$res2 = mysql_query($sql2) or die (mysql_error());
		$fila2 = mysql_fetch_array($res2);?>
		<div class="cuadro_confirm">
        	¿Estás seguro de querer eliminarle la subscripción a <b><?
			echo "$fila2[$NOMBRE_DE_EMPRESA]";?></b>?
            <form action="?mod=ver_usuario&n=<? 
                        echo "$_GET[n]";?>&action=ver_sus_empresas&action2=eliminar&id=<?
                        echo "$_GET[id]";?>" method="post">
                <input type="submit" name="yes" value="SI" />&nbsp;
                <input type="submit" name="no" value="NO" />
            </form>
        </div><?
	}
}


//BLOQUE PARA MOSTRAR SUSCRIPCIONES
$sql = "SELECT $ID FROM $TABLA_USUARIOS WHERE $NOMBRE_DE_USUARIO='$_GET[n]'";
$res = mysql_query($sql) or die (mysql_error());
$fila = mysql_fetch_array($res);
$id_u = $fila[$ID];
$sql = "SELECT $TABLA_PAGOS.*,$TABLA_EMPRESAS.$NOMBRE_DE_EMPRESA FROM $TABLA_EMPRESAS INNER JOIN $TABLA_PAGOS ON $TABLA_PAGOS.$ID_EMPRESA=$TABLA_EMPRESAS.$ID WHERE $TABLA_PAGOS.$ID_USUARIO='$id_u'"; 
if ($ver_todas == 0)
	$sql .= " and $DUEÑO='".$username."'";
if ($ver_scam == 0)
	$sql .= " and $ESTADO!='scam'";
$sql .= " ORDER BY $NOMBRE_DE_EMPRESA ASC";
$res = mysql_query($sql) or die (mysql_error());
$count = mysql_num_rows($res);


if ($count > 0){?>

	<table class="sortable" id="tabla">
	<thead>
		<tr>
			<th>Empresa</th>
			<th>Nick</th>
			<th>Por pagar</th>
			<th>Por comisionar</th>
			<th>Pagado</th>
			<th>Comisión</th>
			<th>Fecha adición</th>
			<th>Acción</th>
		</tr>
	</thead>
	<tbody><?
		$total_por_pagar = 0;
		$total_por_comisionar = 0;
		$total_pagado = 0;
		$total_comision = 0;
		while($fila = mysql_fetch_array($res)){
			if ($_GET['action2'] == 'editar' & $fila[$ID] == $_GET['id'] & !isset($_POST['editar'])){
				$fecha = $fila[$FECHA_INSCRIPCION];
				$año = substr($fecha,0,4);
				$mes = substr($fecha,5,2);
				$dia = substr($fecha,8,2);?>
				<form action="?mod=ver_usuario&n=<? echo "$_GET[n]";?>&action=ver_sus_empresas&action2=editar&id=<? echo "$fila[$ID]";?>" method="post">
				<tr>
					<td><? echo "$fila[$NOMBRE_DE_EMPRESA]";?></td>
					<td align="right"><input name="nick" type="text" size="10" value="<? echo "$fila[$NICK]";?>"/></td>
					<td><input name="por_pagar" type="text" size="10" value="<? echo "$fila[$POR_PAGAR]";?>"/></td>
					<td><input name="por_comisionar" type="text" size="10" value="<? echo "$fila[$POR_COMISIONAR]";?>"/></td>
					<td align="right"><input name="pagado" type="text" size="7"  value="<? echo "$fila[$PAGADO]";?>"/></td>
					<td align="right"><input name="comision" type="text" size="7"  value="<? echo "$fila[$COMISION]";?>"/></td>
					<td align="center"><? form_comp_fecha($año,$mes,$dia,'fecha');?></td>
					<td align="center"><input type="submit" name="editar" value="Aceptar" /></td>
				</tr>
				</form><?
			}else{?>
				<tr>
					<td><? echo "$fila[$NOMBRE_DE_EMPRESA]";?></td>
					<td><? echo "$fila[$NICK]";?></td>
					<td><? echo "$fila[$POR_PAGAR]";?></td>
					<td><? echo "$fila[$POR_COMISIONAR]";?></td>
					<td><? echo "$fila[$PAGADO]";?></td>
					<td><? echo "$fila[$COMISION]";?></td>
					<td><? echo "$fila[$FECHA_INSCRIPCION]";?></td>
					<td><a href="?mod=ver_usuario&n=<? echo "$_GET[n]";?>&action=ver_sus_empresas&action2=editar&id=<? echo "$fila[$ID]";?>">Editar</a> | <a href="?mod=ver_usuario&n=<? echo "$_GET[n]";?>&action=ver_sus_empresas&action2=eliminar&id=<? echo "$fila[$ID]";?>">Eliminar</a></td>
				</tr><?
			}
			$total_por_pagar += $fila[$POR_PAGAR];
			$total_por_comisionar += $fila[$POR_COMISIONAR];
			$total_pagado += $fila[$PAGADO];
			$total_comision += $fila[$COMISION];
		}?>
	</tbody>
	<tfoot>
	  <td colspan="2" align="center">Total</td>
		<td><? echo "$total_por_pagar";?></td>
		<td><? echo "$total_por_comisionar";?></td>
		<td><? echo "$total_pagado";?></td>
		<td><? echo "$total_comision";?></td>
		<td colspan="2"></td>
	</tfoot>
	</table><?
	
}else{?>
	<tr><td colspan='7' align='center'><span class="Estilo1">Este usuario no está apuntado a ninguna empresa.</span></td></tr><?
}

}else{?>acceso denegado.<? }?>