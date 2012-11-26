<?
if (esAdmin($user) == 1){

$sql = "SELECT * FROM $TABLA_EMPRESAS"; 
if ($ver_todas == 1){
	if (isset($_GET['tipo'])){
		$sql .= " WHERE $TIPO='".$_GET['tipo']."'";
		if (isset($_GET['estado']))
			$sql .= " and $ESTADO='".$_GET['estado']."'";
	}else if (isset($_GET['estado']))
		$sql .= " WHERE $ESTADO='".$_GET['estado']."'";
}else{
	$sql .= " WHERE $DUEÑO='".$username."'";
	if (isset($_GET['tipo']))
		$sql .= " and $TIPO='".$_GET['tipo']."'";
	if (isset($_GET['estado']))
		$sql .= " and $ESTADO='".$_GET['estado']."'";
}	
$sql .= " ORDER BY $NOMBRE_DE_EMPRESA ASC";
$res = mysql_query($sql) or die (mysql_error());
$count = mysql_num_rows($res);?>



<? //////////////////////////////// TITULO ////////////////////////////////////////////?>
	<div class="titulo">Empresas <?
	if ($ver_todas == 0)
		echo "bajo $nombre_usuario";
	else
		echo "de todos";?><a href="/gestion">[Volver]</a></div>


<? //////////////////////////////// MENUS ////////////////////////////////////////////?>
	<div class="menu"><table>
		<tr>
			<td><a href="/gestion/?mod=lista_empresas.php&estado=segura">Ver Seguras</a></td>	
			<td><a href="/gestion/?mod=lista_empresas.php&estado=antiscam">Ver Antiscam</a></td>	
			<td><a href="/gestion/?mod=lista_empresas.php&estado=scam">Ver Scam</a></td>
		</tr>
	</table></div><?


 //////////////////////////////// TITULO 2 ////////////////////////////////////////////?>
	<div class="titulo2"><?
		switch($_GET['estado']){
			case 'segura':?>
				Empresas <span class="seguras">seguras</span> (<? echo "$count";?>)<?
				break;
			case 'antiscam':?>
				Empresas <span class="antiscam">antiscam</span> <span class="Estilo8">antiscam</span> (<? echo "$count";?>)<?
				break;
			case 'scam':?>
				Empresas <span class="scam">scam</span> <span class="Estilo9">scam!</span> (<? echo "$count";?>)</h3><?
				break;
		}?>
	</div>	


<? //////////////////////////////// TABLA ////////////////////////////////////////////

	if ($count > 0){?>
	<div class="tabla">
	<table class="sortable">
	<thead>
		<tr>
			<th>Nombre</th>
			<th>#refs</th>
			<th>#@ Sind</th>
			<th>Dueño</th><?
			if (!isset($_GET['estado'])){?>
				<th>Estado</th><?
			}?>
			<th>Ads/día</th>
			<th>C/ad</th>
			<th>% to cashout</th>
			<th>Por pagar</th>
			<th>Pagado</th>
			<th>Comisión</th>
			<th>Fecha adición</th>
		</tr>
	</thead>
	<tbody><?
		$total = 0;
		$total_miembros = 0;
		$total_externos = 0;
		$total_por_pagar = 0;
		$total_pagado = 0;
		$total_comision = 0;
		while($fila = mysql_fetch_array($res)){
			$divisa = dec_utf8($fila[$DIVISA]);
			$n_miembros = total_empresa($fila[$ID],'n_miembros');
			$por_pagar = calc_por_pagar_total_e($fila[$ID]);
			$pagado = total_empresa($fila[$ID],'pagado');
			$comision = total_empresa($fila[$ID],'comision');?>
			<tr>
				<td><a href="http://www.sindicatoclicks.net/gestion/ver_empresa.php?n=<? echo "$fila[$NOMBRE_DE_EMPRESA]";?>" target="_blank"><? echo "$fila[$NOMBRE_DE_EMPRESA]";?></a></td><?
				$n_externos = $fila[$NUM_REFS_EXTERNOS];
				$n_total = $n_miembros + $n_externos;?>
				<td><? echo "$n_total";?></td>
				<td><? echo "$n_miembros";?></td>
				<td><? echo "$fila[$DUEÑO]";?></td><?
				if (!isset($_GET['estado'])){?>
					<td><? echo "$fila[$ESTADO]";?></td><?
				}?>
				<td><? echo "$fila[$ADS_DIA]";?></td>
				<td><? echo "$fila[$C_AD_PROPIO]";?></td>
				<td><? draw_progreso($fila[$PROGRESO],$fila[$MINIMO],$divisa);?></td>
				<td><? echo "$por_pagar";?></td>
				<td><? echo "$pagado";?></td>
				<td><? echo "$comision";?></td>
				<td><? echo "$fila[$FECHA_LANZAMIENTO]";?></td>
			</tr><?
			$total += $n_total;
			$total_miembros += $n_miembros; 
			$total_externos += $n_externos;
			$total_por_pagar += $por_pagar;
			$total_pagado += $pagado;
			$total_comision += $comision;
		}?>
	</tbody>
	<tfoot>
		<tr>
			<td align="right">TOTAL:</td>
			<td><? echo "$total";?></td>
			<td><? echo "$total_miembros";?></td>
			<td><? echo "$total_externos";?></td><?
			if (!isset($_GET['estado'])){?>
				<td colspan="4" bgcolor="#000000"></td><?
			}else{?>
				<td colspan="3" bgcolor="#000000"></td><?
			}?>
			<td><? echo "$total_por_pagar";?></td>
			<td><? echo "$total_pagado";?></td>
			<td><? echo "$total_comision";?></td>
			<td></td>
		</tr>
	</tfoot>
	</table>
	</div><?
	
	}else
		echo "<center>no se obtuvieron resultados</center>";
		
}else{?>Acceso restringido.<? }?>