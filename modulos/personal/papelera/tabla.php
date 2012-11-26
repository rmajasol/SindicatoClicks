<?

if ($count > 0){?>			
	<table class="sortable" align="center" border="2"  cellpadding="2" cellspacing="0">
		<thead>
			<tr class="cabecera">
				<th>Nombre</th>
				<th>Estado</th>
				<th>#refs</th>
				<th>Div</th>
				<th>Progreso</th>
				<th>Cent/ad</th>
				<th>Ads/día</th>
				<th>%ref</th>
				<th>Pago</th>
				<th>Adicionado</th>
			</tr>
		</thead>
		<tbody><?
			while($fila = mysql_fetch_array($res)){
				$n_miembros = total_empresa($fila[$ID],'n_miembros');
				$n_externos = $fila[$NUM_REFS_EXTERNOS];
				$n_total = $n_miembros + $n_externos;
				$total_cobrado = total_cobrado($fila[$ID]);
				$num_cobros = num_cobros($fila[$ID]);?>
				<tr>
					<td class="hover">
					<a href="<? echo "$fila[$LINK_SURF]";?>" target="_blank"><? echo "$fila[$NOMBRE_DE_EMPRESA]";?></a>
					</td>
					<td class="estado <? echo "$fila[$ESTADO]";?>"><? echo "$fila[$ESTADO]";?></td>
					<td class="right hover"><? echo elegir_color($n_total,$miembros_1,$miembros_2,$miembros_3);?></td>
					<td class="centrado <? echo "$fila[$DIVISA]";?>"><? echo simbolo_divisa($fila[$DIVISA]);?></td>
					<td class="derecha hover"><? echo barra_progreso($fila[$PROGRESO],$fila[$MINIMO]);?></td>
					<td class="right hover"><? echo elegir_color($fila[$C_AD_PROPIO],$c_ad_1,$c_ad_2,$c_ad_3);?></td>
					<td class="right hover"><? echo elegir_color($fila[$ADS_DIA],$ads_dia_1,$ads_dia_2,$ads_dia_3);?></td>
					<td class="right hover"><? echo elegir_color($fila[$PORCENTAJE_REFS],$porc_1,$porc_2,$porc_3);?></td>
					<td class="<? echo "$fila[$METODO_DE_PAGO]";?>"><? echo "$fila[$METODO_DE_PAGO]";?></td>
                    <td class="hover"><? echo "$fila[$FECHA_LANZAMIENTO]";?></td>
				</tr><?
			}?>
		</tbody>
	</table><? 
}else{?>
	<div class="cuadro_mensaje">No tienes agregada en tu papelera ninguna empresa.</div><?
}?>