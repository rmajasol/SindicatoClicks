<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<form action="?mod=registrarse" method="POST">
<table id="form">
	<tr>
    	<td class="derecha">Nombre de usuario:</td>
    	<td class="dato"><input type='text' name='username' value="<? echo $_POST['username'];?>" /></td>
  	</tr>
  	<tr>
   	 	<td class="derecha">Contrase&ntilde;a:</td>
		<td class="dato"><input type="password" name="password" value="<? echo $_POST['password'];?>" /></td>
  	</tr>
  	<tr>
  	  	<td class="derecha">Repetir contrase&ntilde;a:</td>
		<td class="dato"><input type="password" name="cpassword" value="<? echo $_POST['cpassword'];?>" /></td>
  	</tr>
 	<tr>
    	<td class="derecha">Email:</td>
		<td class="dato"><input type="text" name="email" value="<? echo $_POST['email'];?>" /></td>
  	</tr>
  	<tr>
    	<td class="derecha">Repetir Email:</td>
		<td class="dato"><input type="text" name="cemail" value="<? echo $_POST['cemail'];?>" /></td>
  	</tr>
  	<tr>
    	<td class="derecha">Alertpay:</td>
		<td class="dato"><input type="text" name="aemail" value="<? echo $_POST['aemail'];?>" /></td>
  	</tr>
  	<tr>
   		<td class="derecha">PayPal:</td>
		<td class="dato"><input type="text" name="pemail" value="<? echo $_POST['pemail'];?>" /></td>
  	</tr>
  	<tr>
    	<td class="derecha">Pa&iacute;s:</td>
		<td class="dato"><input type="text" name="country" value="<? echo $_POST['country'];?>" /></td>
  	</tr>
  	<tr>
    	<td class="derecha">Referido por:</td>
		<td class="dato"><input type="text" name="referer" value="<? echo limpiar($_GET["r"]); ?>" value="" /></td>
  	</tr>
  	<tr>
    	<td class="derecha">T&eacute;rminos y condiciones del servicio:</td>
		<td class="dato"><textarea rows="7" cols="50" readonly>
			<? include('./modulos/registrarse/tos.php');?>
			</textarea></td>
 	 </tr>
 	 <tr>
   		<td class="derecha">C&oacute;digo de seguridad:</td>
		<td class="dato"><img src="./modulos/registrarse/image.php?<?php echo $res; ?>" /><br />
        <input type="text" name="code" class="securitycode" value="" /></td>
  	</tr>
  	<tr>
    	<td colspan="2" class="submit"><input type="submit" name="submit" value="Registrarse" tabindex="4" /></td>
  	</tr>
</table>
</form>