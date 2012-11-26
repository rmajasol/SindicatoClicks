<?
if ($count > 0){?><div id="tabla">
	<table class="sortable" align="center">
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
			$causa = dec_utf8($fila[$CAUSA_DE_SCAM]);
			$divisa = dec_utf8($fila[$DIVISA]);
			$txt_causa = elegir_color2($fila[$GRAVEDAD_SCAM],$causa);
			if ($_GET['cat'] != 'mias'){
				if ($fila[$ID_EMPRESA] == NULL){?>
					<tr>
						<td class="izquierda hover"><? echo "$fila[$NOMBRE_DE_EMPRESA]";?></td>
						<td class="izquierda hover"><? echo "$txt_causa";?></td>
						<td class="izquierda hover"><? echo "$divisa";?></td>
						<td class="izquierda hover"><? echo "$fila[$PROGRESO]";?></td>
						<td><a href="<? echo "$fila[$PRUEBA_DE_SCAM]";?>" target="_blank">< Comprobar ></a></td>
					</tr><?
				}
			}else{?>
				<tr>
					<td class="izquierda hover"><? echo "$fila[$NOMBRE_DE_EMPRESA]";?></td>
					<td class="izquierda hover"><? echo "$txt_causa";?></td>
					<td class="izquierda hover"><? echo "$divisa";?></td>
					<td class="izquierda hover"><? echo "$fila[$PROGRESO]";?></td>
					<td><a href="<? echo "$fila[$PRUEBA_DE_SCAM]";?>" target="_blank">< Comprobar ></a></td>
				</tr><?
			}
		}?>
	</tbody>
	</table></div><?
}else
	echo "<center>no se obtuvieron resultados</center>";?>