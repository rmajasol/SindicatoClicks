<?
// color para los ads/día, cent/ad, %ref...
function elegir_color($valor,$v1,$v2,$v3){
	if ($valor == '€')
		$color = "#00ccff";
	else if ($valor == '$')
		$color = "green";
	else{
		if ($valor <= $v1)
			$color = "red";
		else if ($v1 <= $valor & $valor <= $v2)
			$color = "orange";
		else if ($v2 <= $valor & $valor <= $v3)
			$color = "green";
		else if ($v3 <= $valor)
			$color = "#00FF00";
	}
	$cod = "[color=".$color."]".$valor."[/color]";
	
	return $cod;
}

function elegir_color2($valor,$txt){//esto es para elegir el color de causa de SCAM
	switch ($valor){
		case 'baja':
			$color = "yellow";
			break;
		case 'media':
			$color = "orange";
			break;
		case 'alta':
			$color = "red";
			break;
	}
	$cod = "[color=".$color."]".$txt."[/color]";
	
	return $cod;
}

function color_porc($valor,$v1,$v2,$v3){
	if ($valor == '€')
		$color = "#00ccff";
	else if ($valor == '$')
		$color = "green";
	else{
		if ($valor <= $v1)
			$color = "red";
		else if ($v1 <= $valor & $valor <= $v2)
			$color = "orange";
		else if ($v2 <= $valor & $valor <= $v3)
			$color = "green";
		else if ($v3 <= $valor)
			$color = "#00FF00";
	}
	$cod = "[color=".$color."]%[/color]";
	
	return $cod;
}

function barra_progreso($progreso,$minimo,$divisa){
	global $IMAGENES;
	$porcentaje = round((100*$progreso)/$minimo);
	if ($porcentaje <= 10){
		$cod = "[img]$IMAGENES/barra_progreso/00-10.gif[/img]";
		$cod .= "[b][color=red]".$divisa.$progreso."[/color]/".$divisa.$minimo."[/b]";
	}else if ($porcentaje > 10 && $porcentaje <= 20){
		$cod = "[img]$IMAGENES/barra_progreso/10-20.gif[/img]";
		$cod .= "[b][color=red]".$divisa.$progreso."[/color]/".$divisa.$minimo."[/b]";
	}else if ($porcentaje > 20 && $porcentaje <= 30){
		$cod = "[img]$IMAGENES/barra_progreso/20-30.gif[/img]";
		$cod .= "[b][color=red]".$divisa.$progreso."[/color]/".$divisa.$minimo."[/b]";
	}else if ($porcentaje > 30 && $porcentaje <= 40){
		$cod = "[img]$IMAGENES/barra_progreso/30-40.gif[/img]";
		$cod .= "[b][color=orange]".$divisa.$progreso."[/color]/".$divisa.$minimo."[/b]";
	}else if ($porcentaje > 40 && $porcentaje <= 50){
		$cod = "[img]$IMAGENES/barra_progreso/40-50.gif[/img]";
		$cod .= "[b][color=orange]".$divisa.$progreso."[/color]/".$divisa.$minimo."[/b]";
	}else if ($porcentaje > 50 && $porcentaje <= 60){
		$cod = "[img]$IMAGENES/barra_progreso/50-60.gif[/img]";
		$cod .= "[b][color=orange]".$divisa.$progreso."[/color]/".$divisa.$minimo."[/b]";
	}else if ($porcentaje > 60 && $porcentaje <= 70){
		$cod = "[img]$IMAGENES/barra_progreso/60-70.gif[/img]";
		$cod .= "[b][color=orange]".$divisa.$progreso."[/color]/".$divisa.$minimo."[/b]";
	}else if ($porcentaje > 70 && $porcentaje <= 80){
		$cod = "[img]$IMAGENES/barra_progreso/70-80.gif[/img]";
		$cod .= "[b][color=green]".$divisa.$progreso."[/color]/".$divisa.$minimo."[/b]";
	}else if ($porcentaje > 80 && $porcentaje <= 90){
		$cod = "[img]$IMAGENES/barra_progreso/80-90.gif[/img]";
		$cod .= "[b][color=green]".$divisa.$progreso."[/color]/".$divisa.$minimo."[/b]";
	}else{
		$cod = "[img]$IMAGENES/barra_progreso/90-99.gif[/img]";
		$cod .= "[b][color=green]".$divisa.$progreso."[/color]/".$divisa.$minimo."[/b]";
	}
	
	return $cod;
}


