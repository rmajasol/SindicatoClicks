<?
/*if ($modulo == 'registrarse')
	session_start();*/?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="description" content="ENTER DESCRIPTION HERE" />
<meta name="keywords" content="ENTER KEYWORDS SEPARATED BY COMMAS" />
<meta name="owner" content="ENTER THE SITE OWNER NAME" />
<meta name="copyright" content="ENTER SITE COPYRIGHT INFO" />
<meta name="author" content="ENTER THE AUTHOR INFO" />
<meta name="rating" content="General" />
<meta name="revisit-after" content="7 days" />

<link rel="shortcut icon" href="./files/images/icons/favicon.ico" ><?
if ($registrado == 0){?>
	<title>SindicatoClicks [invitado]</title><?
}else{?>
	<title>SindicatoClicks [<? echo "$modulo";?>]</title><?
}?>
<link rel="STYLESHEET" type="text/css" href="./common.css">
<link rel="STYLESHEET" type="text/css" href="./layouts/style_layout1.css">
<link rel="STYLESHEET" type="text/css" href="./modulos/styles.css">

<script type="text/javascript">
	var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
	document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
	</script>
	<script type="text/javascript">
	var pageTracker = _gat._getTracker("UA-3827754-1");
	pageTracker._trackPageview();
</script>
</head>

<body><?
elegirScript("sorttable.js");?>
    
<div id="container">

<div id="header">
	<div class="boxtop"><div></div></div>
	<div id="header1">
		<div id="logo"><a href="/"><img src="./files/images/logos/logo3d_145px.png" border="0" /></a></div>
		<div id="banner_top">
			<div class="texto1">Publicidad:</div>
			<div class="banner_1"><?
				include("./layouts/layout1/banner1.php");?>
			</div>
		</div>
	</div>
    <div id="header2">
		<div id="menu_principal"><? 
			include("./layouts/layout1/menu_principal.php");?>
        </div>
        <div id="estadisticas"></div>
	</div>
	<div class="boxbottom"><div></div></div>
</div>

<div id="wrapper">

	<div id="content"><?
		if ($modulo != 'home')
			include("./layouts/layout1/titulo_modulo.php");
		else{?>
			<div class="esp"></div><?
		}?>
        <div class="content">
            <div id="<? echo "$modulo";?>"><?
                if (file_exists( $path_modulo )) 
                    include( $path_modulo );
                else 
                    die('Error al cargar el módulo <b>'.$modulo.'. No existe el archivo <b>'.$conf[$modulo]['archivo'].'</b>');?>
			</div>
        </div>
    </div>
    
    <div id="navigation">
		<div class="boxtop"><div></div></div>
		<div class="content"><?
			if($registrado == 1)
				include("./layouts/layout1/menu_personal.php");
			else
				include("./layouts/layout1/login.php");?>
			<div id="banner_2"><?
				include("./layouts/layout1/banner2.php");?>
			</div>
            <div id="sitios_amigos"><?
				include("./layouts/layout1/sitios_amigos.php");?>
			</div>
        </div>
        <div class="boxbottom"><div></div></div>
	</div>
    
</div>

<div id="footer">
	<div class="boxtop"><div></div></div>
	<div class="content">www.sindicatoclicks.net &copy; 2008, todos los derehos reservados.</div>
	<div class='boxbottom'><div></div></div>
</div>

</div><!-- FIN CONTAINER -->
</body>
</html>

