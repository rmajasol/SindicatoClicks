function ae_gen_password($silabas, $use_prefix){
    if (!function_exists('ae_arr')){
        function ae_arr(&$arr){
            return $arr[rand(0, sizeof($arr)-1)];
        }
    }
    $prefix = array('aero', 'anti', 'auto', 'bi', 'bio',
                    'cine', 'deca', 'demo', 'contra', 'eco',
                    'ergo', 'geo', 'hipo', 'cent', 'kilo',
                    'mega', 'tera', 'mini', 'nano', 'duo');
    $suffix = array('on', 'ion', 'ancia', 'sion', 'ia',
                    'dor', 'tor', 'sor', 'cion', 'acia'); 
    $vowels = array('a', 'o', 'e', 'i', 'u', 'ia', 'eo'); 
    $consonants = array('r', 't', 'p', 's', 'd', 'f', 'g', 'h', 'j', 
                        'k', 'l', 'z', 'c', 'v', 'b', 'n', 'm', 'qu');
    $password = $use_prefix?ae_arr($prefix):'';
    $password_suffix = ae_arr($suffix);
    for($i=0; $i<$silabas; $i++){
        $doubles = array('c', 'l', 'r');
        $c = ae_arr($consonants);
        if (in_array($c, $doubles)&&($i!=0)){
            if (rand(0, 4) == 1) // 20% de probabiidad
                $c .= $c;
        }
        $password .= $c;
        $password .= ae_arr($vowels);
        if ($i == $silabas - 1) // Si el sufijo empieza con vocal
            if (in_array($password_suffix[0], $vowels)) // Añadimos una consonante
                $password .= ae_arr($consonants);
    }
    $password .= $password_suffix;

    return $password;
}


function drawMenuElegirCuentas($result){
	$a = comprobarAdmin($_COOKIE['user'],$_COOKIE['pass']);?>
<form action=<? echo "$result";?> method="get">
<table border="0" cellpadding="2" align="right">
	<tr>
		<? if ($a == 1){?>
		<td rowspan="2"><a href="insertar.php"><b>[Insertar nuevo registro]</b></a></td>
		<? }?>
		<td><input align="right" type="submit" value="Ver sólo cuentas:"></td>
	</tr>
	<tr>
		<td><select name="cuentas">
					<option value="seguras">seguras</option>
					<option value="antiscam">antiscam</option>
					<option value="scam">scam!</option>
					<option value="mierda">mierda</option>
			</select>
		</td>
	</tr>
</table>
</form>
<? }


function drawProgresoBar($progreso,$minimo){
	global $CARPETA_IMAGENES;
	$porcentaje = round((100*$progreso)/$minimo);
	if ($porcentaje <= 10)
			echo "<td><img alt='$porcentaje%' src='$CARPETA_IMAGENES/progreso/0.gif' align='left'><font class='porcentaje'>$porcentaje%</td>\n";
		else if ($porcentaje > 10 && $porcentaje <= 20)
			echo "<td><img alt='$porcentaje%' src='$CARPETA_IMAGENES/progreso/1.gif' align='left'><font class='porcentaje'>$porcentaje%</td>\n";
		else if ($porcentaje > 20 && $porcentaje <= 30)
			echo "<td><img alt='$porcentaje%' src='$CARPETA_IMAGENES/progreso/2.gif' align='left'><font class='porcentaje'>$porcentaje%</td>\n";
		else if ($porcentaje > 30 && $porcentaje <= 40)
			echo "<td><img alt='$porcentaje%' src='$CARPETA_IMAGENES/progreso/3.gif' align='left'><font class='porcentaje'>$porcentaje%</td>\n";
		else if ($porcentaje > 40 && $porcentaje <= 50)
			echo "<td><img alt='$porcentaje%' src='$CARPETA_IMAGENES/progreso/4.gif' align='left'><font class='porcentaje'>$porcentaje%</td>\n";
		else if ($porcentaje > 50 && $porcentaje <= 60)
			echo "<td><img alt='$porcentaje%' src='$CARPETA_IMAGENES/progreso/5.gif' align='left'><font class='porcentaje'>$porcentaje%</td>\n";
		else if ($porcentaje > 60 && $porcentaje <= 70)
			echo "<td><img alt='$porcentaje%' src='$CARPETA_IMAGENES/progreso/6.gif' align='left'><font class='porcentaje'>$porcentaje%</td>\n";
		else if ($porcentaje > 70 && $porcentaje <= 80)
			echo "<td><img alt='$porcentaje%' src='$CARPETA_IMAGENES/progreso/7.gif' align='left'><font class='porcentaje'>$porcentaje%</td>\n";
		else if ($porcentaje > 80 && $porcentaje <= 90)
			echo "<td><img alt='$porcentaje%' src='$CARPETA_IMAGENES/progreso/8.gif' align='left'><font class='porcentaje'>$porcentaje%</td>\n";
		else
			echo "<td><img alt='$porcentaje%' src='$CARPETA_IMAGENES/progreso/9.gif' align='left'><font class='porcentaje'>$porcentaje%</td>\n";
}


