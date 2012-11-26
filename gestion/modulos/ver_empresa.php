Empresa: <? echo "$_GET[n]";?><a href="./">[Volver]</a>
<table border="1" align="center" cellpadding="5">
	<tr>
		<td><a href="?mod=ver_empresa&n=<? echo "$_GET[n]";?>&action=add_usuario">Añadirle usuarios</a></td>	
		<td><a href="?mod=ver_empresa&n=<? echo "$_GET[n]";?>&action=ver_sus_usuarios">Ver usuarios</a></td>	
		<td><a href="?mod=ver_empresa&n=<? echo "$_GET[n]";?>&action=cargar_trabajo">Cargar trabajo</a></td>
		<td><a href="?mod=ver_empresa&n=<? echo "$_GET[n]";?>&action=editar">Editar</a></td>
		<td><a href="?mod=ver_empresa&n=<? echo "$_GET[n]";?>&action=info_de_cobros">Info de cobros</a></td>
	</tr>
</table><center><?
switch ($_GET['action']){
	case 'add_usuario':
		include("empresa/add_usuario2.php");
		include("empresa/add_usuario.php");
		break;
	case 'ver_sus_usuarios':
		include("empresa/ver_sus_usuarios.php");
		break;
	case 'cargar_trabajo':
		include("empresa/cargar_trabajo.php");
		break;
	case 'editar':
		include("empresa/editar.php");
		break;
	case 'info_de_cobros':
		include("empresa/info_de_cobros.php");
		break;
}?>
