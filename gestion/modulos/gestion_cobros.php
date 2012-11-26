<?
if ($admin == 1){?>
<link rel="STYLESHEET" type="text/css" href="./gestion/modulos/css/gestion_cobros.css">

<div id="gestion_cobros">

<? //////////////////////////////// TITULO ////////////////////////////////////////////?>
<div class="titulo">Gestión de cobros</div>

<div class="tabla_valores">
<table id="tabla">
	<thead>
		<tr>
			<th></th>
			<th>Usuario</th>
			<th>Cobrado</th>
			<th>Pagado</th>
			<th>Beneficio</th>
			<th>Medida</th>
		</tr>
	</thead>
	<tbody><?
		$sql = "SELECT * FROM $TABLA_USUARIOS WHERE $IS_COLABORADOR=1";
		$res = mysql_query($sql) or die (mysql_error());
		$benef_total = 0;
		while($fila = mysql_fetch_array($res)){
			$beneficio = $fila[$COBRADO] - $fila[$PAGADO];
			$benef_total += $beneficio;
		}
		$sql = "SELECT * FROM $TABLA_USUARIOS WHERE $IS_COLABORADOR=1 and $ID=".$id_usuario." ORDER BY $NOMBRE_DE_USUARIO ASC";
		$res = mysql_query($sql) or die (mysql_error());
		$fila = mysql_fetch_array($res);
		$benef_total = redondear_dos_decimal($benef_total);
		$benef_mio = $fila[$COBRADO] - $fila[$PAGADO];
		$benef_mio = redondear_dos_decimal($benef_mio);
		$benef_u_mio = $benef_total * ($fila[$PORCENTAJE_COLAB]/100);
		$benef_u_mio = redondear_dos_decimal($benef_u_mio);
		$sobrante = $benef_mio - $benef_u_mio;
		$sobrante = redondear_dos_decimal($sobrante);

		$sql = "SELECT * FROM $TABLA_USUARIOS WHERE $IS_COLABORADOR=1 ORDER BY $NOMBRE_DE_USUARIO ASC";
		$res = mysql_query($sql) or die (mysql_error());
		while($fila = mysql_fetch_array($res)){
			$beneficio = $fila[$COBRADO] - $fila[$PAGADO];//beneficio actual
			$beneficio = redondear_dos_decimal($beneficio);?>
			<tr>
				<td><?
				if ($fila[$ID] == $id_usuario){
				}else{?>
					<a href="/gestion/?mod=dar&id=<? echo "$fila[$ID]";?>&sobrante=<? echo "$sobrante";?>&b_total=<? echo "$benef_total";?>">Darle</a><?
				}?>
				</td>
				<td><? echo "$fila[$NOMBRE_DE_USUARIO]";?></td><?
				$cobrado = redondear_dos_decimal($fila[$COBRADO]);
				$pagado = redondear_dos_decimal($fila[$PAGADO]);?>
				<td><? echo "$cobrado";?></td>
				<td><? echo "$pagado";?></td>
				<td><? echo "$beneficio";?></td><?
				$benef_u = $benef_total * ($fila[$PORCENTAJE_COLAB]/100);
				$benef_u = redondear_dos_decimal($benef_u);//lo que le corresponde
				$a_recibir = $benef_u - $beneficio;
				$a_recibir = redondear_dos_decimal($a_recibir);
				$a_dar = $beneficio - $benef_u;
				$a_dar = redondear_dos_decimal($a_dar);
				if (($benef_u > $beneficio) & !(0 <= $a_recibir & $a_recibir < 0.02))
					$accion = "<span class='a_recibir'>-> a recibir: <b>".$a_recibir." $</b></span>";
				else if (($benef_u < $beneficio) & !(0 <= $a_dar & $a_dar < 0.02))
					$accion = "<span class='a_dar'>-> a dar: <b>".$a_dar." $</b></span>";
				else /*((0 <= $a_recibir & $a_recibir < 0.02) | (0 <= $a_dar & $a_dar < 0.02)) */
					$accion = "<span class='justo'>-> ajuste correcto <-</span>";?>
				<td><? echo "$accion";?></td>
			</tr><?
		}?>
	</tbody>
</table>
</div>

<div class="cuadrito">
	<div style="padding:10px">
		<strong>Beneficio TOTAL: $<? echo "$benef_total";?></strong><br />
		Beneficio mio: $<? echo "$benef_mio";?><br />
		Beneficio unitario mio: $<? echo "$benef_u_mio";?><br />
		Sobrante: $<? echo "$sobrante";?>
	</div>
</div>

<div class="espaciado"></div>
<div class="tabla_movimientos">
<div class="titulo_movimientos">
	Últimos movimientos:
</div>
<table id="tabla" style="margin-top:5px">
	<thead>
		<tr>
			<th>Usuario</th>
			<th>Accion</th>
			<th>Fte/Dest</th>
			<th>Cantidad</th>
			<th>Fecha</th>
		</tr>
	</thead>
	<tbody><?
		$sql = "SELECT * FROM $TABLA_ACCIONES ORDER BY $FECHA DESC";
		$res = mysql_query($sql) or die (mysql_error());
		while($fila = mysql_fetch_array($res)){
			$sql2 = "SELECT $NOMBRE_DE_USUARIO FROM $TABLA_USUARIOS WHERE $ID=".$fila[$ID_USUARIO];
			$res2 = mysql_query($sql2) or die (mysql_error());
			$fila2 = mysql_fetch_array($res2);
			$nombre_colaborador = $fila2[$NOMBRE_DE_USUARIO];
			if ($fila[$ACCION] == 'cobra'){
				$sql2 = "SELECT $NOMBRE_DE_EMPRESA FROM $TABLA_EMPRESAS WHERE $ID=".$fila[$ID_EMPRESA_F];
				$res2 = mysql_query($sql2) or die (mysql_error());
				$fila2 = mysql_fetch_array($res2);
				$d = $fila2[$NOMBRE_DE_EMPRESA];
			}else{
				$sql2 = "SELECT $NOMBRE_DE_USUARIO FROM $TABLA_USUARIOS WHERE $ID=".$fila[$ID_USUARIO_T];
				$res2 = mysql_query($sql2) or die (mysql_error());
				$fila2 = mysql_fetch_array($res2);
				$d = $fila2[$NOMBRE_DE_USUARIO];
			}?>
			<tr>
				<td><? echo "$nombre_colaborador";?></td><?
				if ($fila[$ACCION] == 'pasa a'){?>
					<td class="pasa_a"><? echo "$fila[$ACCION]";?></td><?
				}else{?>
					<td class="<? echo "$fila[$ACCION]";?>"><? echo "$fila[$ACCION]";?></td><?
				}
				if ($fila[$ACCION] == 'cobra')
					$class = "de_empresa";
				else if ($fila[$ACCION] == 'paga')
					$class = "de_usuario";
				else if ($fila[$ACCION] == 'pasa a')
					$class = "de_usuario";?>
				<td class="<? echo "$class";?>"><? echo "$d";?></td>
				<td align="right"><? echo "$fila[$CANTIDAD]";?></td>
				<td><? echo "$fila[$FECHA]";?></td>
			</tr><?
		}?>
	</tbody>
</table>
</div>
</div><?
}else{?> acceso denegado.<? }?>