<?
if ($admin == 1){

$sql = "SELECT $ID FROM $TABLA_EMPRESAS WHERE $NOMBRE_DE_EMPRESA='" . $_GET['n']."'";
$res = mysql_query($sql) or die (mysql_error());
$fila = mysql_fetch_array($res);
$id_empresa = $fila[$ID];

if(isset($_POST['editar']) | $_GET['action2'] == 'editar_ok'){
	if(isset($_POST['yes'])){
		$sql2 = "UPDATE $TABLA_TIEMPOS_PAGOS SET ";
		$sql2 .= "$FECHA_DE_PEDIDO = '" . $_POST['f_año_pedido'] . "-" . $_POST['f_mes_pedido'] 
					. "-" . $_POST['f_dia_pedido']	. "', ";
		$sql2 .= "$FECHA_DE_COBRO = '" . $_POST['f_año_cobro'] . "-" . $_POST['f_mes_cobro'] 
					. "-" . $_POST['f_dia_cobro']	. "', ";
		$sql2 .= "$CANTIDAD = '" . $_POST['cantidad'] . 		"', ";
		$sql2 .= "$NUMERO_P = '" . $_POST['numero'] . 		"', ";
		$sql2 .= "$LINK_COMPROBANTE = '" . $_POST['link'] . 		"' ";
		$sql2 .= "WHERE $ID=" . $_GET['id'];
		$res = mysql_query($sql2) or die(mysql_error());?>
		<div class="cuadro_confirm_ok">Cobro editado correctamente!</div><?
	}else if (isset($_POST['no'])){
	}else{?>
    	<div class="cuadro_confirm">
            ¿Estás seguro de querer editarlo?
            <form action="?mod=ver_empresa&n=<? 
				echo "$_GET[n]";?>&action=info_de_cobros&action2=editar_ok&id=<? 
				echo "$_GET[id]";?>" method="post">
                <input type="hidden" name="f_año_pedido" value="<? echo "$_POST[f_año_pedido]";?>">
                <input type="hidden" name="f_mes_pedido" value="<? echo "$_POST[f_mes_pedido]";?>">
                <input type="hidden" name="f_dia_pedido" value="<? echo "$_POST[f_dia_pedido]";?>">
                <input type="hidden" name="f_año_cobro" value="<? echo "$_POST[f_año_cobro]";?>">
                <input type="hidden" name="f_mes_cobro" value="<? echo "$_POST[f_mes_cobro]";?>">
                <input type="hidden" name="f_dia_cobro" value="<? echo "$_POST[f_dia_cobro]";?>">
                <input type="hidden" name="cantidad" value="<? echo "$_POST[cantidad]";?>">
                <input type="hidden" name="link" value="<? echo "$_POST[link]";?>">
                <input type="hidden" name="numero" value="<? echo "$_POST[numero]";?>">
                <input type="submit" name="yes" value="SI" />&nbsp;
                <input type="submit" name="no" value="NO" />
            </form>
		</div><?
	}
}

$sql = "SELECT * FROM $TABLA_TIEMPOS_PAGOS WHERE $ID_EMPRESA=".$id_empresa." ORDER BY $FECHA_DE_COBRO ASC";
$res = mysql_query($sql) or die (mysql_error());
$count = mysql_num_rows($res);?>

<h3 align="center">Cobros en <? echo "$_GET[n]";?> (<? echo "$count";?>)</h3><?

if ($count > 0){?>		
	
<table class="sortable" id="tabla">
<thead>
	<tr>
		<th>Número</th>
		<th>Fecha pedido</th>
		<th>Fecha cobro</th>
		<th>Diferencia (días)</th>
		<th>Cantidad</th>
		<th>Link comprobante</th>
		<th>Acción</th>
	</tr>
</thead>
<tbody><?
	while($fila = mysql_fetch_array($res)){
		$diferencia_dias = dias_diferencia($fila[$FECHA_DE_COBRO],$fila[$FECHA_DE_PEDIDO]);
		if ($_GET['action2'] == 'editar' & $fila[$ID] == $_GET['id'] & !isset($_POST['editar'])){?>
			<tr><?
				$fecha_pedido = $fila[$FECHA_DE_PEDIDO];
				$año_pedido = substr($fecha_pedido,0,4);
				$mes_pedido = substr($fecha_pedido,5,2);
				$dia_pedido = substr($fecha_pedido,8,2);
				$fecha_cobro = $fila[$FECHA_DE_COBRO];
				$año_cobro = substr($fecha_cobro,0,4);
				$mes_cobro = substr($fecha_cobro,5,2);
				$dia_cobro = substr($fecha_cobro,8,2);?>
				<form action="?mod=ver_empresa&n=<? echo "$_GET[n]";?>&action=info_de_cobros&action2=editar_ok&id=<? echo "$fila[$ID]";?>" method="post">
				<td><input type="text" name="numero" value="<? echo "$fila[$NUMERO_P]";?>"></td>
				<td><? form_comp_fecha($año_pedido,$mes_pedido,$dia_pedido,'pedido');?></td>
				<td><? form_comp_fecha($año_cobro,$mes_cobro,$dia_cobro,'cobro');?></td>
				<td><? echo "$diferencia_dias";?></td>
				<td><input type="text" name="cantidad" value="<? echo "$fila[$CANTIDAD]";?>"></td>
				<td><input type="text" name="link" value="<? echo "$fila[$LINK_COMPROBANTE]";?>"></td>
				<td>
				<input type="submit" name="editar" value="Aceptar">
				</form></td>
			</tr><?
			$i++;
		}else{?>
			<tr>
				<td><? echo "$fila[$NUMERO_P]";?></td>
				<td><? echo "$fila[$FECHA_DE_PEDIDO]";?></td>
				<td><? echo "$fila[$FECHA_DE_COBRO]";?></td>
				<td><? echo "$diferencia_dias";?></td>
				<td><? echo "$fila[$CANTIDAD]";?></td>
				<td><a href="<? echo "$fila[$LINK_COMPROBANTE]";?>" target="_blank"><< link >></a></td>
				<td><a href="?mod=ver_empresa&n=<? echo "$_GET[n]";?>&action=info_de_cobros&action2=editar&id=<? echo "$fila[$ID]";?>">Editar</a></td>
			</tr><?
		}
	}
}else{?>
	<span class="Estilo1">No hay ningún cobro efectuado por parte de esta empresa.</span><?
}?>
</tbody>
</table><?

}else{?>acceso denegado.<? }?>