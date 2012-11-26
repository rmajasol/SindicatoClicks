<?

if (isset($_GET['id'])){
	$sql = "SELECT * FROM $TABLA_HISTORIAL_PAGOS WHERE $ID=".$_GET['id'];
	$res = mysql_query($sql) or die (mysql_error());
	$fila = mysql_fetch_array($res);
	$numero = $fila[$NUMERO];
	$metodo = $fila[$METODO];
	$fecha = $fila[$FECHA];
	$total_pago = $fila[$CANTIDAD];?>
	<div class="contenido_detalles">
	<div class="titulo_pago">
		Pago número <? echo "$numero";?>  /  Método: <? echo "$metodo";?>  /  fecha: <? echo "$fecha";?>
	</div><?
	$sql = "SELECT * FROM $TABLA_DETALLES_P WHERE $ID_HISTORIAL=".$_GET['id'];
	$res = mysql_query($sql) or die (mysql_error());
	while ($fila = mysql_fetch_array($res)){
		$divisa = dec_utf8($fila[$DIVISA_D]);
		$porc_sind = $fila[$TARIFA_SINDIC_D]*100;?>
		<div class="empresa_detalles">
			Empresa: <span style="color:#FF0000"><? echo "$fila[$EMPRESA_D]";?></span><?
			if ($fila[$TIPO_GESTION_D] == 'c'){
				$neto_actual = $fila[$GANADO_PROPIO_D]-$fila[$GANADO_REFS_D];
				$diferencia = $neto_actual - $fila[$GANADO_NETO_ANTERIOR_D];?>
				<br /><span class="d1">Neto actual: </span><? echo "$fila[$GANADO_PROPIO_D]$divisa";?>(total) - <? echo "$fila[$GANADO_REFS_D]$divisa";?>(tus refs) = <? echo "$neto_actual$divisa";?><br>
				<span class="d1">Neto anterior: </span><? echo "$fila[$GANADO_NETO_ANTERIOR_D]$divisa";?><br>
				<span class="d1">Importe: </span><? echo "$neto_actual$divisa";?> - <? echo "$fila[$GANADO_NETO_ANTERIOR_D]$divisa";?> = <? echo "$diferencia$divisa";
				if ($divisa == '€'){
					$dif_dolares = $diferencia * $fila[$E_DOLAR_D];
					$dif_dolares = redondear_dos_decimal($dif_dolares);
					$total_empresa = ($fila[$PORCENTAJE_REFS_D]/100)*$dif_dolares;
					$total_empresa = redondear_dos_decimal($total_empresa);
					$total_sindicato = $fila[$TARIFA_SINDIC_D]*$total_empresa;
					$total_sindicato = redondear_dos_decimal($total_sindicato);?>
					-> a dólares = <? echo "$diferencia";?>€ * <? echo "$fila[$E_DOLAR_D]";?>$/€ = <? echo "$dif_dolares";?>$<br>
					<span class="d1">% ref de la empresa<?
					if ($fila[$PREMIUM_D] == 1){?>
						(PREMIUM)<?
					}
					?>: </span><? echo "$fila[$PORCENTAJE_REFS_D]";?>% de <? echo "$dif_dolares";?>$ =  <? echo "$total_empresa";?>$<br>
					<span class="d1">% del Sindicato: </span><? echo "$porc_sind";?>% de <? echo "$total_empresa";?>$ = <b><? echo "$total_sindicato";?>$</b><br><?
				}else{
					$total_empresa = ($fila[$PORCENTAJE_REFS_D]/100)*$diferencia;
					$total_empresa = redondear_dos_decimal($total_empresa);
					$total_sindicato = $fila[$TARIFA_SINDIC_D]*$total_empresa;
					$total_sindicato = redondear_dos_decimal($total_sindicato);?>
					<span class="d1">% ref de la empresa<?
					if ($fila[$PREMIUM_D] == 1){?>
						(PREMIUM)<?
					}?>
					: </span><? echo "$fila[$PORCENTAJE_REFS_D]";?>% de <? echo "$diferencia";?>$ =  <? echo "$total_empresa";?>$<br>
					<span class="d1">% del Sindicato: </span><? echo "$porc_sind";?>% de <? echo "$total_empresa";?>$ = <b><? echo "$total_sindicato";?>$</b><br><?
				}
			}else{
				$diferencia = $fila[$CLICKS_D]-$fila[$CLICKS_PAGADOS_D];
				$total = ($diferencia * $fila[$PRECIO_CLICK_REF_D])/100;
				$total = redondear_dos_decimal($total);?>
				<br /><span class="d2">Clicks totales: </span><? echo "$fila[$CLICKS_D]";?><br>
				<span class="d2">Clicks ya pagados: </span><? echo "$fila[$CLICKS_PAGADOS_D]";?><br>
				<span class="d2">Importe: </span><? echo "$diferencia";?> clicks * <? echo "$fila[$PRECIO_CLICK_REF_D]";?> c/click_ref <?
				if ($fila[$TIPO_GESTION_D] == 'b'){?>
					<a href="/foro/viewtopic.php?f=32&t=91&p=455#p455"><span style="color:#0000FF; font-weight:bold">(*)</span></a><?
				}else{?>
					@<?
				}
				if ($fila[$PREMIUM] == 1){?>
					<b> (PREMIUM)</b><?
				}?>
				[<? echo "$fila[$PORCENTAJE_REFS_D]";?>% ref] = <? echo "$total$divisa";
				if ($divisa == '€'){
					$dif_dolares = conv_euro_a_dolar($total);
					$dif_dolares = redondear_dos_decimal($dif_dolares);
					$total_sindicato = $fila[$TARIFA_SINDIC_D]*$dif_dolares;
					$total_sindicato = redondear_dos_decimal($total_sindicato);?>
					<br />-> a dólares = <? echo"$total";?>€ * <? echo "$fila[$E_DOLAR_D]";?>$/€ = <? echo "$dif_dolares";?>$<br>
					<span class="d2">% del Sindicato: </span><? echo "$porc_sind";?>% de <? echo "$dif_dolares";?>$ = <b><? echo "$total_sindicato";?>$</b><br><?
				}else{
					$total_sindicato = $fila[$TARIFA_SINDIC_D]*$total;
					$total_sindicato = redondear_dos_decimal($total_sindicato);?>
					<br /><span class="d2">% del Sindicato: </span><? echo "$porc_sind";?>% de <? echo "$total";?>$ = <b><? echo "$total_sindicato";?>$</b><br><?
				}
			}?>
		</div><?
	}// fin de WHILE
	$sql = "SELECT * FROM $TABLA_DETALLES_P_EXTRA WHERE $ID_HISTORIAL=".$_GET['id'];
	$res = mysql_query($sql) or die (mysql_error());
	while ($fila = mysql_fetch_array($res)){
		$id_extra = $fila[$ID_EXTRA];
		$sql2 = "SELECT * FROM $TABLA_EXTRAS WHERE $ID_EX=".$id_extra;
		$res2 = mysql_query($sql2) or die (mysql_error());
		$fila2 = mysql_fetch_array($res2);
		$concep = dec_utf8($fila2[$CONCEPTO_EX]);?>
		<div class="extra_detalles">
			Extra: <? echo "$concep";?>
			<br/>Cantidad: $<? echo "$fila2[$CANTIDAD_EX]";?>
		</div><?
	}?>
		
	<div class="total">
		TOTAL: <? echo "$total_pago";?>
	</div>
    <div class="boton_volver volver"><a href="?mod=ganancias&about=historial">Volver</a></div>
	</div><?
	
} else {?>

<div class="contenido_tabla"><?
	$sql = "SELECT * FROM $TABLA_HISTORIAL_PAGOS WHERE $ID_USUARIO=".$id_usuario;
	$res = mysql_query($sql) or die (mysql_error());
	$count = mysql_num_rows($res);?>
	<span class="titulop"><center>Historial de pagos</center></span><?
	if ($count > 0){?>
		<table id="tabla">
			<thead class="tabla">
				<tr>
					<th>#</th>
					<th><span class="prueba">Fecha</span></th>
					<th>Importe</th>
					<th>Método</th>
					<th>Detalles</th>
				</tr>
			</thead>
			<tbody><?
				while($fila = mysql_fetch_array($res)){?>
					<tr>
						<td align="right"><? echo "$fila[$NUMERO]";?></td>
						<td><? echo "$fila[$FECHA]";?></td>
						<td align="right"><? echo "$fila[$CANTIDAD]";?></td>
						<td><? echo "$fila[$METODO]";?></td>
						<td><a href="?mod=ganancias&about=historial&id=<? echo "$fila[$ID]";?>">< Detalles ></a></td>
					</tr><?
				}?>
			</tbody>
		</table><?
	}else{?>
		No tiene ningún pago realizado<?
	}?>
</div><?

}?>
