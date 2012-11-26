<?
if ($count > 0){?><div id="box2">
	<table id="tabla" class="sortable" align="center">
	<thead>
		<tr class="cabecera">
			<th>Empresa</th>
			<th>Causa/Motivo</th>
			<th>U</th>
			<th>Cuantía</th>
			<th>Prueba de scam</th>
		</tr>
	</thead>
	<tbody><?
		while($fila = mysql_fetch_array($res)){
			$txt_causa = elegir_color2($fila[$GRAVEDAD_SCAM],$fila[$CAUSA_DE_SCAM]);?>
			<tr>
				<td class="izquierda hover"><? echo "$fila[$NOMBRE_DE_EMPRESA]";?></td>
				<td class="izquierda hover"><? echo "$txt_causa";?></td>
				<td class="izquierda hover"><? echo simbolo_divisa($fila[$DIVISA]);?></td>
				<td class="izquierda hover"><? echo "$fila[$PROGRESO]";?></td>
				<td><a href="<? echo "$fila[$PRUEBA_DE_SCAM]";?>" target="_blank">< Comprobar ></a></td>
			</tr><?
		}?>
	</tbody>
	</table><div class='boxbottom2'><div></div></div></div><?
}else
	echo "<center>no se obtuvieron resultados</center>";?>