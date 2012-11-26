<h2 align="center">Usuario: <span class="Estilo2"><? echo "$_GET[n]";?></span>&nbsp; &nbsp; &nbsp;<a href="./" class="Estilo1">[Volver]</a></h2>
<table border="1" align="center" cellpadding="5">
	<tr>
		<td><a href="?mod=ver_usuario&n=<? echo "$_GET[n]";?>&action=add_empresa">Añadirle empresa</a></td>	
		<td><a href="?mod=ver_usuario&n=<? echo "$_GET[n]";?>&action=ver_sus_empresas">Ver empresas</a></td>
		<td><a href="?mod=ver_usuario&n=<? echo "$_GET[n]";?>&action=cargar_screens">Cargar screens</a></td>
		<td><a href="?mod=ver_usuario&n=<? echo "$_GET[n]";?>&action=cargar_extras">Cargar extras</a></td>
		<td><a href="?mod=ver_usuario&n=<? echo "$_GET[n]";?>&action=editar_perfil">Editar perfil</a></td>
		<td><a href="?mod=ver_usuario&n=<? echo "$_GET[n]";?>&action=historial_pagos">Historial de pagos</a></td>
	</tr>
</table><center><?
switch ($_GET['action']){
	case 'add_empresa':
		include("usuario/add_empresa2.php");
		include("usuario/add_empresa.php");
		break;
	case 'ver_sus_empresas':
		include("usuario/ver_sus_empresas.php");
		break;
	case 'cargar_screens':
		include("usuario/cargar_screens.php");
		break;
	case 'cargar_extras':
		include("usuario/cargar_extras.php");
		break;
	case 'editar_perfil':
		include("usuario/editar_perfil.php");
		break;	
	case 'historial_pagos':
		include("usuario/historial_pagos.php");
		break;	
}?>
</center>