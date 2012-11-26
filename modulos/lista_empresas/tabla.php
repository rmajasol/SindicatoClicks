<?
if ($count > 0){?><div id="box2">
	<table id="tabla" class="sortable" align="center">
	<thead>
		<tr class="cabecera">
			<th>Nombre</th><?
			if (!isset($_GET['estado'])){?>
				<th>Estado</th><?
			}?>
			<th>#refs</th>
			<th>Div</th><?
			if ($_GET['estado'] == 'segura'){?>
				<th>Cobrado</th>
				<th>#</th><?
			}?>
			<th>Progreso</th>
			<th>Min</th>
			<th>Ct/ad</th>
			<th>Ads/d</th>
			<th>CL</th>
			<th>Ct/d</th>
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
				<td class="izquierda hover nombre_ptc"><a href="<? echo "$fila[$LINK_REGISTRO]";?>" target="_blank"><? echo "$fila[$NOMBRE_DE_EMPRESA]";?></a></td><?
				if (!isset($_GET['estado'])){?>
					<td class="estado <? echo "$fila[$ESTADO]";?>"><? echo "$fila[$ESTADO]";?></td><?
				}
				$tot = elegir_color($n_total,$miembros_1,$miembros_2,$miembros_3);?>
				<td class="derecha hover"><? echo "$tot";?></td>
				<td class="<? echo "$fila[$DIVISA]";?> centrado"><? echo simbolo_divisa($fila[$DIVISA]);?></td><?
				if ($_GET['estado']  == 'segura'){?>
					<td><a href="<? echo "$fila[$LINK_COMPROBANTES_PAGO]";?>" target="_blank"><? echo "$total_cobrado";?></a></td>
					<td align="center"><? echo "$num_cobros";?></td><?
				}
				$progreso = barra_progreso($fila[$PROGRESO],$fila[$MINIMO],$divisa);?>
				<td class="derecha hover sinborded"><? echo "$progreso";?></td>
				<td class="izquierda hover sinbordei"><? echo "$fila[$MINIMO]";?></td><?
				$c_ad = elegir_color($fila[$C_AD_PROPIO],$c_ad_1,$c_ad_2,$c_ad_3);?>
				<td class="derecha hover"><? echo "$c_ad";?></td><?
				$ads_dia = elegir_color($fila[$ADS_DIA],$ads_dia_1,$ads_dia_2,$ads_dia_3);?>
				<td class="derecha hover"><? echo "$ads_dia";?></td>
				<td class="izquierda hover"><?
					if ($fila[$CON_CHEATLINK] == 1){?>
						<a href="<? echo "$fila[$CHEATLINK_SCR]";?>" target="_blank"><img src="./files/images/otros/icono-advertencia.gif" title="¡cuidado, <? echo "$fila[$NOMBRE_DE_EMPRESA]";?> tiene cheatlink!" border="0"/></a><?
					}else{}?>
				</td><?
				$c_dia = elegir_color($fila[$C_AD_PROPIO] * $fila[$ADS_DIA],$c_dia_1,$c_dia_2,$c_dia_3);?>
				<td class="derecha hover"><? echo "$c_dia";?></td><?
				$porc = elegir_color($fila[$PORCENTAJE_REFS],$porc_1,$porc_2,$porc_3);
				$porc .= color_porc($fila[$PORCENTAJE_REFS],$porc_1,$porc_2,$porc_3);?>
				<td class="derecha hover"><? echo "$porc";?></td>
				<td class="<? echo "$fila[$METODO_DE_PAGO]";?>"><? echo "$fila[$METODO_DE_PAGO]";?></td>
				<td class="hover"><? echo "$fila[$FECHA_LANZAMIENTO]";?></td>
			</tr><?
		}?>
	</tbody>
	</table><div class='boxbottom2'><div></div></div></div><?
}else
	echo "<center>no se obtuvieron resultados</center>";?>