<?
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
?>
