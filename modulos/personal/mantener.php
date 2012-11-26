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
	$mantener_pap = $fila[$MANTENER_PAP];
	
	if ($autopap == 0 & $mantener_pap == 0) {?>
		<div class="cuadro_mensaje">
        	No tienes la autopapelera activa ni ninguna ptc en papelera, por tanto no tienes ninguna para mantener.
      	</div><?
	} else {
		$sql = "SELECT * FROM $TABLA_EMPRESAS INNER JOIN $TABLA_PAGOS ON $TABLA_PAGOS.$ID_EMPRESA=$TABLA_EMPRESAS.$ID WHERE $TABLA_PAGOS.$ID_USUARIO=" .$id_usuario. " and $ESTADO!='scam' ORDER BY $ADS_DIA DESC";
		$res = mysql_query($sql) or die (mysql_error());
		while($fila = mysql_fetch_array($res)){
			$hoy = date('Y-m-d');
			$dias = dias_diferencia($hoy,$fila[$FECHA_PAGO_PEDIDO]);
			if ($autopap == 1){
				if ($mantener_pap == 1){
					if ($dej_antiscam == 1 & $fila[$ESTADO] == 'antiscam' & $fila[$PAGO_PEDIDO] == 1){?>
						<script>window.open('<? echo "$fila[$LINK_SURF]";?>')</script><?
					}else if ($fila[$ADS_DIA] <= $dej_n_ads){?>
						<script>window.open('<? echo "$fila[$LINK_SURF]";?>')</script><?
                    }else if ($fila[$ESTADO] == 'segura' & $dias >= $dej_n_dias & $fila[$PAGO_PEDIDO] == 1){?>
						<script>window.open('<? echo "$fila[$LINK_SURF]";?>')</script><?
					}else if ($fila[$PAPELERA] == 1){?>
						<script>window.open('<? echo "$fila[$LINK_SURF]";?>')</script><?
					}
				}else{
					if ($dej_antiscam == 1 & $fila[$ESTADO] == 'antiscam' & $fila[$PAGO_PEDIDO] == 1 & $fila[$PAPELERA] == 0){?>
						<script>window.open('<? echo "$fila[$LINK_SURF]";?>')</script><?
					}else if ($fila[$ADS_DIA] <= $dej_n_ads & $fila[$PAPELERA] == 0){?>
						<script>window.open('<? echo "$fila[$LINK_SURF]";?>')</script><?
					}else if ($fila[$ESTADO] == 'segura' & $dias >= $dej_n_dias & $fila[$PAGO_PEDIDO] == 1){?>
						<script>window.open('<? echo "$fila[$LINK_SURF]";?>')</script><?
					}
				}
			}else if ($mantener_pap == 1 & $fila[$PAPELERA] == 1){?>
				<script>window.open('<? echo "$fila[$LINK_SURF]";?>')</script><?
			}
		}?>
		
		<div id="botones"><div class='boxtop2'><div></div></div>
			<div class="c_term"><a href="?mod=mantener&fin=true">Manteninimento terminado</a></div>
		<div class='boxbottom2'><div></div></div></div><?
	}
	
} else {

	//actualizamos ult_clicks en el usuario
	$sql = "UPDATE $TABLA_USUARIOS SET $ULTIMO_MANTENIM='".date("Y-m-d H:i:s")."' WHERE $ID=".$id_usuario;
	$res = mysql_query($sql) or die (mysql_error());?>
	<div id="botones"><div class='boxtop2'><div></div></div>
		<h2>Mantenimiento terminado</h2>
		<h1><a href="/?mod=empresas&cat=mias">Volver</a></h1>
	<div class='boxbottom2'><div></div></div></div><?
}?>

