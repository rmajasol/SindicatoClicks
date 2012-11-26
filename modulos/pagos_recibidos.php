<?
$con = conectar();
$sql = "SELECT $TABLA_EMPRESAS.$NOMBRE_DE_EMPRESA,$TABLA_EMPRESAS.$DIVISA,$TABLA_EMPRESAS.$ID,$TABLA_TIEMPOS_PAGOS.$NUMERO_P,$TABLA_TIEMPOS_PAGOS.$FECHA_DE_PEDIDO,$TABLA_TIEMPOS_PAGOS.$FECHA_DE_COBRO,$TABLA_TIEMPOS_PAGOS.$CANTIDAD,$TABLA_TIEMPOS_PAGOS.$LINK_COMPROBANTE FROM $TABLA_TIEMPOS_PAGOS INNER JOIN $TABLA_EMPRESAS ON $TABLA_TIEMPOS_PAGOS.$ID_EMPRESA=$TABLA_EMPRESAS.$ID ORDER BY $FECHA_DE_COBRO DESC";
$res = mysql_query($sql) or die (mysql_error());?>

<table class="sortable" id="tabla" align="center">
	<thead>
		<tr class="cabecera">
			<th>PTC/PTR</th>
			<th>Pago nº</th>
			<th>Importe</th>
			<th>Pedido</th>
			<th>Recibido</th>
			<th>Demora (días)</th>
		</tr>
	</thead>
	<tbody><?
		while($fila = mysql_fetch_array($res)){
			?>
			<tr>
				<td><? echo "$fila[$NOMBRE_DE_EMPRESA]";?></td>
				<td><? echo "$fila[$NUMERO_P]";?></td>
				<td>
                	<a href="<? echo "$fila[$LINK_COMPROBANTE]";?>" target="_blank"><? 
					echo simbolo_divisa($fila[$DIVISA]) . "$fila[$CANTIDAD]";?></a>
             	</td>
				<td><? echo "$fila[$FECHA_DE_PEDIDO]";?></td>
				<td><? echo "$fila[$FECHA_DE_COBRO]";?></td>
				<td><? echo dias_diferencia($fila[$FECHA_DE_COBRO],$fila[$FECHA_DE_PEDIDO]);?></td>
			</tr><?
		}
		desconectar($con);?>
	</tbody>
</table>