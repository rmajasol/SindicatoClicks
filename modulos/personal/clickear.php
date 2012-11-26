<?
if ($_GET['fin'] != 'true'){
	//seleccionamos el intervalo
	$sql = "SELECT * FROM $TABLA_USUARIOS WHERE $ID=".$id_usuario;
	$res = mysql_query($sql) or die (mysql_error());
	$fila = mysql_fetch_array($res);
	$interv = $fila[$INTERVALO_EMPRESAS];
	$autopap = $fila[$AUTOPAPELERA_ACT];
	$dej_antiscam = $fila[$DEJ_CLICK_ANTISCAM];
	$dej_n_ads = $fila[$DEJ_CLICK_N_ADS];
	$dej_n_dias = $fila[$DEJ_CLICK_N_DIAS];
	
	//contamos el número de empresas
	$sql = "SELECT * FROM $TABLA_EMPRESAS INNER JOIN $TABLA_PAGOS ON $TABLA_PAGOS.$ID_EMPRESA=$TABLA_EMPRESAS.$ID WHERE $TABLA_PAGOS.$ID_USUARIO=" .$id_usuario. " and $PAPELERA=0 and $ESTADO!='scam' and $TIPO='ptc'";
	if ($autopap == 1){
		$sql .= " and $ADS_DIA>".$dej_n_ads;
	}
	$res = mysql_query($sql) or die (mysql_error());
	$count = mysql_num_rows($res);
	$num_tandas = $count/$interv;
	
	if (isset($_GET['ini'])){
		$sql = "SELECT * FROM $TABLA_EMPRESAS INNER JOIN $TABLA_PAGOS ON $TABLA_PAGOS.$ID_EMPRESA=$TABLA_EMPRESAS.$ID WHERE $TABLA_PAGOS.$ID_USUARIO=" .$id_usuario. " and $PAPELERA=0 and $ESTADO!='scam' and $TIPO='ptc'";
		if ($autopap == 1){
			$sql .= " and $ADS_DIA>".$dej_n_ads;
		} 
		$sql .= " ORDER BY $ADS_DIA DESC LIMIT ".$_GET['ini'].",".$_GET['fin'];
		$res = mysql_query($sql) or die (mysql_error());
		while($fila = mysql_fetch_array($res)){
			if ($autopap == 1) {
				$hoy = date('Y-m-d');
				$dias = dias_diferencia($hoy,$fila[$FECHA_PAGO_PEDIDO]);
				if ($dej_antiscam == 1) {
					if ($fila[$ESTADO] == 'segura' & $dias < $dej_n_dias) {?>
						<script>window.open('<? echo "$fila[$LINK_SURF]";?>')</script><?
					}
					if ($fila[$ESTADO] == 'antiscam' & $fila[$PAGO_PEDIDO] == 0) {?>
						<script>window.open('<? echo "$fila[$LINK_SURF]";?>')</script><?
					}
				} else if ($fila[$ESTADO] == 'segura' & $dias < $dej_n_dias) {?>
                	<script>window.open('<? echo "$fila[$LINK_SURF]";?>')</script><?
				}	
			} else {?>
				<script>window.open('<? echo "$fila[$LINK_SURF]";?>')</script><?
			}
		}
	}?>
	
	
	<div id="botones"><div class='boxtop2'><div></div></div><?
	$j = 0;
	$k = 0;
	for ($i=0; $i<$num_tandas; $i++){
		$k += $interv;
		if (isset($_GET['ini'])){
			if (($_GET['ini']+$_GET['fin']) < $k){?>
				<div class="boton"><a href="?mod=clickear&ini=<? echo "$j";?>&fin=<? echo "$interv";?>">tanda#<? echo "$i";?></a></div><?
			}
		}else{?>
			<div class="boton"><a href="?mod=clickear&ini=<? echo "$j";?>&fin=<? echo "$interv";?>">tanda#<? echo "$i";?></a></div><?
		}
		$j += $interv;
	}?>
	<div class="c_term"><a href="?mod=clickear&fin=true">Clicks terminados</a></div>
	<div class='boxbottom2'><div></div></div></div><?
	
} else {

	//actualizamos ult_clicks en el usuario
	$sql = "UPDATE $TABLA_USUARIOS SET $ULTIMOS_CLICKS='".date("Y-m-d H:i:s")."' WHERE $ID=".$id_usuario;
	$res = mysql_query($sql) or die (mysql_error());?>
	<div id="botones"><div class='boxtop2'><div></div></div>
		<h2>Clicks terminados</h2>
		<h1><a href="?mod=empresas&cat=mias">Volver</a></h1>
	<div class='boxbottom2'><div></div></div></div><?
}?>

