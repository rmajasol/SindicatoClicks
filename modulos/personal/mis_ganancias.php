<?
if(isset($_GET['about'])){?>
	<div id="hpagos"><?
		include("./modulos/personal/mis_ganancias/historial_pagos.php");?>
	</div><?
}else{?>
	<div id="submenu">
	<table id="tabla"><tr><td class="t0">
		<a href="?mod=ganancias&about=historial">Ver historial de pagos</a>
	</td></tr></table>
	</div>

	<table id="tabla">
		<tr>
			<td><a href="?mod=ganancias&tipo=ptcs">Ver PTCs</a></td>
			<td><a href="?mod=ganancias&tipo=extras">Ver extras</a></td>
		</tr>
	</table><?

	switch ($_GET['tipo']){
		case 'ptcs':
			include("./modulos/personal/mis_ganancias/tabla_ptcs.php");
			break;
		case 'extras':
			include("./modulos/personal/mis_ganancias/tabla_extras.php");
			break;
		default:
			include("./modulos/personal/mis_ganancias/tabla_ptcs.php");
	}
}?>

