<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /><?php

// función conectar que se conecta a MySQL y devuelve el identificador de conexión


function db_consulta($query){
	$con = conectar();
	$res = mysql_query($query) or die(mysql_error());
	$fila = mysql_fetch_array($res);
	mysql_close($con);
	
	return $fila;
}

function db_accion($query){
	$con = conectar();
	$res = mysql_query($query) or die(mysql_error());
	mysql_close($con);
}
	
function elegirScript($script){
	echo "<script type='text/javascript' src='./files/javascripts/$script'></script>";
}

function elegirDisenioTabla($diseño){
	echo "<link rel='stylesheet' href='/estilos_tabla/".$diseño.".css' type='text/css' />";
}

// color para los ads/día, cent/ad, %ref...
function elegir_color($valor,$v1,$v2,$v3){
	if ($valor <= $v1)
		$color = "FF0000";
	else if ($v1 <= $valor & $valor <= $v2)
		$color = "FF7F24";
	else if ($v2 <= $valor & $valor <= $v3)
		$color = "009900";
	else if ($v3 <= $valor)
		$color = "66CC00";
	$cod = "<span style='color:#".$color."; font-weight:bold'>".$valor."</span>";
	
	return $cod;
}

//esto es para elegir el color de causa de SCAM
function elegir_color2($valor,$txt){
	switch ($valor){
		case 'baja':
			$color = "CDCD00";
			break;
		case 'media':
			$color = "FF7F24";
			break;
		case 'alta':
			$color = "FF0000";
			break;
	}
	$cod = "<span style='color:#$color; font-weight:bold'>$txt</span>";
	
	return $cod;
}

//para el color del %
function color_porc($valor,$v1,$v2,$v3){
	if ($valor <= $v1)
		$color = "FF0000";
	else if ($v1 <= $valor & $valor <= $v2)
		$color = "FF7F24";
	else if ($v2 <= $valor & $valor <= $v3)
		$color = "009900";
	else if ($v3 <= $valor)
		$color = "66CC00";
	$cod = "<span style='color:#$color; font-weight:bold'>%</span>";
	
	return $cod;
}

function barra_progreso($progreso,$minimo){
	$porcentaje = round((100*$progreso)/$minimo);
	if ($porcentaje <= 10){
		$cod = "<span style='color:#FF0000; font-weight:bold'>$progreso</span>";
		$cod .= "<img title='$porcentaje' border='0' src='./files/images/barra_progreso/00-10.gif' />";
	}else if ($porcentaje > 10 && $porcentaje <= 20){
		$cod = "<span style='color:#FF0000; font-weight:bold'>$progreso</span>";
		$cod .= "<img title='$porcentaje' border='0' src='./files/images/barra_progreso/10-20.gif' />";	
	}else if ($porcentaje > 20 && $porcentaje <= 30){
		$cod = "<span style='color:#FF0000; font-weight:bold'>$progreso</span>";
		$cod .= "<img title='$porcentaje' border='0' src='./files/images/barra_progreso/20-30.gif' />";
	}else if ($porcentaje > 30 && $porcentaje <= 40){
		$cod = "<span style='color:#FF7F24; font-weight:bold'>$progreso</span>";
		$cod .= "<img title='$porcentaje' border='0' src='./files/images/barra_progreso/30-40.gif' />";
	}else if ($porcentaje > 40 && $porcentaje <= 50){
		$cod = "<span style='color:#FF7F24; font-weight:bold'>$progreso</span>";
		$cod .= "<img title='$porcentaje' border='0' src='./files/images/barra_progreso/40-50.gif' />";
	}else if ($porcentaje > 50 && $porcentaje <= 60){
		$cod = "<span style='color:#FF7F24; font-weight:bold'>$progreso</span>";
		$cod .= "<img title='$porcentaje' border='0' src='./files/images/barra_progreso/50-60.gif' />";
	}else if ($porcentaje > 60 && $porcentaje <= 70){
		$cod = "<span style='color:#FF7F24; font-weight:bold'>$progreso</span>";
		$cod .= "<img title='$porcentaje' border='0' src='./files/images/barra_progreso/60-70.gif' />";
	}else if ($porcentaje > 70 && $porcentaje <= 80){
			$cod = "<span style='color:#009900; font-weight:bold'>$progreso</span>";
		$cod .= "<img title='$porcentaje' border='0' src='./files/images/barra_progreso/70-80.gif' />";
	}else if ($porcentaje > 80 && $porcentaje <= 90){
		$cod = "<span style='color:#009900; font-weight:bold'>$progreso</span>";
		$cod .= "<img title='$porcentaje' border='0' src='./files/images/barra_progreso/80-90.gif' />";
	}else{
		$cod = "<span style='color:#66CC00; font-weight:bold'>$progreso</span>";
		$cod .= "<img title='$porcentaje' border='0' src='./files/images/barra_progreso/90-99.gif' />";
	}
	
	return $cod;
}

