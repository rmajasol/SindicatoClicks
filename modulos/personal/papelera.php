<?
//------------ SUBMENU ---------?>
<div id="submenu">
<table border="0" align="center" cellpadding="5">
	<tr>
		<td class="ver"><a href="?mod=papelera&a=ver">Ver papelera</a></td>
		<td class="insertar"><a href="?mod=papelera&a=insertar">Insertar empresa</a></td>
		<td class="quitar"><a href="?mod=papelera&a=quitar">Quitar empresa</a></td>
	</tr>
</table>
</div><?

//------------ TITULO 2 -----------
switch($_GET['a']){
	case 'ver':?>
		<div class="titulo2"><h3>Empresas en papelera</h3></div><?
		break;
	case 'insertar':?>
		<div class="titulo2"><h3>Insertar empresa</h3></div><?
		break;
	case 'quitar':?>
		<div class="titulo2"><h3>Quitar empresa</h3></div><?
		break;
}		

$sql = "SELECT $TABLA_PAGOS.*,$TABLA_EMPRESAS.* FROM $TABLA_EMPRESAS INNER JOIN $TABLA_PAGOS ON $TABLA_PAGOS.$ID_EMPRESA=$TABLA_EMPRESAS.$ID WHERE $TABLA_PAGOS.$ID_USUARIO=" . $id_usuario;
if ($_GET['a'] == 'insertar')
	$sql .= " and $PAPELERA=0";
else
	$sql .= " and $PAPELERA=1";
$sql .= " and $ESTADO!='scam' ORDER BY $NOMBRE_DE_EMPRESA ASC";
$res = mysql_query($sql) or die (mysql_error());	
$count = mysql_num_rows($res);	


switch ($_GET['a']){
	
	//----------- VER EMPRESAS EN PAPELERA -----------	
	case 'ver':?>
		<div id="tabla"><?		
		include("./modulos/personal/papelera/tabla.php");?>
		</div><?
		break;
	
	//----------- INSERTAR EMPRESA EN PAPELERA -----------	
	case 'insertar':
		if (isset($_POST['insertar'])){
			$sql2 = "SELECT $ID FROM $TABLA_EMPRESAS WHERE $NOMBRE_DE_EMPRESA='".$_POST['empresa']."'";
			$res2 = mysql_query($sql2) or die (mysql_error());
			$fila2 = mysql_fetch_array($res2);
			$id_e = $fila2[$ID];
			$sql2 = "UPDATE $TABLA_PAGOS SET $PAPELERA='1' WHERE $ID_EMPRESA=".$id_e." and $ID_USUARIO=".$id_usuario;
			$res2 = mysql_query($sql2) or die (mysql_error());?>
			<div class="cuadro_confirm_ok">Empresa <? echo $_POST[empresa];?> insertada la papelera.</div><?
		}else{
			if ($count > 0){?>
				<table id="insertar">
					<tr>
						<td>Empresa a insertar: <td>
						<td>
							<form action="?mod=papelera&a=insertar" method="post">
								<select name="empresa"><?
								while($fila = mysql_fetch_array($res)){?>
									<option value="<? echo "$fila[$NOMBRE_DE_EMPRESA]";?>"><?
									 echo "$fila[$NOMBRE_DE_EMPRESA]";?></option><?
								}?>
								</select>
								<input type="submit" name="insertar" value="insertar" />
							</form>
						</td>
					</tr>
				</table><?
			}else{?>
				<div class="cuadro_mensaje">No estás suscrito a ninguna empresa para poder agregar en tu papelera</div><?
			}
		}
		break;
		
		
	//----------- QUITAR EMPRESA DE PAPELERA -----------	
	case 'quitar':
		if (isset($_POST['quitar'])){
			$sql2 = "SELECT $ID FROM $TABLA_EMPRESAS WHERE $NOMBRE_DE_EMPRESA='".$_POST['empresa']."'";
			$res2 = mysql_query($sql2) or die (mysql_error());
			$fila2 = mysql_fetch_array($res2);
			$id_e = $fila2[$ID];
			$sql2 = "UPDATE $TABLA_PAGOS SET $PAPELERA='0' WHERE $ID_EMPRESA=".$id_e." and $ID_USUARIO=".$id_usuario;
			$res2 = mysql_query($sql2) or die (mysql_error());?>
			<div class="cuadro_confirm_ok">Empresa <? echo "$_POST[empresa]";?> quitada de la papelera.</div><?
		}else{
		if ($count > 0){?>
			<table id="quitar">
				<tr>
					<td>Empresa a quitar: <td>
					<td>
						<form action="?mod=papelera&a=quitar" method="post">
							<select name="empresa"><?
							while($fila = mysql_fetch_array($res)){?>
								<option value="<? echo "$fila[$NOMBRE_DE_EMPRESA]";?>"><? echo "$fila[$NOMBRE_DE_EMPRESA]";?></option><?
							}?>
							</select>
							<input type="submit" name="quitar" value="Quitar" />
						</form>
					</td>
				</tr>
			</table><?
		}else{?>
			<div class="cuadro_mensaje">No tienes agregada en tu papelera ninguna empresa.</div><?
		}
		}?>
		</div><?
		break;
		
	default:?>
		<div id="tabla"><?		
			include("./modulos/personal/papelera/tabla.php");?>
		</div><?
}//fin de switch?>