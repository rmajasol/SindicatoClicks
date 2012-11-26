<div id="login">
	<div class='boxtop_bloqnav'><div></div></div>
    <div class="content"><?
	switch($_GET['errorlogin']) {
		case 'datos':?>
    		<div class="cuadro_error_login">Datos de acceso incorrectos</div><?
			break;
		case 'code':?>
        	<div class="cuadro_error_login">Código de seguridad incorrecto</div><?
			break;
	}?>
	<form action="index.php" target="_top" method="post" enctype="multipart/form-data"> 
			<div class="bloq">
				Usuario:<br />
				<input name="username" type="text" style="BORDER-RIGHT: 0px; BORDER-TOP: 0px; BORDER-LEFT: 0px; WIDTH: 110px; BORDER-BOTTOM: 0px" value="" size="10" />
			</div>
			<div class="bloq">
			  	Contrase&ntilde;a:<br /> 
			  	<input type="password" name="password"  style="BORDER-RIGHT: 0px; BORDER-TOP: 0px;  BORDER-LEFT: 0px; WIDTH: 110px; BORDER-BOTTOM: 0px" size="10" maxlength="32"  >
			</div>
			<div class="bloq">
			  	<input type="checkbox" name="autologin" id="autologin" class="checkbox" value="1"  /> 
			  	Autologin  
	 		</div>
            <div class="bloq">
			  	<img src="./modulos/registrarse/image.php?<?php echo $res; ?>" /><br />
        		<input type="text" name="code" class="securitycode" value="" size="4"/>
	 		</div>
			<div class="bloq">
			  	<a href="?mod=registrarse" title="Léete las condiciones y decide si quieres pertenecer a esta comunidad." >Registrarse</a>
			</div>
            <div class="bloq">
			  	<a href="?mod=recuperar_password">Recuperar contraseña</a>
			</div>
			<div class="bloq">
			  	<input type="submit" value=" Entrar " name="login"  style="BORDER-RIGHT: 0px; BORDER-TOP: 0px;  BORDER-LEFT: 0px; WIDTH: 60px; BORDER-BOTTOM: 0px">
			</div> 
	</form>
    </div>
    <div class='boxbottom_bloqnav'><div></div></div>
</div>
