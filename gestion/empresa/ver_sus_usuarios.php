<?
if ($admin == 1){

/**
*	BLOQUE PARA EDITAR SUSCRIPCIÓN
**/
if (isset($_POST['editar'])){
	$sql2 = "UPDATE $TABLA_PAGOS SET ";
	$sql2 .= "$NICK= '" . $_POST['nick'] . 		"', ";
	$sql2 .= "$POR_PAGAR= '" . $_POST['por_pagar'] . 		"', ";
	$sql2 .= "$POR_COMISIONAR = '" . $_POST['por_comisionar'] . 		"', ";
	$sql2 .= "$PAGADO = '" . $_POST['pagado'] . 		"', ";
	$sql2 .= "$COMISION = '" . $_POST['comision'] . 		"', ";
	$sql2 .= "$FECHA_INSCRIPCION = '" . $_POST['f_año_fecha'] . "-" . $_POST['f_mes_fecha'] . "-" . $_POST['f_dia_fecha']	. "' ";
	$sql2 .= "WHERE $ID=" . $_GET['id'];
	$res2 = mysql_query($sql2) or die(mysql_error());
	?>
	<div class="cuadro_confirm_ok">Subscripción editada correctamente!</div><?
}

/**
*	BLOQUE PARA ELIMINAR SUSCRIPCIÓN
**/
if ($_GET['action2'] == 'eliminar'){
	if (isset($_POST['yes'])){
		$sql2 = "DELETE FROM inscripciones WHERE id=" . $_GET['id'];
		$res2 = mysql_query($sql2) or die (mysql_error());?>
		<div class="cuadro_confirm_ok">Subscripción eliminada correctamente!</div><?
	}else if (isset($_POST['no'])){
	}else{
		$sql2 = "SELECT $TABLA_USUARIOS.$NOMBRE_DE_USUARIO FROM $TABLA_USUARIOS INNER JOIN $TABLA_PAGOS ON $TABLA_PAGOS.$ID_USUARIO=$TABLA_USUARIOS.$ID WHERE $TABLA_PAGOS.$ID=$_GET[id]";
		$res2 = mysql_query($sql2) or die (mysql_error());
		$fila2 = mysql_fetch_array($res2);?>
		<div class="cuadro_confirm">
        	¿Estás seguro de querer eliminar la subscripción de 
            <b><? echo "$fila2[$NOMBRE_DE_USUARIO]";?></b>?
			<form action="?mod=ver_empresa&n=<? 
				echo "$_GET[n]";?>&action=ver_sus_usuarios&action2=eliminar&id=<? 
				echo "$_GET[id]";?>" method="post">
				<input type="submit" name="yes" value="SI" />&nbsp;
				<input type="submit" name="no" value="NO" />
			</form>
     	</div><?
	}
}

/**
*	BLOQUE PARA VER USUARIOS EN ESA EMPRESA
**/
$sql = "SELECT $ID FROM $TABLA_EMPRESAS WHERE $NOMBRE_DE_EMPRESA='" . $_GET['n']."'";
$res = mysql_query($sql) or die (mysql_error());
$fila = mysql_fetch_array($res);
$id_empresa = $fila[$ID];
$sql = "SELECT $TABLA_PAGOS.*,$TABLA_USUARIOS.$NOMBRE_DE_USUARIO FROM $TABLA_USUARIOS INNER JOIN $TABLA_PAGOS ON $TABLA_PAGOS.$ID_USUARIO=$TABLA_USUARIOS.$ID WHERE $TABLA_PAGOS.$ID_EMPRESA=".$id_empresa." ORDER BY $NOMBRE_DE_USUARIO ASC";
$res = mysql_query($sql) or die (mysql_error());
$count = mysql_num_rows($res);?>

<h3 align="center">Usuarios en <? echo "$_GET[n]";?> (<? echo "$count";?>)</h3><?

if ($count > 0){?>			
	<table class="sortable" id="tabla">
	<thead>
		<tr>
			<th>Nombre</th>
			<th>Nick</th>
			<th>Por pagar</th>
			<th>Por comisionar</th>
			<th>Pagado</th>
			<th>Comisión</th>
			<th>Fecha incorporación</th>
		</tr>
	</thead>
	<tbody><?
		while($fila = mysql_fetch_array($res)){
				if ($_GET['action2'] == 'editar' & $fila[$ID] == $_GET['id'] & !isset($_POST['editar'])){
					$fecha = $fila[$FECHA_INSCRIPCION];
					$año = substr($fecha,0,4);
					$mes = substr($fecha,5,2);
					$dia = substr($fecha,8,2);?>
					<form action="?mod=ver_empresa&n=<? echo "$_GET[n]";?>&action=ver_sus_usuarios&action2=editar&id=<? echo "$fila[$ID]";?>" method="post">
					<tr>
						<td><a href="?mod=ver_usuario&n=<? echo "$fila[$NOMBRE_DE_USUARIO]";?>"><? echo "$fila[$NOMBRE_DE_USUARIO]";?></a></td>
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
						<td><a href="?mod=ver_usuario&n=<? echo "$fila[$NOMBRE_DE_USUARIO]";?>"><? echo "$fila[$NOMBRE_DE_USUARIO]";?></a></td></td>
						<td><? echo "$fila[$NICK]";?></td>
						<td><? echo "$fila[$POR_PAGAR]";?></td>
						<td><? echo "$fila[$POR_COMISIONAR]";?></td>
						<td><? echo "$fila[$PAGADO]";?></td>
						<td><? echo "$fila[$COMISION]";?></td>
						<td><? echo "$fila[$FECHA_INSCRIPCION]";?></td>
						<td><a href="?mod=ver_empresa&n=<? echo "$_GET[n]";?>&action=ver_sus_usuarios&action2=editar&id=<? echo "$fila[$ID]";?>">Editar</a> | <a href="?mod=ver_empresa&n=<? echo "$_GET[n]";?>&action=ver_sus_usuarios&action2=eliminar&id=<? echo "$fila[$ID]";?>">Eliminar</a></td>
					</tr><?
				}
		}
}else{?>
  No hay ningún usuario inscrito en esta empresa.<?
}?>
</tbody>
</table><?

}else{?>acceso denegado.<? }?>