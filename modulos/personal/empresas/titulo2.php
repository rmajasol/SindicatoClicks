<h3><?

if (isset($_GET['st'])) {
	switch($_GET['st']){
		case 'espera':?>
			Empresas en espera de confirmación (<? echo "$count2";?>)<?
			break;
		case 'error':?>
			Empresas en las que no apareces como referido (<? echo "$count3";?>)<?
			break;
	}
} else {
	if ($_GET['cat'] != 'mias'){?>
		Otras <?
	}else{?>
		Mis <?
	}?>
	empresas <?
	switch($_GET['estado']){
		case 'segura':?>
			<span class="seguras">seguras </span> <?
			break;
		case 'antiscam':?>
			<span class="antiscam">antiscam </span> <?
			break;
		case 'scam':?>
			<span class="scam">scam! </span> <?
			break;
		default:?>
			<span class="totales">totales </span> <?
	}?>
	(<? echo "$count";?>)<?
}?>

</h3><?		

if ($_GET['cat'] == 'mias' & $count > 0){?>
	<div id="clickear"><div class='boxtop2'><div></div></div><div class="content">
		<span class="boton_clickear"><a href="?mod=clickear">Clickear</a></span><?
		$segundos = segundos_diferencia($ultimos_clicks);?>
		<span class="time">Últimos clicks: [<? echo "$segundos";?>]</span>
		<span class="manual"><a href="./foro/viewtopic.php?f=24&t=143" target="_blank">Manual del clickeador</a></span></div>
	</div>
	<div id="mantener"><div class='boxtop2'><div></div></div><div class="content">
		<span class="boton_mantener"><a href="?mod=mantener">Mantener</a></span><?
		$hoy = date('Y-m-d');
		$dias = dias_diferencia($hoy,$ultimo_mantenimiento);?>
		<span class="time">Última revisión: [<? echo "$dias";?> días]</span></div>
	</div>
	<div id="cheatlinks"><div class='boxtop2'><div></div></div><div class="content">
		<div class="boton_cheatlinks"><a href="./foro/viewtopic.php?f=25&t=205" target="_blank">CHEAT-LINKS</a></div></div>
	</div><?
}?>