function dias_diferencia($fecha1,$fecha2){
	$sql2 = "SELECT DATEDIFF('".$fecha1."','".$fecha2."') AS diferencia";
	$res2 = mysql_query($sql2) or die (mysql_error());
	$fila2 = mysql_fetch_array($res2);
	return $fila2['diferencia'];
}

$miembros_1 = 5;
$miembros_2 = 10;
$miembros_3 = 20;
$c_ad_1 = 0.5;
$c_ad_2 = 0.9;
$c_ad_3 = 1.5;
$ads_dia_1 = 3;
$ads_dia_2 = 7;
$ads_dia_3 = 15;
$porc_1 = 26;
$porc_2 = 51;
$porc_3 = 101;





/*----------------------	FIN DE FUNCIONES Y VARIABLES ---------------------------------*/

$sql = "SELECT * FROM $TABLA_EMPRESAS"; 
if ($_POST['tipo'] == 'segura')
	$sql .= " WHERE $ESTADO='segura'";
else if ($_POST['tipo'] == 'antiscam')
	$sql .= " WHERE $ESTADO='antiscam'";
else if ($_POST['tipo'] == 'scam')
	$sql .= " WHERE $ESTADO='scam'";
$sql .= " ORDER BY $FECHA_LANZAMIENTO DESC";
$res = mysql_query($sql) or die (mysql_error());


