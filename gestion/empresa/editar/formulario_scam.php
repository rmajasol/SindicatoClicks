<form method="post" action="?mod=ver_empresa&n=<? echo "$_GET[n]";?>&action=editar">
	<table>
		<tr>
			<td>estado:</td>
			<td>
            	<select name="estado"><?
					if ($estado_empresa == 'segura'){?> 
						<option value="segura" selected>segura</option><?
					}else{?>
						<option value="segura">segura</option><?
					}
					if ($estado_empresa == 'antiscam'){?> 
						<option value="antiscam" selected>antiscam</option><?
					}else{?>
						<option value="antiscam">antiscam</option><?
					}
					if ($estado_empresa == 'scam'){?> 
						<option value="scam" selected>scam!</option><?
					}else{?>
						<option value="scam">scam!</option><?
					}?>
		  		</select> 
          	</td>
		</tr>
		<tr>
			<td>Causa de scam:</td>
			<td><input type="text" name="causa_scam" value="<? echo "$causa_de_scam";?>" /></td>
		</tr>
		<tr>
			<td>Prueba de scam (link): </td>
			<td><input type="text" name="prueba_scam" value="<? echo "$prueba_de_scam";?>" /></td>
		</tr>
		<tr>
			<td>Gravedad del scam: </td>
			<td>
            	<select name="gravedad"><?
					if ($gravedad_scam == 'baja'){?> 
						<option value="baja" selected>Baja</option><?
					}else{?>
						<option value="baja">Baja</option><?
					}
					if ($gravedad_scam == 'media'){?> 
						<option value="media" selected>Media</option><?
					}else{?>
						<option value="media">Media</option><?
					}
					if ($gravedad_scam == 'alta'){?> 
						<option value="alta" selected>Alta</option><?
					}else{?>
						<option value="alta">Alta</option><?
					}?> 
			  	</select>
           	</td>
		</tr>
		<tr>
			<td colspan="2"><input type="submit" name="scam" value="Editar" /></td>
		</tr>
	</table>
</form>