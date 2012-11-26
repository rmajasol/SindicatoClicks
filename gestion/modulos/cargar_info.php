<?
if ($admin == 1){
if (isset($_POST['cargar'])){
	for ($j=0;$j<=$_POST['num'];$j++){
		$a1 = "tipo_gest".$j;
		$tipo_gestion = $_POST[$a1];
		$a2 = "id".$j;
		$id_empresa = $_POST[$a2];
		$a3 = "progreso".$j;
		$progreso = $_POST[$a3];
		$a4 = "clicks_propios".$j;
		$clicks_propios = $_POST[$a4];
		$a5 = "clicks_refs".$j;
		$clicks_refs = $_POST[$a5];
		$a6 = "porc_refs".$j;
		$porc_refs = $_POST[$a6];
		$a7 = "c_ad".$j;
		$c_ad = $_POST[$a7];
		$a8 = "n_ads".$j;
		$ads_dia = $_POST[$a8];
		
		
		if ($tipo_gestion == 'b'){
			$cobrado = 0;
			$mensaje = "SELECT $CANTIDAD FROM $TABLA_TIEMPOS_PAGOS WHERE $ID_EMPRESA=".$id_empresa;
			$peticion = mysql_query($mensaje) or die (mysql_error());
			$count = mysql_num_rows($peticion);
			if ($count = 0)
				$cobrado = 0;
			else
				while($fila = mysql_fetch_array($peticion))
					$cobrado += $fila[$CANTIDAD];
			$c_ad_global = (($progreso + $cobrado)*100)/($clicks_propios + $clicks_refs);
			$ganado_refs = $c_ad_global * ($clicks_refs * ($porc_refs/100))/100;
			$ganado_propio = ($progreso + $cobrado)-$ganado_refs;
			$c_ad_own = ($ganado_propio*100)/$clicks_propios;
			$c_ad_ref = ($ganado_refs*100)/$clicks_refs;
				
			$c_ad_global =  redondear_dos_decimal($c_ad_global);
			$ganado_refs =  redondear_dos_decimal($ganado_refs);
			$ganado_propio =  redondear_dos_decimal($ganado_propio);
			$c_ad_own =  redondear_dos_decimal($c_ad_own);
			$c_ad_ref =  redondear_dos_decimal($c_ad_ref);
			
			$sql = "UPDATE $TABLA_EMPRESAS SET ";
			$sql .= "$ADS_DIA = '" . $ads_dia . "', ";
			$sql .= "$PROGRESO = '" . $progreso . "', ";
			$sql .= "$CLICKS_PROPIO = " . $clicks_propios . ", ";
			$sql .= "$CLICKS_REF = " . $clicks_refs . ", ";
			$sql .= "$C_AD_GLOBAL = " . $c_ad_global . ", ";
			$sql .= "$C_AD_PROPIO = " . $c_ad_own . ", ";
			$sql .= "$C_AD_REF = " . $c_ad_ref . ", ";
			$sql .= "$GANADO_PROPIO_E = " . $ganado_propio . ", ";
			$sql .= "$GANADO_REFS_E = " . $ganado_refs . " ";
			$sql .= "WHERE $ID=" . $id_empresa;
			$res = mysql_query($sql) or die(mysql_error());
		}else{
			$cent_ad_ref = $c_ad * ($porc_refs/100);
			$sql = "UPDATE $TABLA_EMPRESAS SET ";
			$sql .= "$ADS_DIA = '" . $ads_dia . "', ";
			$sql .= "$C_AD_REF = '" . $cent_ad_ref . "', ";
			$sql .= "$PROGRESO = '" . $progreso . "' ";
			$sql .= "WHERE $ID=" . $id_empresa;
			$res = mysql_query($sql) or die(mysql_error());
		}
	}?>
	<div class="mensaje">Datos cargados correctamente!</div><?
}


$sql = "SELECT $ID,$NOMBRE_DE_EMPRESA,$ADS_DIA,$C_AD_PROPIO,$LINK_SURF,$CLICKS_PROPIO,$CLICKS_REF,$PROGRESO,$PORCENTAJE_REFS,$TIPO_GESTION,$PAGO_PEDIDO,$MINIMO FROM $TABLA_EMPRESAS WHERE $ESTADO!='scam' and $DUEÑO='".$username."'";
$sql .= " ORDER BY $NOMBRE_DE_EMPRESA ASC";
$res = mysql_query($sql) or die (mysql_error());
$count = mysql_num_rows($res);?>


<? //////////////////////////////// TITULO ////////////////////////////////////////////?>
<div class="titulo">Cargar info en empresas bajo <span class="user"><? echo "$username";?></span></div>

<div class="tabla">
<? //////////////////////////////// TABLA ////////////////////////////////////////////
if ($count > 0){?>
	<form action="<? $_SERVER['PHP_SELF']?>" method="post">
	<table id="tabla">
	<thead>
		<tr>
			<th>Nombre</th>
			<th>Num ads</th>
			<th>Progreso</th>
			<th>Cash-out?</th>
			<th>Clicks propios</th>
			<th>Clicks refs</th>
		</tr>
	</thead>
	<tbody>
		<?
		$i = 0;
		while($fila = mysql_fetch_array($res)){?>
			<tr>
				<td><a href="<? echo "$fila[$LINK_SURF]";?>" target="_blank"><? echo "$fila[$NOMBRE_DE_EMPRESA]";?></a></td>
				<td align="center"><input name="n_ads<? echo "$i";?>" type="text" size="3"  value="<? echo "$fila[$ADS_DIA]";?>"/></td>
				<td align="center"><input name="progreso<? echo "$i";?>" type="text" size="3"  value="<? echo "$fila[$PROGRESO]";?>"/></td><?
				if ($fila[$PAGO_PEDIDO]==0 & $fila[$PROGRESO]/$fila[$MINIMO]>=1){?>
					<td class="cashout"></td><?
				}else if ($fila[$PAGO_PEDIDO]==1){?>
					<td class="esperando_pago"></td><?
				}else{?>
					<td></td><?
				}
				if ($fila[$TIPO_GESTION] == 'a' | $fila[$TIPO_GESTION] == 'c'){?>
					<td colspan="2" bgcolor="#0033FF"></td><?
				}else{?>
					<td align="center"><input name="clicks_propios<? echo "$i";?>" type="text" size="3"  value="<? echo "$fila[$CLICKS_PROPIO]";?>"/></td>
					<td align="center"><input name="clicks_refs<? echo "$i";?>" type="text" size="3"  value="<? echo "$fila[$CLICKS_REF]";?>"/></td><?
				}?>
			</tr>
			
			<input name="c_ad<? echo "$i";?>" type="hidden" value="<? echo "$fila[$C_AD_PROPIO]";?>"/>
			<input name="porc_refs<? echo "$i";?>" type="hidden" value="<? echo "$fila[$PORCENTAJE_REFS]";?>"/>
			<input name="id<? echo "$i";?>" type="hidden" value="<? echo "$fila[$ID]";?>"/>
			<input name="tipo_gest<? echo "$i";?>" type="hidden" value="<? echo "$fila[$TIPO_GESTION]";?>"/>
			<input name="num" type="hidden" value="<? echo "$i";?>"/><?
			$i++;
		}?>
	</tbody>
	<tfoot>
		<tr>
			<td colspan="5" align="right" style="border:none"><input type="submit" name="cargar" value="Cargar" /></td>
		</tr>
	</tfoot>
	</table>
	</form><?
}else
	echo "<center>no se obtuvieron resultados</center>";?>
</div><?
}else{?> acceso denegado.<? }?>