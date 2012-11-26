<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /><?
if ($admin == 1){

if ($_GET['action'] == 'confirmar') {

	$sql = "SELECT * FROM $TABLA_INSCRIPC_TEMP WHERE $ID=" . $_GET['id'];
	$res = mysql_query($sql) or die (mysql_error());
	$fila = mysql_fetch_array($res);
	$campos = "$ID_USUARIO,$ID_EMPRESA,$NICK,$FECHA_INSCRIPCION";
	$valores = "'" . $fila[$ID_USUARIO] . "',";
	$valores .= "'" . $fila[$ID_EMPRESA] . "',";
	$valores .= "'" . $fila[$NICK] . "',";
	$valores .= "'" . $fila[$FECHA_INSCRIPCION] . "'";
	$sql = "INSERT INTO $TABLA_PAGOS ($campos) VALUES ($valores)";
	$res = mysql_query($sql) or die (mysql_error());
	$sql = "DELETE FROM $TABLA_INSCRIPC_TEMP WHERE id=" . $_GET['id'];
	$res = mysql_query($sql) or die (mysql_error());?>
    <div class="cuadro_confirm_ok">Confirmado correctamente!</div><?
	
} else if ($_GET['action'] == 'cancelar') {

	if (isset($_POST['yes'])){
		$sql = "UPDATE $TABLA_INSCRIPC_TEMP SET $ESTADO_INSCRIP = 'error' WHERE $ID=" . $_GET['id'];
		$res = mysql_query($sql) or die (mysql_error());?>
		<div class="cuadro_mensaje">Registro cancelado!</div><?
	}else if (isset($_POST['no'])){
	}else{?>
		<div class="cuadro_confirm">
        	¿Estás seguro de querer cancelar el registro?
            <form action="<? echo '?mod=confirm_regs&action=cancelar&id=' . $_GET['id'];?>" method="post">
                <input type="submit" name="yes" value="SI" />&nbsp;
                <input type="submit" name="no" value="NO" />
            </form>
		</div><?
	}
}

$sql = "SELECT $TABLA_INSCRIPC_TEMP.$ID,$TABLA_INSCRIPC_TEMP.$NICK,"
		. "$TABLA_EMPRESAS.$LINK_STATS,$TABLA_EMPRESAS.$NOMBRE_DE_EMPRESA "
		. "FROM $TABLA_EMPRESAS INNER JOIN "
		. "$TABLA_INSCRIPC_TEMP ON $TABLA_INSCRIPC_TEMP.$ID_EMPRESA=$TABLA_EMPRESAS.$ID "
		. "WHERE $TABLA_EMPRESAS.$DUEÑO='" . $username . "' and $TABLA_INSCRIPC_TEMP.$ESTADO_INSCRIP='espera' "
		. "ORDER BY $TABLA_EMPRESAS.$NOMBRE_DE_EMPRESA ASC";
$res = mysql_query($sql) or die (mysql_error());
$count = mysql_num_rows($res);?>

<? //////////////////////////////// TITULO ////////////////////////////////////////////?>
<div class="titulo">Confirmaciones pendientes de registros en PTCs bajo <span class="user"><? echo "$username";?></span></div>

<div class="tabla">
<? //////////////////////////////// TABLA ////////////////////////////////////////////
if ($count > 0){?>
	<table id="tabla">
	<thead>
		<tr>
			<th>Empresa</th>
			<th>Nick</th>
			<th colspan="2">Acci&oacute;n</th>
		</tr>
	</thead>
	<tbody><?
		while($fila = mysql_fetch_array($res)){?>
			<tr>
				<td><a href="<? echo "$fila[$LINK_STATS]";?>" target="_blank"><? echo "$fila[$NOMBRE_DE_EMPRESA]";?></a></td>
				<td><? echo "$fila[$NICK]";?></td>
				<td>
                	<a href="<? echo '?mod=confirm_regs&action=confirmar&id=' . $fila[$ID];?>">
                	Confirmar</a> | 
                    <a href="<? echo '?mod=confirm_regs&action=cancelar&id=' . $fila[$ID];?>">
                	Cancelar</a>
                </td>
			</tr><?
		}?>
	</tbody>
	</table><?
} else {?>
	<div class="cuadro_mensaje">No tienes empresas pendientes de confirmaci&oacute;n a cargo</div><?
}?>
</div><?
}else{?> acceso denegado.<? }?>