function simbolo_divisa($divisa){
	switch($divisa){
		case 'dolar':
			return '$';
			break;
		case 'euro':
			return '&euro;';
			break;
	}
}

//devuelve una parte de la fecha en formato DATE
function print_fecha($fecha,$parte){
	switch($parte){
		case 'año':
			return substr($fecha,0,4);
			break;
		case 'mes':
			return substr($fecha,5,2);
			break;
		case 'dia':
			return substr($fecha,8,2);
			break;
	}	
}

function form_comp_fecha($año,$mes,$dia,$nombre){?>
	<select name="f_año_<? echo "$nombre";?>"><?
	for($i=2007;$i<=2010;$i++){
		if($i == $año){?>
			<option value="<? echo "$i";?>" selected><? echo "$i";?></option><?
		}else{?>
			<option value="<? echo "$i";?>"><? echo "$i";?></option><?
		}
	}?>
	</select>-
	<select name="f_mes_<? echo "$nombre";?>"><?
	for($i=1;$i<=12;$i++){
		if($i == $mes){?>
			<option value="<? echo "$i";?>" selected><? echo "$i";?></option><?
		}else{?>
			<option value="<? echo "$i";?>"><? echo "$i";?></option><?
		}
	}?>
	</select>-
	<select name="f_dia_<? echo "$nombre";?>"><?
	for($i=1;$i<=31;$i++){
		if($i == $dia){?>
			<option value="<? echo "$i";?>" selected><? echo "$i";?></option><?
		}else{?>
			<option value="<? echo "$i";?>"><? echo "$i";?></option><?
		}
	}?>
	</select><?
}


function icono_minimo_alcanzado($progreso,$minimo){
	$res = ($progreso >= $minimo) ? "<img border='0' src='http://www.sindicatoclicks.net/images/icons/emblem-important.png'>" : '';
	echo "$res";
}

function form_pais($pais){?>
	<select name="pais"><?
		if(pais_en_lista($pais) == 0){?>
			<option value="null" selected></option><?
		}else{?>
			<option value="null"></option><?
		}
		if ($pais == 'Argentina'){?>
			<option value="Argentina" selected>Argentina</option><?
		}else{?>
			<option value="Argentina">Argentina</option><?
		}
		if ($pais == 'Chile'){?>
			<option value="Chile" selected>Chile</option><?
		}else{?>
			<option value="Chile">Chile</option><?
		}
		if ($pais == 'España'){?>
			<option value="España" selected>Espa&ntilde;a</option><?
		}else{?>
			<option value="España">Espa&ntilde;a</option><?
		}?>
	</select><br /><?
	if(pais_en_lista($pais) == 0){?>
		OTRO: <input type="text" name="otro_pais" value="<? echo "$pais";?>"/><?
	}else{?>
		OTRO: <input type="text" name="otro_pais"/><?
	}
}

function form_estilo_tabla($estilo){?>
	<select name="estilo_tabla"><?
		switch ($estilo){
			case 'stainlesssteel':?>
				<option value="stainlesssteel" selected>Stainless Steel</option><?
				break;
			default:?>
				<option value="stainlesssteel" selected>Stainless Steel</option><?
		}?>
	</select><?
}


function pais_en_lista($pais){
	$res = 0;
	switch($pais){
		case 'Argentina':
			$res = 1;
		case 'Chile':
			$res = 1;
		case 'España':
			$res = 1;
	}
	return $res;
}

function enc_utf8($txt){
	$res = utf8_encode($txt);
	return $res;
}

function dec_utf8($txt){
	$res = utf8_decode($txt);
	return $res;
}

function redondear_dos_decimal($valor) {
   $float_redondeado=round($valor * 100) / 100;
   return $float_redondeado;
} 

