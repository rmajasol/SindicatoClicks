<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<div class="titulo">
	<div class="boxtop_titulo"><div></div></div>
    <div class="content"><?
		switch($modulo){
			case 'lista_empresas':?>
				Listado de empresas bajo el Sindicato<?
				break;
			case 'faq':?>
				FAQ (preguntas frecuentes acerca del Sindicato y las PTC)<?
				break;
			case 'manual':?>
				Manual del clicker<?
				break;
			case 'pagos_pedidos':?>
				Lista de pagos pedidos<?
				break;
			case 'pagos_recibidos':?>
				Lista de pagos recibidos<?
				break;		
			case 'empresas':
				if ($_GET['cat'] == 'mias'){?>
					Mis PTCs<?
				}else{?>
					A&ntilde;adir PTCs<?
				}
				break;	
			case 'clickear':?>
				Clickear<?
				break;
			case 'mantener':?>
				Mantener inactivas<?
				break;		
			case 'papelera':?>
				Mi papelera<?
				break;	
			case 'ganancias':?>
				Mis ganancias<?
				break;	
			case 'perfil':?>
				Mi perfil<?
				break;
			case 'historial_pagos':?>
				Mi historial de cobros<?
				break;
			case 'registrarse':?>
				Formulario de registro<?
				break;
			case 'recuperar_password':?>
				Recuperar contraseña<?
				break;
		}?>
	</div>
    <div class='boxbottom_titulo'><div></div></div>
</div>