//elegir diseño de tabla
function elegirDisenioTabla($diseño){
	if ($diseño == 'chocolate')
		echo "<link rel='stylesheet' href='http://www.sindicatoclicks.net/styles/chocolate.css' type='text/css' />";
	else if ($diseño == 'blue_gradient')
		echo "<link rel='stylesheet' href='http://www.sindicatoclicks.net/styles/blue_gradient.css' type='text/css' />";
	else
		echo "<link rel='stylesheet' href='http://www.sindicatoclicks.net/styles/default.css' type='text/css' />";
}


function drawMenuDisenioTabla($tabla){?> 
	<form action= <? echo "$tabla";?> method="get">
		<table border="1" cellpadding="2" align="left">
			<tr>
				<td><input align="right" type="submit" value="Escoger diseño"></td>
			</tr>
			<tr>
				<td><select name="diseño">
					<option value="chocolate">chocolate</option>
					<option value="default" selected>default</option>
					<option value="blue_gradient" selected>blue_gradient</option>
				</td>
			</tr>
		</table>
	</form>
<? }


function drawMenuElegirUsuarios($result){?>
	<form action=<? echo "$result";?> method="get">
		<table border="0" cellpadding="2" align="right">
			<tr>
				<td rowspan="2"><a href='http://sindicatoclicks.net'>[Menu principal]</a></td>
				<td><input align="right" type="submit" value="Obtener lista"></td>
			</tr>
			<tr>
				<td><select name="tipo">
						<option value="admin">admins</option>
						<option value="afiliado">afiliados</option>
						<option value="todos">todos</option>
					</select></td>
			</tr>
		</table>
	</form>
<? }


//elegir script a aplicar
function elegirScript($script){
	echo "<script type='text/javascript' src='http://www.sindicatoclicks.net/$script'></script>";
}


function drawElegirAtributos($result){?>
	<form action=<? echo "$result";?> method="post">
		<fieldset>
		
  		<table border="0" cellpadding="2" align="center">
			<legend>Atributos a visionar</legend>
			<tr align="left">
				<td width="75" align="left"><input type="checkbox" name="divisa">divisa<td>
				<td><input type="checkbox" name="mPago">metodo de pago<td>
				<td><input type="checkbox" name="cxclick">cents/click<td>
			</tr>
			<tr>
				<td width="75" align="left"><input type="checkbox" name="cxdia">cents/dia<td>
				<td><input type="checkbox" name="estado">estado<td>
				<td><input type="checkbox" name="ref">ganancia de ref<td>
			</tr>
			<tr align="left">
				<td><input type="checkbox" name="nref">niveles de ref<td>
				<td><input type="checkbox" name="progreso">progreso<td>
				<td><input type="checkbox" name="minimo">minimo<td>
				<td colspan="2"><input type="submit" name="submit"></td>
			</tr>
		</table>
		</fieldset>
	</form>
<? }


function horasDiferencia($anterior, $td_si, $td_no, $horasClick){
	$actual = date("Y-m-d H:i:s");
	$actualDia = substr($actual, 8,2);
	$antDia = substr($anterior, 8,2);
	$ant_hms = substr($anterior, 11,8);
	if ($actualDia == $antDia){
		$sql3 = "SELECT DATE_SUB('$actual',INTERVAL '$ant_hms' HOUR_SECOND)";
		$res3 = mysql_query($sql3) or die (mysql_error());
		while ($fila = mysql_fetch_row($res3))
			$dif = $fila[0];
		$difHoras = substr($dif, 11,2);
		$difMinutos = substr($dif, 14,2);
		$difSegundos = substr($dif, 17,2);
		$horasT = ((($difHoras*3600)+($difMinutos*60)+$difSegundos)/60)/60;
		if ($horasT > $horasClick)
			echo "$td_si";
		else
			echo "$td_no";
	}else{
		$sql3 = "SELECT DATE_SUB('$actual',INTERVAL '$antDia $ant_hms' DAY_SECOND)";
		$res3 = mysql_query($sql3) or die (mysql_error());
		while ($fila = mysql_fetch_row($res3))
			$dif = $fila[0];
		$difDias = substr($dif, 8,2);
		$difHoras = substr($dif, 11,2);
		$difMinutos = substr($dif, 14,2);
		$difSegundos = substr($dif, 17,2);
		$horasT = ((($difDias*24*3600)+($difHoras*3600)+($difMinutos*60)+$difSegundos)/60)/60;
		if ($horasT > $horasClick)
			echo "$td_si";
		else
			echo "$td_no";
	}
}



