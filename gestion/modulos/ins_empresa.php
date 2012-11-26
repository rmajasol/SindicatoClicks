<?
if ($admin == 1){
if (isset($_POST['submit']) & $_POST['nombre'] != NULL){
	$campos = "$ADS_DIA,$C_AD_PROPIO,$DIVISA,$DUEÑO,$ESTADO,$FECHA_LANZAMIENTO,";
	$campos .= "$PROGRESO,$LINK_REGISTRO,$LINK_SURF,$LINK_STATS,$METODO_DE_PAGO,$MINIMO,";
	$campos .= "$NIVELES_REF,$NOMBRE_DE_EMPRESA,$NUM_REFS_EXTERNOS,$PORCENTAJE_REFS,$TIPO,$LINK_BASE,$TIPO_GESTION";
	
	$valores = "'" . $_POST['adsXdia'] . "',";
	$valores .= "'" . $_POST['centsXad'] . "',";
	$valores .= "'" . $_POST['divisa'] . "',";
	$valores .= "'" . $username . "',";
	$valores .= "'" . $_POST['estado'] . "',";
	$valores .= "'" . date("Y-m-d") . "',";
	$valores .= "'" . $_POST['progreso'] . "',";
	$valores .= "'" . $_POST['linkReg'] . "',";
	$valores .= "'" . $_POST['linkSurf'] . "',";
	$valores .= "'" . $_POST['linkStats'] . "',";
	$valores .= "'" . $_POST['pago'] . "',";
	$valores .= "'" . $_POST['minimo'] . "',";
	$valores .= "'" . $_POST['niveles'] . "',";
	$valores .= "'" . $_POST['nombre'] . "',";
	$valores .= "'" . $_POST['refs_externos'] . "',";
	$valores .= "'" . $_POST['ref'] . "',";
	$valores .= "'" . $_POST['tipo'] . "',";
	$valores .= "'" . $_POST['linkBase'] . "',";
	$valores .= "'" . $_POST['gestion'] . "'";
	
	$sql = "INSERT INTO $TABLA_EMPRESAS ($campos) VALUES($valores)";
	$res = mysql_query($sql) or die (mysql_error());?>
	<div class="cuadro_confirm_ok">Registro ingresado con éxito!<br><a href='index.php'>regresar</a></div><?
	exit;
}else{?>
	<div class="cuadro_error">Debe indicar al menos el nombre de la empresa a insertar.</div>

<form method="post" action="?mod=ins_empresa">
	<table width="400" border="0" cellpadding="2" cellspacing="0">
	<tr>
		<td width="181" align="right">nombre de empresa: </td>
	  <td align="left">&nbsp;<input name="nombre" type="text"></td>
	</tr>
	<tr>
		<td align="right">tipo: </td>
		<td align="left">&nbsp;<select name="tipo"> 
				<option value="PTC">PTC</option> 
				<option value="PTR">PTR</option>
	  </select> </td>
	</tr>
	<tr>
		<td align="right">divisa: </td>
		<td align="left">&nbsp;<select name="divisa"> 
				<option value="dolar">$</option> 
				<option value="euro">€</option>
				<option value="libra">£</option> 
	  </select> </td>
	</tr>
	<tr>
		<td align="right">número de referidos externos al sindicato: </td>
	  <td align="left">&nbsp;<input name="refs_externos" type="text" size="7"></td>
	</tr>
	<tr>
		<td align="right">forma de pago: </td>
		<td align="left">&nbsp;<select name="pago"> 
				<option value="paypal">paypal</option> 
				<option value="alertpay">alertpay</option>
				<option value="paypal_alertpay">paypal & alertpay</option>
				<option value="egold">egold</option> 
				<option value="mypayscript">mypayscripts</option>
				<option value="cheque">cheque</option>
				<option value="transferencia">transferencia</option>
	  </select> </td>
	</tr>
	<tr>
		<td align="right">cents/click: </td>
	  <td align="left">&nbsp;<input name="centsXad" type="text" size="7"></td>
	</tr>
	<tr>
		<td align="right">ads/dia: </td>
	  <td align="left">&nbsp;<input name="adsXdia" type="text" size="7"></td>
	</tr>
	<tr>
		<td align="right">estado: </td>
		<td align="left">&nbsp;<select name="estado"> 
				<option value="segura">segura</option> 
				<option value="antiscam" selected>antiscam</option>
				<option value="scam">scam!</option> 
	  </select> </td>
	</tr>
	<tr>
		<td align="right">tipo de gestión: </td>
		<td align="left">&nbsp;<select name="gestion"> 
				<option value="a">A (valor de click constante)</option> 
				<option value="b">B (valor de click variable)</option>
				<option value="c">C (requiere screen)</option> 
	  </select> </td>
	</tr>
	<tr>
		<td align="right">% por referidos: </td>
	  <td align="left">&nbsp;<input name="ref" type="text" size="7"></td>
	</tr>
	<tr>
		<td align="right">niveles de referidos: </td>
	  <td align="left">&nbsp;<input name="niveles" type="text" size="7"></td>
	</tr>
	<tr>
		<td align="right">progreso (ganado en cuenta): </td>
	  <td align="left">&nbsp;<input name="progreso" type="text" size="7"></td>
	</tr>
	<tr>
		<td align="right">minimo de cobro: </td>
	  <td align="left">&nbsp;<input name="minimo" type="text" size="7"></td>
	</tr>
    <tr>
		<td align="right">link base: </td>
	  <td align="left">&nbsp;<input name="linkBase" type="text"></td>
	</tr>
	<tr>
		<td align="right">link de registro: </td>
	  <td align="left">&nbsp;<input name="linkReg" type="text"></td>
	</tr>
	<tr>
		<td align="right">link de surf: </td>
	  <td align="left">&nbsp;<input name="linkSurf" type="text"></td>
	</tr>
	<tr>
		<td align="right">link de estadísticas: </td>
	  <td align="left">&nbsp;<input name="linkStats" type="text"></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td align="right"><input name="submit" type="submit" value="añadir!"></td>
	</tr>
  </table>
</form><?
}
}else{?> acceso denegado.<? }?>