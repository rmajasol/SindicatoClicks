<?
if ($_POST['añadir2']){

for ($i=0;$i<$_POST['num'];$i++) {
	$a = "id_" . $i;
	$id_empresa = $_POST[$a];
	$a = "nick_" . $i;
	$nick = $_POST[$a];
	//evitamos que se repitan confirmaciones
	$sql = "SELECT $ID FROM $TABLA_INSCRIPC_TEMP WHERE $ID_EMPRESA=" . $id_empresa
			. " and $ID_USUARIO=" . $id_usuario;
	$res = mysql_query($sql) or die (mysql_error());
	if (mysql_num_rows($res) < 1) {
		$campos = "$ID_EMPRESA,$ID_USUARIO,$NICK,$FECHA_INSCRIPCION";
		$valores = "'" . $id_empresa . "',";
		$valores .= "'" . $id_usuario . "',";
		if ($nick == NULL) {
			$sql = "SELECT $NOMBRE_DE_USUARIO FROM $TABLA_USUARIOS WHERE $ID=" . $id_usuario;
			$res = mysql_query($sql) or die (mysql_error());
			$fila = mysql_fetch_array($res);
			$nick_default = $fila[$NOMBRE_DE_USUARIO];
			$valores .= "'" . $nick_default . "',";
		} else {	 
			$valores .= "'" . $nick . "',";
		}
		$valores .= "'" . date("Y-m-d") . "'";
		$sql = "INSERT INTO $TABLA_INSCRIPC_TEMP ($campos) VALUES ($valores)";
		$res = mysql_query($sql) or die (mysql_error());
	}
}?>
<div class="cuadro_confirm_ok">Empresa/s agregada/s en espera de confirmación. Gracias!</div><?

} else {?>

<div class="cuadro_mensaje">Introduce los nicks con los que te suscribiste a cada PTC. Si dejas los campos en blanco el sistema tomará como nick el que tienes como nombre de usuario en Comunidadclickers.com</div>
<form action="<? echo $_SERVER['PHP_SELF'] . "?mod=empresas&cat=otras";?>" method="post">
<table id="tabla_añadir" align="center">
	<thead>
		<tr>
			<th>PTC</th>
			<th>Nick</th>
		</tr>
	</thead>
	<tbody><?
		$j = 0;
		for ($i=0; $i<=$_POST['num'];$i++){
			$a = "empresa_" . $i;
			$empresa_checked = $_POST[$a];
			if ($empresa_checked == "1") {
				$a = "id_" . $i;
				$id_empresa = $_POST[$a];
				$sql = "SELECT $NOMBRE_DE_EMPRESA FROM $TABLA_EMPRESAS WHERE $ID=" . $id_empresa;
				$res = mysql_query($sql) or die (mysql_error());
				$fila = mysql_fetch_array($res);?>
				<tr>
                	<td>
						<? echo "$fila[$NOMBRE_DE_EMPRESA]";?>
                    	
                    </td>
					<td><input type="text" name="nick_<? echo "$j";?>"></td>
               	</tr>
				<input type="hidden" name="id_<? echo "$j";?>" value="<? echo "$id_empresa";?>"><?
				$j++;
			}
      	}?>	
   	</tbody>
    <tfoot>
    	<tr><td colspan="2" class="derecha">
        		<input type="submit" name="añadir2" value="Añadir"/>
                <input type="hidden" name="añadir">
                <input type="hidden" name="num" value="<? echo "$j";?>">
        </td></tr>
    </tfoot>
</table>
</form><?
}?>
	
