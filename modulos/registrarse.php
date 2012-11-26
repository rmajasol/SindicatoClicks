<div class='boxtop2'><div></div></div>
<div class="content"><?

if (isset($_COOKIE["id_usuario_dw"]) && isset($_COOKIE["marca_aleatoria_usuario_dw"])){?>
	<div class="cuadro_info">Ya est&aacute;s registrado y logueado! <a href="./">[Volver]</a></div><?

}else{ 

$correcto = 0;
if (isset($_POST["submit"])){
	if (strtolower($_POST['code'])!= strtolower($_SESSION['texto'])){?> 
		<div class="cuadro_error">Error al introducir el c&oacute;digo de seguridad</div><?
	}else{
		$username = $_POST["username"];
		$password = $_POST["password"];
		$cpassword = $_POST["cpassword"];
		$email = $_POST["email"];
		$cemail = $_POST["cemail"];
		$aemail = $_POST["aemail"];
		$pemail = $_POST["pemail"];
		$country = $_POST["country"];
		
		if($username==NULL|$password==NULL|$cpassword==NULL|$email==NULL|$cemail==NULL|$pemail==NULL|$country==NULL){?>
			<div class="cuadro_error">Son requeridos todos los campos del formulario</div><?
		}else{
			// sanitizamos las variables
			$username = uc($username);
			$password = uc($password);
			$cpassword = uc($cpassword);
			$email = limpiar($email);
			$cemail = limpiar($cemail);
			$aemail = limpiar($aemail);
			$pemail = limpiar($pemail);
			$country = limpiar($country);
			// limitamos el numero de caracteres
			$username=limitatexto($username,15);
			$password=limitatexto($password,15);
			$cpassword=limitatexto($cpassword,15);
			$email=limitatexto($email,100);
			$cemail=limitatexto($cemail,100);
			$aemail=limitatexto($aemail,100);
			$pemail=limitatexto($pemail,100);
			$country=limitatexto($country,15);
			// comprobamos que tengan un minimo de caracteres
			if (minimo($username)){?>
				<div class="cuadro_error">Debe introducir un nombre de usuario de al menos 3 caracteres</div><?
			}else if (minimopass($password)){?>
            	<div class="cuadro_error">Debe introducir una contraseña de al menos 6 caracteres</div><?
			}else if($password!=$cpassword){?>
				<div class="cuadro_error">Las contrase&ntilde;as no coinciden</div><?
			}else if($email!=$cemail){?>
				<div class="cuadro_error">Los emails no coinciden</div><?
			}else if(!ValidaMail($email)){?>
				<div class="cuadro_error">Debe introducir una dirección email válida</div><?
			}else if(!ValidaMail($pemail)){?>
				<div class="cuadro_error">Debe introducir una dirección paypal válida</div><?
			}else if(!ValidaMail($aemail)){?>
				<div class="cuadro_error">Debe introducir una dirección alertpay válida</div><?
			}else{
				// Comprobamos que no se haya creado otra cuenta desde la misma ip
				$laip = getIPreal();
				$checkip = mysql_query("SELECT $IP FROM $TABLA_USUARIOS WHERE $IP='$laip'");
				$ip_exist = mysql_num_rows($checkip);
				if ($ip_exist>0) {?>
					<div class="cuadro_error">¡Ya te has creado una cuenta antes desde el mismo ordenador!</div><?
				}else{
					// Comprobamos que el nombre de usuario, email y el email de paypal no existan
					$sql = "SELECT $NOMBRE_DE_USUARIO FROM $TABLA_USUARIOS "
							. "WHERE $NOMBRE_DE_USUARIO='$username'";
					$checkuser = mysql_query($sql);
					$username_exist = mysql_num_rows($checkuser);
					$checkemail = mysql_query("SELECT $EMAIL FROM $TABLA_USUARIOS WHERE $EMAIL='$email'");
					$email_exist = mysql_num_rows($checkemail);
					$checkpemail = mysql_query("SELECT $PAYPAL FROM $TABLA_USUARIOS WHERE $PAYPAL='$pemail'");
					$pemail_exist = mysql_num_rows($checkpemail);
					$checkaemail = mysql_query("SELECT $ALERTPAY FROM $TABLA_USUARIOS WHERE $ALERTPAY='$pemail'");
					$aemail_exist = mysql_num_rows($checkaemail);
					if ($email_exist>0){?>
						<div class="cuadro_error">Ya existe ese email</div><?
					}else if ($username_exist>0){?>
						<div class="cuadro_error">Ya existe ese nombre de usuario</div><?
					}else if ($pemail_exist>0){?>
						<div class="cuadro_error">Ya existe ese paypal en el sitio</div><?
					}else if ($aemail_exist>0){?>
						<div class="cuadro_error">Ya existe ese alertpay en el sitio</div><?
					}else{
						// Si se ha introducido un referer comprobamos que exista
						if ($_POST["referer"] != ""){
							// Sanitizamos la variable
							$referer = limpiar($_POST["referer"]);
							$referer=limitatexto($referer,15);
							$sql = "SELECT $NOMBRE_DE_USUARIO FROM $TABLA_USUARIOS WHERE $NOMBRE_DE_USUARIO='$referer'";
							$checkref = mysql_query($sql);
							$referer_exist = mysql_num_rows($checkref);
							if ($referer_exist<1){?>
								<div class="cuadro_error">
									Ese usuario del que te apuntas referido no existe en el sitio. Prueba a poner uno correcto 
									o si no deja el campo en blanco
								</div><?
							}else{
								// Si todo parece correcto procedemos con la inserccion
								$campos = "$NOMBRE_DE_USUARIO,$PASSWORD_USUARIO,$EMAIL,$ALERTPAY,$PAYPAL,"
										. "$PAIS,$REFERIDO_POR,$FECHA_DE_INSCRIPCION,$IP";
								$valores = "'" . $username . "',";
								$valores .= "'" . $password . "',";
								$valores .= "'" . $email . "',";
								$valores .= "'" . $aemail . "',";
								$valores .= "'" . $pemail . "',";
								$valores .= "'" . $country . "',";
								$valores .= "'" . $referer . "',";
								$valores .= "'" . date("Y-m-d") . "',";
								$valores .= "'" . $laip . "'";
								$sql = "INSERT INTO $TABLA_USUARIOS ($campos) VALUES ($valores)";
								$res = mysql_query($sql) or die (mysql_error());?>
								<div class="cuadro_confirm_ok">
									Te has registrado correctamente <? 
									echo "$username";?>. Ya puedes loguearte desde la p&aacute;gina principal :)
								</div><?
								$correcto = 1;
							}
						}else{
							// Si todo parece correcto procedemos con la inserccion
							$campos = "$NOMBRE_DE_USUARIO,$PASSWORD_USUARIO,$EMAIL,$ALERTPAY,$PAYPAL,"
									. "$PAIS,$REFERIDO_POR,$FECHA_DE_INSCRIPCION,$IP";
							$valores = "'" . $username . "',";
							$valores .= "'" . $password . "',";
							$valores .= "'" . $email . "',";
							$valores .= "'" . $aemail . "',";
							$valores .= "'" . $pemail . "',";
							$valores .= "'" . $country . "',";
							$valores .= "'" . $referer . "',";
							$valores .= "'" . date("Y-m-d") . "',";
							$valores .= "'" . $laip . "'";
							$sql = "INSERT INTO $TABLA_USUARIOS ($campos) VALUES ($valores)";
							$res = mysql_query($sql) or die (mysql_error());?>
							<div class="cuadro_confirm_ok">
								Te has registrado correctamente <? 
								echo "$username";?>. Ya puedes loguearte desde la p&aacute;gina principal :)
							</div><?
							$correcto = 1;
						}
					}
				}
           	}
        }
   	}
}
if ($correcto == 0)
	include ('./modulos/registrarse/formulario.php');
}?>
</div>
<div class='boxbottom2'><div></div></div>