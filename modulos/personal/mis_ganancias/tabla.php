<link rel="STYLESHEET" type="text/css" href="/modulos/personal/css/mis_ganancias2.css">
<?
elegirScript("sorttable.js");

$sql = "SELECT $ESTILO_TABLA FROM $TABLA_USUARIOS WHERE $ID=" . $id_usuario;
$res = mysql_query($sql) or die (mysql_error());
$fila = mysql_fetch_array($res);
elegirDisenioTabla($fila[$ESTILO_TABLA]);?>

<table border="1" align="center" cellpadding="5">
	<tr>
		<td><a href="/?mod=ganancias&tipo=ptcs">Ver PTCs</a></td>
		<td><a href="/?mod=ganancias&tipo=extras">Ver extras</a></td>
	</tr>
</table><?

switch ($_GET['tipo']){
	case 'ptcs':
		include("/home/sv000004/public_html/modulos/personal/mis_ganancias/tabla_ptcs.php");
		break;
	case 'extras':
		include("/home/sv000004/public_html/modulos/personal/mis_ganancias/tabla_extras.php");
		break;
	default:
		include("/home/sv000004/public_html/modulos/personal/mis_ganancias/tabla_ptcs.php");
}?>
