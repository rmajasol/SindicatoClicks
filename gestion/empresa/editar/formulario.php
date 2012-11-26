<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /><?
$sql = "SELECT * FROM $TABLA_EMPRESAS WHERE $ID=".$id_empresa;
$res = mysql_query($sql) or die (mysql_error());
$fila = mysql_fetch_array($res);
		
if (mysql_num_rows($res) > 0){?>
	<form method="post" action="?mod=ver_empresa&n=<? echo "$_GET[n]";?>&action=editar">
		<table id="form">
			<tr>
				<td class="derecha">Pago pedido:</td><?
				if ($fila[$PAGO_PEDIDO] == 1){?>
					<td class="dato">
                    	<input name="pago_pedido" type="submit" value="Pedido">
						<span class="datos_edido">Fecha: <? echo "$fila[$FECHA_PAGO_PEDIDO]";?> 
                        / Cantidad: <? echo "$divisa$fila[$CANTIDAD_PEDIDO]";?></span>
                        <input class="ped_cancelado" name="pedido_cancelado" type="submit" value="X">
                  	</td><?
				}else{?>
					<td class="dato"><input name="pago_pedido" type="submit" value="Pedir"></td><?
				}?>
			</tr><?
			
			if ($fila[$PAGO_PEDIDO] == 1){?>
				<tr>
					<td class="derecha">Ha pagado:</td>
					<td class="dato"><input name="ha_pagado" type="submit" value="Ha pagado!"></td>
				</tr><?
			}?>
			
			<tr>
				<td class="derecha">nombre de empresa: </td>
				<td class="dato"><input name="nombre" type="text" value="<? echo "$fila[$NOMBRE_DE_EMPRESA]";?>"></td>
			</tr>
			<tr>
				<td class="derecha">Premium: </td><?
				if ($fila[$PREMIUM] == 1){?>
					<td class="dato"><input name="premium" type="checkbox" checked></td><?
				}else{?>
					<td class="dato"><input name="premium" type="checkbox"></td><?
				}?>
			</tr>
			<tr>
				<td class="derecha">Divisa:</td>
				<td class="dato">
                	<select name="divisa"><?
						if ($fila[$DIVISA] == 'dolar'){?> 
							<option value="dolar" selected>$</option><?
						}else{?>
							<option value="dolar">$</option><?
						}
						if ($fila[$DIVISA] == 'euro'){?> 
							<option value="euro" selected>€</option><?
						}else{?>
							<option value="euro">€</option><?
						}
						if ($fila[$DIVISA] == 'libra'){?> 
							<option value="libra" selected>£</option><?
						}else{?>
							<option value="libra">£</option><?
						}?> 
				  	</select> 
             	</td>
			</tr>
			<tr>
				<td class="derecha">N&ordm; de refs externos:</td>
				<td class="dato" colspan="2">
                	<input name="refs_externos" type="text" size="7" value="<? echo "$fila[$NUM_REFS_EXTERNOS]";?>">
               	</td>
			</tr>
			<tr>
				<td class="derecha">forma de pago: </td>
				<td class="dato" colspan="2">
                	<select name="pago"><?
						if ($fila[$METODO_DE_PAGO] == 'paypal'){?> 
							<option value="paypal" selected>paypal</option><?
						}else{?>
							<option value="paypal">paypal</option><?
						}
						if ($fila[$METODO_DE_PAGO] == 'alertpay'){?> 
							<option value="alertpay" selected>alertpay</option><?
						}else{?>
							<option value="alertpay">alertpay</option><?
						}
						if ($fila[$METODO_DE_PAGO] == 'paypal_alertpay'){?> 
							<option value="paypal_alertpay" selected>paypal & alertpay</option><?
						}else{?>
							<option value="paypal_alertpay">paypal & alertpay</option><?
						}
						if ($fila[$METODO_DE_PAGO] == 'egold'){?> 
							<option value="egold" selected>egold</option><?
						}else{?>
							<option value="egold">egold</option><?
						}
						if ($fila[$METODO_DE_PAGO] == 'mypayscript'){?> 
							<option value="mypayscript" selected>mypayscript</option><?
						}else{?>
							<option value="mypayscript">mypayscript</option><?
						}
						if ($fila[$METODO_DE_PAGO] == 'cheque'){?> 
							<option value="cheque" selected>cheque</option><?
						}else{?>
							<option value="cheque">cheque</option><?
						}
						if ($fila[$METODO_DE_PAGO] == 'transferencia'){?> 
							<option value="transferencia" selected>transferencia</option><?
						}else{?>
							<option value="transferencia">transferencia</option><?
						}
						if ($fila[$METODO_DE_PAGO] == 'cheque_transferencia'){?> 
							<option value="cheque_transferencia" selected>cheque/transferencia</option><?
						}else{?>
							<option value="cheque_transferencia">cheque/transferencia</option><?
						}?>
				  	</select> 
            	</td>
			</tr><?
			
			if ($fila[$TIPO_GESTION] == 'b'){?>
				<tr>
					<td class="derecha">Clicks propios:</td>
					<td class="dato" colspan="2">
                    	<input name="own_clicks" type="text" size="7" value="<? echo "$fila[$CLICKS_PROPIO]";?>">
                  	</td>
				</tr>
				<tr>
					<td class="derecha">Clicks de referidos:</td>
					<td class="dato" colspan="2">
                    	<input name="ref_clicks" type="text" size="7" value="<? echo "$fila[$CLICKS_REF]";?>">
                 	</td>
				</tr>
				<tr>
					<td class="derecha">cents/click propio:</td>
					<td class="dato" colspan="2"><? echo "$fila[$C_AD_PROPIO]";?></td>
				</tr>
				<tr>
					<td class="derecha">cents/click refs:</td><?
					$cl_ref = redondear_dos_decimal($fila[$C_AD_REF]);?>
					<td class="dato" colspan="2"><? echo "$cl_ref";?></td>
				</tr><?
			}else{?>
				<tr>
					<td class="derecha">cents/click:</td>
					<td class="dato" colspan="2">
                    	<input name="centsXad" type="text" size="7" value="<? echo "$fila[$C_AD_PROPIO]";?>">
                   	</td>
				</tr><?
			}?>
				
			<tr>
				<td class="derecha">ads/dia:</td>
			 	<td class="dato" colspan="2">
                	<input name="adsXdia" type="text" size="7" value="<? echo "$fila[$ADS_DIA]";?>">
              	</td>
			</tr>
			<tr>
				<td class="derecha">Con cheatlink:</td><?
					if ($fila[$CON_CHEATLINK] == 1){?>
						<td class="dato"><input name="con_cheatlink" type="checkbox" checked></td><?
					}else{?>
						<td class="dato"><input name="con_cheatlink" type="checkbox"></td><?
					}?>
			</tr>
			<tr>
				<td class="derecha">screen cheatlink (post):</td>
				<td class="dato" colspan="2">
                	<input name="cheatlink_scr" type="text" value="<? echo "$fila[$CHEATLINK_SCR]";?>">
              	</td>
			</tr>
			<tr>
				<td class="derecha">estado:</td>
				<td class="dato" colspan="2">
                	<select name="estado"><?
						if ($fila[$ESTADO] == 'segura'){?> 
							<option value="segura" selected>segura</option><?
						}else{?>
							<option value="segura">segura</option><?
						}
						if ($fila[$ESTADO] == 'antiscam'){?> 
							<option value="antiscam" selected>antiscam</option><?
						}else{?>
							<option value="antiscam">antiscam</option><?
						}
						if ($fila[$ESTADO] == 'scam'){?> 
							<option value="scam" selected>scam!</option><?
						}else{?>
							<option value="scam">scam!</option><?
						}?>
				  	</select> 
              	</td>
			</tr>
			<tr>
				<td class="derecha">tipo de gesti&oacute;n:</td>
				<td class="dato" colspan="2">
                	<select name="gestion"><?
						if ($fila[$TIPO_GESTION] == 'a'){?> 
							<option value="a" selected>A (valor de click constante)</option><?
						}else{?>
							<option value="a">A (valor de click constante)</option><?
						}
						if ($fila[$TIPO_GESTION] == 'b'){?> 
							<option value="b" selected>B (valor de click variable)</option><?
						}else{?>
							<option value="b">B (valor de click variable)</option><?
						}
						if ($fila[$TIPO_GESTION] == 'c'){?> 
							<option value="c" selected>C (requiere screen)</option><?
						}else{?>
							<option value="c">C (requiere screen)</option><?
						}?>
				  	</select> 
              	</td>
			</tr>
			<tr>
				<td class="derecha">% por referidos:</td>
				<td class="dato" colspan="2">
                	<input name="ref" type="text" size="7" value="<? echo "$fila[$PORCENTAJE_REFS]";?>">
               	</td>
			</tr>
			<tr>
				<td class="derecha">niveles de referidos:</td>
				<td class="dato" colspan="2">
                	<input name="niveles" type="text" size="7" value="<? echo "$fila[$NIVELES_REF]";?>">
                </td>
			</tr>
			<tr>
				<td class="derecha">progreso (ganado en cuenta):</td>
				<td class="dato" colspan="2">
                	<input name="progreso" type="text" size="7" value="<? echo "$fila[$PROGRESO]";?>">
                </td>
			</tr>
			<tr>
				<td class="derecha">minimo de cobro:</td>
				<td class="dato" colspan="2">
                	<input name="minimo" type="text" size="7" value="<? echo "$fila[$MINIMO]";?>">
                </td>
			</tr>
            <tr>
				<td class="derecha">link de pagos pedidos:</td>
				<td class="dato" colspan="2">
                	<input class="link" name="linkPagosPed" type="text" value="<? echo "$fila[$LINK_PAGO_PEDIDO]";?>">
                </td>
			</tr>
			<tr>
				<td class="derecha">link de comprobantes de pago:</td>
				<td class="dato" colspan="2">
                	<input class="link" name="linkPagos" type="text" value="<? echo "$fila[$LINK_COMPROBANTES_PAGO]";?>">
                </td>
			</tr>
            <tr>
				<td class="derecha">link base:</td>
				<td class="dato" colspan="2">
                	<input class="link" name="linkBase" type="text" value="<? echo "$fila[$LINK_BASE]";?>">
                </td>
			</tr>
			<tr>
				<td class="derecha">link de registro:</td>
				<td class="dato" colspan="2">
                	<input class="link" name="linkReg" type="text" value="<? echo "$fila[$LINK_REGISTRO]";?>">
                </td>
			</tr>
			<tr>
				<td class="derecha">link de surf:</td>
				<td class="dato" colspan="2">
                	<input class="link" name="linkSurf" type="text" value="<? echo "$fila[$LINK_SURF]";?>">
                </td>
			</tr>
			<tr>
				<td class="derecha">link de estad&iacute;sticas:</td>
				<td class="dato" colspan="2">
                	<input class="link" name="linkStats" type="text" value="<? echo "$fila[$LINK_STATS]";?>">
                </td>
			</tr>
			<tr>
				<td class="derecha">fecha de lanzamiento: </td>
				<td class="dato" colspan="2"><? 
					$año = print_fecha($fila[$FECHA_LANZAMIENTO],'año');
					$mes = print_fecha($fila[$FECHA_LANZAMIENTO],'mes');
					$dia = print_fecha($fila[$FECHA_LANZAMIENTO],'dia');
					form_comp_fecha($año,$mes,$dia,'lanzamiento');?>
                </td>
			</tr>
			<tr>
				<td class="derecha">due&ntilde;o: </td>
				<td class="dato" colspan="2">
                	<select name="dueño"><?
						if ($fila[$DUEÑO] == 'elpibmario'){?> 
							<option value="elpibmario" selected>elpibmario</option><?
						}else{?>
							<option value="elpibmario">elpibmario</option><?
						}
						if ($fila[$DUEÑO] == 'saitonrock'){?> 
							<option value="saitonrock" selected>saitonrock</option><?
						}else{?>
							<option value="saitonrock">saitonrock</option><?
						}
						if ($fila[$DUEÑO] == 'sosix'){?> 
							<option value="sosix" selected>sosix</option><?
						}else{?>
							<option value="sosix">sosix</option><?
						}?> 
				  </select> 
             	</td>
			</tr>
			<tr>
				<td class="derecha submit" colspan="3"><input name="submit" type="submit" value="Editar"></td>
			</tr>
		</table>
	</form><?
}?>