switch ($_POST['tipo']){
/*--------------------------GEN_SEGURAS---------------------------------*/
/*-----------------------------------------------------------------------------*/
	case 'segura':
		$enlace = $phpbb_url_path."viewtopic.php?f=25&t=3";
		$cod1 = "Para apuntarte a cada empresa, haz click sobre el nombre de ella. Puedes ordenar la tabla según el criterio que te apetezca pulsando sobre las cabeceras. Una vez registrado en todas las que desees, anúncialo por favor en [url=http://www.sindicatoclicks.net/foro/viewtopic.php?t=16]este hilo[/url] para que vayamos tomando nota y así añadírtelas en tu [url=http://www.sindicatoclicks.net/gestion/]área personal[/url]. Gracias.
		
		
		";
		$cod2 = "[b][color=#FF8000]CUENTAS PREMIUMS[/color][/b][choosescript=http://www.sindicatoclicks.net/files/javascripts/sorttable.js][/choosescript] [table][tr][td]nombre[/td][td=#004000]#refs[/td][td=#004000]@Sind[/td][td=#004000]div[/td]       [td=#004000]cobrado[/td][td=#004000]c/ad[/td][td=#004000]ads/día[/td][td=#004000]% ref[/td][td]agregada[/td][/tr]"; 
		$cod3 = "[color=#FF8000][b]CUENTAS FREE[/b][/color]
[choosescript=http://www.sindicatoclicks.net/files/javascripts/sorttable.js][/choosescript][table][tr][td]nombre[/td][td=#004000]#refs[/td][td=#004000]@Sind[/td][td=#004000]div[/td][td=#004000]cobrado[/td][td=#004000]c/ad[/td][td=#004000]ads/día[/td][td=#004000]% ref[/td][td]agregada[/td][/tr]";  
		while($fila = mysql_fetch_array($res)){
			$divisa = dec_utf8($fila[$DIVISA]);
			$n_miembros = total_empresa($fila[$ID],'n_miembros');
			$n_externos = $fila[$NUM_REFS_EXTERNOS];
			$n_total = $n_miembros + $n_externos;
			$n_sind = $n_total - $n_externos;
			$total_cobrado = total_cobrado($fila[$ID]);
			if ($fila[$PREMIUM] == 1)
				$cod2 .= "[tr][td][url=".$fila[$LINK_REGISTRO]."][b]".$fila[$NOMBRE_DE_EMPRESA]."[/b][/url][/td][tdright][b]".elegir_color($n_total,$miembros_1,$miembros_2,$miembros_3)."[/b][/td][tdright][b]".elegir_color($n_sind,$miembros_1,$miembros_2,$miembros_3)."[/b][/td][tdcenter][b]".elegir_color($divisa,0,0,0)."[/b][/td][tdright][url=".$fila[$LINK_COMPROBANTES_PAGO]."][b]".$divisa.$total_cobrado."[/b][/url][/td][tdright][b]".elegir_color($fila[$C_AD_PROPIO],$c_ad_1,$c_ad_2,$c_ad_3)."[/b][/td][tdright][b]".elegir_color($fila[$ADS_DIA],$ads_dia_1,$ads_dia_2,$ads_dia_3)."[/b][/td][tdright][b]".elegir_color($fila[$PORCENTAJE_REFS],$porc_1,$porc_2,$porc_3).color_porc($fila[$PORCENTAJE_REFS],$porc_1,$porc_2,$porc_3)."[/b][/td][td]".$fila[$FECHA_LANZAMIENTO]."[/td][/tr]";
			else
				$cod3 .= "[tr][td][url=".$fila[$LINK_REGISTRO]."][b]".$fila[$NOMBRE_DE_EMPRESA]."[/b][/url][/td][tdright][b]".elegir_color($n_total,$miembros_1,$miembros_2,$miembros_3)."[/b][/td][tdright][b]".elegir_color($n_sind,$miembros_1,$miembros_2,$miembros_3)."[/b][/td][tdcenter][b]".elegir_color($divisa,0,0,0)."[/b][/td][tdright][url=".$fila[$LINK_COMPROBANTES_PAGO]."][b]".$divisa.$total_cobrado."[/b][/url][/td][tdright][b]".elegir_color($fila[$C_AD_PROPIO],$c_ad_1,$c_ad_2,$c_ad_3)."[/b][/td][tdright][b]".elegir_color($fila[$ADS_DIA],$ads_dia_1,$ads_dia_2,$ads_dia_3)."[/b][/td][tdright][b]".elegir_color($fila[$PORCENTAJE_REFS],$porc_1,$porc_2,$porc_3).color_porc($fila[$PORCENTAJE_REFS],$porc_1,$porc_2,$porc_3)."[/b][/td][td]".$fila[$FECHA_LANZAMIENTO]."[/td][/tr]";
		}
			$cod2 .= "[/table]
			
			";
			$cod3 .= "[/table]";
			$cod = $cod1.$cod2.$cod3;
		break;

/*--------------------------GEN_ANTISCAM---------------------------------*/
/*-----------------------------------------------------------------------------*/
	case 'antiscam':
		$enlace = $phpbb_url_path."viewtopic.php?f=25&t=4";
		$cod1 = "Para apuntarte a cada empresa, haz click sobre el nombre de ella. [b]No olvides poner en cada una como tu nombre de usuario el mismo nick con que te registraste en el sindicato[/b]. Una vez registrado en todas las que desees, anúncialo por favor en [url=http://www.sindicatoclicks.net/foro/viewtopic.php?t=16]este hilo[/url] para que vayamos tomando nota. 
ACLARACION: Una vez q se pide el pago en una ptc, se pasa la información al post [url=http://www.sindicatoclicks.net/foro/viewtopic.php?f=25&t=61]PAGOS PEDIDOS[/url] por lo q el progreso en esa ptc vuelve a cero para contabilizar los datos para el 2do. pago.
En caso de que la ptc pague pasará a la [url=http://www.sindicatoclicks.net/foro/viewtopic.php?f=25&t=3]lista de cuentas seguras[/url].
Gracias.


		";
		$cod2 = "[b][color=#FF8000]Pagan por PAYPAL[/color][/b]
[choosescript=http://www.sindicatoclicks.net/files/javascripts/sorttable.js][/choosescript] [table][tr][td]nombre[/td] [td]#refs[/td]  [td]@Sind[/td]  [td]div[/td]  [td]progreso[/td]  [td]c/ad[/td]  [td]ads/día[/td]  [td]% ref[/td][td]agregada[/td][/tr]";
		$cod3 = "[b][color=#FF8000]Pagan por ALERTPAY[/color][/b][choosescript=http://www.sindicatoclicks.net/files/javascripts/sorttable.js][/choosescript] [table][tr][td]nombre[/td] [td]#refs[/td] [td]@Sind[/td]  [td]div[/td]  [td]progreso[/td]  [td]c/ad[/td]  [td]ads/día[/td]  [td]% ref[/td][td]agregada[/td][/tr] ";  
		$cod4 = "[b][color=#FF8000]Pagan por otros medios: E-GOLD/ CHEQUE/TRANSF.BANCARIA[/color][/b]
[choosescript=http://www.sindicatoclicks.net/sorttable.js][/choosescript] [table][tr][td]nombre[/td] [td]#refs[/td] [td]@Sind[/td][td]div[/td]  [td]progreso[/td]  [td]c/ad[/td]  [td]ads/día[/td]  [td]% ref[/td][td]agregada[/td][/tr]"; 
		while($fila = mysql_fetch_array($res)){
			$divisa = dec_utf8($fila[$DIVISA]);
			$n_miembros = total_empresa($fila[$ID],'n_miembros');
			$n_externos = $fila[$NUM_REFS_EXTERNOS];
			$n_total = $n_miembros + $n_externos;
			$n_sind = $n_total - $n_externos;
			$total_cobrado = total_cobrado($fila[$ID]);
			if ($fila[$METODO_DE_PAGO] == 'paypal')
				$cod2 .= "[tr][td][url=".$fila[$LINK_REGISTRO]."][b]".$fila[$NOMBRE_DE_EMPRESA]."[/b][/url][/td][tdright][b]".elegir_color($n_total,$miembros_1,$miembros_2,$miembros_3)."[/b][/td][tdright][b]".elegir_color($n_sind,$miembros_1,$miembros_2,$miembros_3)."[/b][/td][tdcenter][b]".elegir_color($divisa,0,0,0)."[/b][/td][tdleft]".barra_progreso($fila[$PROGRESO],$fila[$MINIMO],$divisa)."[/td][tdright][b]".elegir_color($fila[$C_AD_PROPIO],$c_ad_1,$c_ad_2,$c_ad_3)."[/b][/td][tdright][b]".elegir_color($fila[$ADS_DIA],$ads_dia_1,$ads_dia_2,$ads_dia_3)."[/b][/td][tdright][b]".elegir_color($fila[$PORCENTAJE_REFS],$porc_1,$porc_2,$porc_3).color_porc($fila[$PORCENTAJE_REFS],$porc_1,$porc_2,$porc_3)."[/b][/td][td]".$fila[$FECHA_LANZAMIENTO]."[/td][/tr]";
			else if ($fila[$METODO_DE_PAGO] == 'alertpay')
				$cod3 .= "[tr][td][url=".$fila[$LINK_REGISTRO]."][b]".$fila[$NOMBRE_DE_EMPRESA]."[/b][/url][/td][tdright][b]".elegir_color($n_total,$miembros_1,$miembros_2,$miembros_3)."[/b][/td][tdright][b]".elegir_color($n_sind,$miembros_1,$miembros_2,$miembros_3)."[/b][/td][tdcenter][b]".elegir_color($divisa,0,0,0)."[/b][/td][tdleft]".barra_progreso($fila[$PROGRESO],$fila[$MINIMO],$divisa)."[/td][tdright][b]".elegir_color($fila[$C_AD_PROPIO],$c_ad_1,$c_ad_2,$c_ad_3)."[/b][/td][tdright][b]".elegir_color($fila[$ADS_DIA],$ads_dia_1,$ads_dia_2,$ads_dia_3)."[/b][/td][tdright][b]".elegir_color($fila[$PORCENTAJE_REFS],$porc_1,$porc_2,$porc_3).color_porc($fila[$PORCENTAJE_REFS],$porc_1,$porc_2,$porc_3)."[/b][/td][td]".$fila[$FECHA_LANZAMIENTO]."[/td][/tr]";
			else
				$cod4 .= "[tr][td][url=".$fila[$LINK_REGISTRO]."][b]".$fila[$NOMBRE_DE_EMPRESA]."[/b][/url][/td][tdright][b]".elegir_color($n_total,$miembros_1,$miembros_2,$miembros_3)."[/b][/td][tdright][b]".elegir_color($n_sind,$miembros_1,$miembros_2,$miembros_3)."[/b][/td][tdcenter][b]".elegir_color($divisa,0,0,0)."[/b][/td][tdleft]".barra_progreso($fila[$PROGRESO],$fila[$MINIMO],$divisa)."[/td][tdright][b]".elegir_color($fila[$C_AD_PROPIO],$c_ad_1,$c_ad_2,$c_ad_3)."[/b][/td][tdright][b]".elegir_color($fila[$ADS_DIA],$ads_dia_1,$ads_dia_2,$ads_dia_3)."[/b][/td][tdright][b]".elegir_color($fila[$PORCENTAJE_REFS],$porc_1,$porc_2,$porc_3).color_porc($fila[$PORCENTAJE_REFS],$porc_1,$porc_2,$porc_3)."[/b][/td][td]".$fila[$FECHA_LANZAMIENTO]."[/td][/tr]";
		}
			$cod2 .= "[/table]
			
			";
			$cod3 .= "[/table]
			
			";
			$cod4 .= "[/table]";
			$cod = $cod1.$cod2.$cod3.$cod4;
		break;


/*--------------------------GEN_SCAM---------------------------------*/
/*-----------------------------------------------------------------------------*/
	case 'scam':
		$enlace = $phpbb_url_path."viewtopic.php?f=25&t=5";
		$cod1 = "empresas que han fracasado/timado o no funcionan correctamente

[choosescript=http://www.sindicatoclicks.net/files/javascripts/sorttable.js][/choosescript][table][tr][td][color=orange][b]PTC/PTR[/b][/color][/td][td][color=orange][b]Causa/Motivo[/b][/color][/td] [td][color=orange][b]Prueba de Scam[/b][/color][/td][/tr]";

		while($fila = mysql_fetch_array($res)){
			$causa = dec_utf8($fila[$CAUSA_DE_SCAM]);
			$cod2 .= "[tr][td][color=#0080BF][b]".$fila[$NOMBRE_DE_EMPRESA]."[/b][/color][/td][tdright][b]".elegir_color2($fila[$GRAVEDAD_SCAM],$causa)."[/b][/td][tdright][url=".$fila[$PRUEBA_DE_SCAM]."][b]<<Comprobar>>[/b][/url][/td][/tr]";
		}
			$cod2 .= "[/table]";
			$cod = $cod1.$cod2;
		break;
	
		
/*--------------------------GEN_TIEMPOS_PAGOS---------------------------------*/
/*-----------------------------------------------------------------------------*/		
	case 'tiempos_pagos':
		$enlace = $phpbb_url_path."viewtopic.php?f=25&t=61";
		$cod1 = "Debido a la demora en algunos pagos en las ptc, hicimos esta tabla para q vean cuales son los pagos q tenemos recibidos y pendientes de cobro.
De este modo una vez pedido el pago en una ptc se pasa la información a esta tabla y el progreso en la lista de anti-scams vuelve a cero para el 2do pedido en dicha ptc.

weno espero se entienda y cualq duda o sugerencia, lo postean aqui.

";

		$cod2 = "[b][color=green]Pagos recibidos[/color][/b]
[choosescript=http://www.sindicatoclicks.net/files/javascripts/sorttable.js][/choosescript][table][tr][td][color=#FF8000][b]PTC/PTR[/b][/color][/td] [td][color=#FF8000][b]Pago nº[/b][/color][/td][td][color=#FF8000][b]Importe[/b][/color][/td][td][color=#FF8000][b]Pedido[/b][/color][/td][td][color=#FF8000][b]Recibido[/b][/color][/td][td][color=#FF8000][b]Demora (días)[/b][/color][/td][/tr]";
		$cod3 = "[b][color=orange]Pagos pedidos[/color][/b]
[choosescript=http://www.sindicatoclicks.net/files/javascripts/sorttable.js][/choosescript][table][tr][td][color=#FF8000][b]PTC/PTR[/b][/color][/td] [td][color=#FF8000][b]Pago nº[/b][/color][/td][td][color=#FF8000][b]Importe[/b][/color][/td][td][color=#FF8000][b]Pedido[/b][/color][/td][/tr]";
		
		$sql = "SELECT $TABLA_EMPRESAS.$NOMBRE_DE_EMPRESA,$TABLA_EMPRESAS.$DIVISA,$TABLA_EMPRESAS.$ID,$TABLA_TIEMPOS_PAGOS.$NUMERO_P,$TABLA_TIEMPOS_PAGOS.$FECHA_DE_PEDIDO,$TABLA_TIEMPOS_PAGOS.$FECHA_DE_COBRO,$TABLA_TIEMPOS_PAGOS.$CANTIDAD,$TABLA_TIEMPOS_PAGOS.$LINK_COMPROBANTE FROM $TABLA_TIEMPOS_PAGOS INNER JOIN $TABLA_EMPRESAS ON $TABLA_TIEMPOS_PAGOS.$ID_EMPRESA=$TABLA_EMPRESAS.$ID ORDER BY $FECHA_DE_COBRO DESC";
		$res = mysql_query($sql) or die (mysql_error());
		while($fila = mysql_fetch_array($res)){
			$divisa = dec_utf8($fila[$DIVISA]);
			//$total_cobrado = total_cobrado($fila[$ID]);
			$diferencia = dias_diferencia($fila[$FECHA_DE_COBRO],$fila[$FECHA_DE_PEDIDO]);

		$cod2 .= "[tr][td][color=#0080BF][b]".$fila[$NOMBRE_DE_EMPRESA]."[/b][/color][/td][tdright][b]".$fila[$NUMERO_P]."[/b][/td][tdright][url=".$fila[$LINK_COMPROBANTE]."][b]".$divisa.$fila[$CANTIDAD]."[/b][/url][/td][tdright][b]".$fila[$FECHA_DE_PEDIDO]."[/b][/td][tdright][b]".$fila[$FECHA_DE_COBRO]."[/b][/td][tdright][b]".$diferencia."[/b][/td][/tr]";
		}
		$cod2 .= "[/table]
			
			";
			
		$sql = "SELECT $ID,$NOMBRE_DE_EMPRESA,$DIVISA,$CANTIDAD_PEDIDO,$FECHA_PAGO_PEDIDO FROM $TABLA_EMPRESAS WHERE $PAGO_PEDIDO=1 ORDER BY $FECHA_PAGO_PEDIDO DESC";
		$res = mysql_query($sql) or die (mysql_error());
		while($fila = mysql_fetch_array($res)){
			$divisa = dec_utf8($fila[$DIVISA]);
			$sql2 = "SELECT $ID FROM $TABLA_TIEMPOS_PAGOS WHERE $ID_EMPRESA=".$fila[$ID];
			$res2 = mysql_query($sql2) or die (mysql_error());
			$count = mysql_num_rows($res2);
			$count++;
			$cod3 .= "[tr][td][color=#0080BF][b]".$fila[$NOMBRE_DE_EMPRESA]."[/b][/color][/td][tdright][b]".$count."[/b][/td][tdright][b]".$divisa.$fila[$CANTIDAD_PEDIDO]."[/b][/td][tdright][b]".$fila[$FECHA_PAGO_PEDIDO]."[/b][/td][/tr]";
		}
		$cod3 .= "[/table]";
			
		$cod = $cod1.$cod2.$cod3;
		break;
}?>	


<link rel="STYLESHEET" type="text/css" href="/gestion/modulos/css/gen_tabla.css">

<div id="gen_tabla">
<div class="titulo">Generador de tablas en BBCODE</div>

<div class="cuadro">
<form action="<? $_SERVER['PHP_SELF']; ?>" method="post">
<div class="cuadro1">
Elige tipo de tabla a generar:
	<select name="tipo" onchange='this.form.submit()'> 
	<option value="null" selected></option>
	<option value="segura">Seguras</option>
	<option value="antiscam">Antiscam</option>
	<option value="scam">Scam</option>
	<option value="tiempos_pagos">Tiempos de pago</option>
	</select>
</form>
</div><?
if (isset($_POST['tipo'])){?>
	<div class="cuadro2">
		Código para la tabla: 
		<a href="<? echo "$enlace";?>" target="_blank"><? echo "$_POST[tipo]";?></a>
	</div><?
}?>
	<div class="cuadro3">
		<textarea rows="10" cols="50"><?
		echo "$cod";?>
		</textarea>
	</div>
</div>