function calcular_n_miembros($id){
	global $ID_EMPRESA,$ID,$TABLA_PAGOS;
	$orden = "SELECT $ID_EMPRESA FROM $TABLA_PAGOS WHERE $ID_EMPRESA=".$id;
	$pet = mysql_query($orden) or die (mysql_error());
	$num = $count = mysql_num_rows($pet);
	
	return $num;
}

function conv_euro_a_dolar($cantidad){
	global $TASA_E_D;
	$total = $cantidad*$TASA_E_D;
		
	return $total;
}  

function total_empresa($id,$tipo){
	global $ID,$ID_EMPRESA,$TABLA_PAGOS,$PAGADO,$COMISION;
	$orden = "SELECT";
	switch ($tipo){
		case 'n_miembros':
			$orden .= " $ID";
			break;
		case 'pagado':
			$orden .= " $PAGADO"; 
			$campo = $PAGADO;
			break;
		case 'comision':
			$orden .= " $COMISION"; 
			$campo = $COMISION;
	}
	$orden .= " FROM $TABLA_PAGOS WHERE $ID_EMPRESA=".$id;
	$pet = mysql_query($orden) or die (mysql_error());
	if ($tipo == 'n_miembros'){
		$num = mysql_num_rows($pet);
	
		return $num;
	}else{
		$total = 0;
		while($r = mysql_fetch_array($pet))
			$total += $r[$campo];
			
		return $total;
	}
} 

function total_cobrado($id){
	global $ID_EMPRESA,$CANTIDAD,$TABLA_TIEMPOS_PAGOS;
	$orden = "SELECT $CANTIDAD FROM $TABLA_TIEMPOS_PAGOS WHERE $ID_EMPRESA=".$id;
	$pet = mysql_query($orden) or die (mysql_error());
	$total = 0;
	while($r = mysql_fetch_array($pet))
		$total += $r[$CANTIDAD];
			
	return $total;
} 

function empresa_usuario($id_e,$id_u,$tipo){
	global $ID_EMPRESA,$ID_USUARIO,$TABLA_PAGOS,$PAGADO,$COMISION;
	$orden = "SELECT";
	switch ($tipo){
		case 'pagado':
			$orden .= " $PAGADO"; 
			$campo = $PAGADO;
			break;
		case 'comision':
			$orden .= " $COMISION"; 
			$campo = $COMISION;
	}
	$orden .= " FROM $TABLA_PAGOS WHERE $ID_EMPRESA=".$id_e." and $ID_USUARIO=".$id_u;
	$pet = mysql_query($orden) or die (mysql_error());
	$r = mysql_fetch_array($pet);
	$total = $r[$campo];
			
	return $total;
} 


function calc_por_pagar_total_e($id_e){
	global $POR_PAGAR,$TABLA_PAGOS,$ID_EMPRESA;
	
	$orden = "SELECT $POR_PAGAR FROM $TABLA_PAGOS WHERE $ID_EMPRESA=".$id_e;
	$pet = mysql_query($orden) or die (mysql_error());
	$total = 0;
	while ($fila = mysql_fetch_array($pet))
		$total += $fila[$POR_PAGAR];
			
	return $total;
} 

function num_cobros($id_empresa){
	global $ID,$TABLA_TIEMPOS_PAGOS,$ID_EMPRESA;

	$ord = "SELECT $ID FROM $TABLA_TIEMPOS_PAGOS WHERE $ID_EMPRESA=".$id_empresa;
	$pet = mysql_query($ord) or die (mysql_error());
	$count = mysql_num_rows($pet);
	
	return $count;
}

function dias_diferencia($fecha1,$fecha2){
	$sql2 = "SELECT DATEDIFF('".$fecha1."','".$fecha2."') AS diferencia";
	$res2 = mysql_query($sql2) or die (mysql_error());
	$fila2 = mysql_fetch_array($res2);
	return $fila2['diferencia'];
}

function segundos_diferencia($ultimos_clicks){
	$actual = date("Y-m-d H:i:s");
	$sql2 = "SELECT TIMEDIFF('".$actual."','".$ultimos_clicks."') AS diferencia";
	$res2 = mysql_query($sql2) or die (mysql_error());
	$fila2 = mysql_fetch_array($res2);
	return $fila2['diferencia'];
}

function estado_inscrip_temp($estado){
	switch($estado){
		case 'no referido':
			return '';
	}
}
?>
