<?
if ($admin == 1){

$sql = "SELECT $ID,$TIPO_GESTION FROM $TABLA_EMPRESAS WHERE $NOMBRE_DE_EMPRESA='" . $_GET['n']."'";
$res = mysql_query($sql) or die (mysql_error());
$fila = mysql_fetch_array($res);
$id_empresa = $fila[$ID];
$tipo_gestion = $fila[$TIPO_GESTION];

if (isset($_POST['cargar'])){
	for ($j=0;$j<=$_POST['num'];$j++){
		if ($tipo_gestion == 'a' | $tipo_gestion == 'b'){
			$c1 = "clicks".$j;
			$clicks = $_POST[$c1];
			$c2 = "clicks_pagados".$j;
			$clicks_pagados = $_POST[$c2];
			$c3 = "id".$j;
			$id = $_POST[$c3];
		
			$sql2 = "UPDATE $TABLA_PAGOS SET ";
			$sql2 .= "$CLICKS = '" . $clicks . "', ";
			$sql2 .= "$CLICKS_PAGADOS = '" . $clicks_pagados . "' ";
			$sql2 .= "WHERE $ID=" . $id;
			$res2 = mysql_query($sql2) or die(mysql_error());
		}else{
			$c1 = "ganado_anterior".$j;
			$ganado_anterior = $_POST[$c1];
			$c2 = "ganado_propio".$j;
			$ganado_propio = $_POST[$c2];
			$c3 = "ganado_refs".$j;
			$ganado_refs = $_POST[$c3];
			$c4 = "id".$j;
			$id = $_POST[$c4];
			
			$sql2 = "UPDATE $TABLA_PAGOS SET ";
			$sql2 .= "$GANANCIA_NETA_ANTERIOR = '" . $ganado_anterior . "', ";
			$sql2 .= "$GANADO_PROPIO = '" . $ganado_propio . "', ";
			$sql2 .= "$GANADO_REFS = '" . $ganado_refs . "' ";
			$sql2 .= "WHERE $ID=" . $id;
			$res2 = mysql_query($sql2) or die(mysql_error());
		}
	}?>
	<center>Datos cargados correctamente!</center><?
}

if ($tipo_gestion == 'a' | $tipo_gestion == 'b')
	$sql = "SELECT $TABLA_PAGOS.$ID,$TABLA_PAGOS.$NICK,$TABLA_PAGOS.$CLICKS,$TABLA_PAGOS.$CLICKS_PAGADOS,$TABLA_EMPRESAS.$TIPO_GESTION FROM $TABLA_PAGOS INNER JOIN $TABLA_EMPRESAS ON $TABLA_PAGOS.$ID_EMPRESA=$TABLA_EMPRESAS.$ID WHERE $TABLA_PAGOS.$ID_EMPRESA=".$id_empresa." and $TABLA_EMPRESAS.$TIPO_GESTION!='c' ORDER BY $NICK ASC";
else
	$sql = "SELECT $TABLA_PAGOS.$ID,$TABLA_PAGOS.$ID_USUARIO,$TABLA_PAGOS.$GANANCIA_NETA_ANTERIOR,$TABLA_PAGOS.$GANADO_PROPIO,$TABLA_PAGOS.$GANADO_REFS,$TABLA_EMPRESAS.$TIPO_GESTION FROM $TABLA_PAGOS INNER JOIN $TABLA_EMPRESAS ON $TABLA_PAGOS.$ID_EMPRESA=$TABLA_EMPRESAS.$ID WHERE $TABLA_PAGOS.$ID_EMPRESA=".$id_empresa." and $TABLA_EMPRESAS.$TIPO_GESTION='c' ORDER BY $NICK ASC";
$res = mysql_query($sql) or die (mysql_error());
$count = mysql_num_rows($res);


if ($count > 0){?>

	<table id="tabla">
	<thead><?
		if ($tipo_gestion == 'a' | $tipo_gestion == 'b'){?>
			<tr>
				<th>Nick</th>
				<th>Clicks</th>
				<th colspan="2">Clicks pagados</th>
			</tr><?
		}else{?>
			<tr>
				<th>Usuario</th>
				<th colspan="2">Ya pagado</th>
				<th>Propio</th>
				<th>Refs</th>
			</tr><?
		}?>
	</thead>
	<tbody>
		<form action="/gestion/?mod=ver_empresa&n=<? echo "$_GET[n]";?>&action=cargar_trabajo" method="post"><?
		$i = 0;
		while($fila = mysql_fetch_array($res)){?>
				<tr><?
					if ($tipo_gestion == 'a' | $tipo_gestion == 'b'){?>
					
						<td><? echo "$fila[$NICK]";?></td>
						<td align="right">
							<input name="clicks<? echo "$i";?>" type="text" size="3"  value="<? echo "$fila[$CLICKS]";?>"/>
						</td><?
						if ($_GET['action2'] == 'editar' & $fila[$ID] == $_GET['id']){?>
							<td align="right"><input name="clicks_pagados<? echo "$i";?>" type="text" size="3"  value="<? echo "$fila[$CLICKS_PAGADOS]";?>"/></td><?
						}else{?>
							<input name="clicks_pagados<? echo "$i";?>" type="hidden" value="<? echo "$fila[$CLICKS_PAGADOS]";?>"/>
							<td align="right"><? echo "$fila[$CLICKS_PAGADOS]";?></td>
							<td align="center"><a href="/gestion/?mod=ver_empresa&n=<? echo "$_GET[n]";?>&action=cargar_trabajo&action2=editar&id=<? echo "$fila[$ID]";?>">Editar</a></td><?
						}?>
						<input name="id<? echo "$i";?>" type="hidden" value="<? echo "$fila[$ID]";?>"/><?
						
					}else{
					
						$sql2 = "SELECT $NOMBRE_DE_USUARIO FROM $TABLA_USUARIOS WHERE $ID=".$fila[$ID_USUARIO];
						$res2 = mysql_query($sql2) or die (mysql_error());
						$fila2 = mysql_fetch_array($res2);?>
						<td><a href="/gestion/?mod=ver_usuario&n=<? echo "$fila2[$NOMBRE_DE_USUARIO]";?>"><? echo "$fila2[$NOMBRE_DE_USUARIO]";?></a></td><?
						if ($_GET['action2'] == 'editar' & $fila[$ID] == $_GET['id']){?>
							<td colspan="2" align="center"><input name="ganado_anterior<? echo "$i";?>" type="text" size="7"  value="<? echo "$fila[$GANANCIA_NETA_ANTERIOR]";?>"/></td><?
						}else{?>
							<input name="ganado_anterior<? echo "$i";?>" type="hidden" size="7"  value="<? echo "$fila[$GANANCIA_NETA_ANTERIOR]";?>"/>
							<td align="right"><? echo "$fila[$GANANCIA_NETA_ANTERIOR]";?></td>
							<td align="center"><a href="/gestion/?mod=ver_empresa&n=<? echo "$_GET[n]";?>&action=cargar_trabajo&action2=editar&id=<? echo "$fila[$ID]";?>">Editar</a></td><?
						}?>
						<td align="right"><input name="ganado_propio<? echo "$i";?>" type="text" size="7"  value="<? echo "$fila[$GANADO_PROPIO]";?>"/></td>
						<td align="right"><input name="ganado_refs<? echo "$i";?>" type="text" size="7"  value="<? echo "$fila[$GANADO_REFS]";?>"/>
						<input name="id<? echo "$i";?>" type="hidden" value="<? echo "$fila[$ID]";?>"/><?
						
					}?>
		
				</tr>
				<input name="num" type="hidden" value="<? echo "$i";?>"/><?
				$i++;
		}?>
	</tbody>
	<tfoot>
		<tr>
			<td colspan="4" align="right" style="border:none"><input type="submit" name="cargar" value="Cargar" /></td>
		</tr>
	</tfoot>
	</form>
	</table><?
	
}else{?>

	<tr><td colspan='7' align='center'><span class="Estilo1">No hay nadie apuntado a esta empresa.</span></td></tr><?
	
}

}else{?>acceso denegado.<? }?>