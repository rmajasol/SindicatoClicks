<?php

/*
* Archivo de configuración para nuestra aplicación modularizada.
* Definimos valores por defecto y datos para cada uno de nuestros módulos.
*/
define('MODULO_DEFECTO', 'home');
define('LAYOUT_DEFECTO', 'layout1.php');
define('MODULO_PATH', realpath('./modulos/'));
define('LAYOUT_PATH', realpath('./layouts/'));

$conf['faq'] = array(
       'archivo' => 'faq.php',
       'layout' => LAYOUT_DEFECTO );
$conf['foro'] = array(
       'archivo' => 'foro.php',
       'layout' => LAYOUT_DEFECTO );
$conf['home'] = array(
       'archivo' => 'home.php',
       'layout' => LAYOUT_DEFECTO );
$conf['lista_empresas'] = array(
       'archivo' => 'lista_empresas.php',
       'layout' => LAYOUT_DEFECTO ); 
$conf['manual'] = array(
       'archivo' => 'manual.php',
       'layout' => LAYOUT_DEFECTO );
$conf['noticias'] = array(
       'archivo' => 'noticias.php',
       'layout' => LAYOUT_DEFECTO );
$conf['pagos_pedidos'] = array(
       'archivo' => 'pagos_pedidos.php',
       'layout' => LAYOUT_DEFECTO );
$conf['pagos_recibidos'] = array(
       'archivo' => 'pagos_recibidos.php',
       'layout' => LAYOUT_DEFECTO );
$conf['registrarse'] = array(
       'archivo' => 'registrarse.php',
       'layout' => LAYOUT_DEFECTO );
$conf['recuperar_password'] = array(
       'archivo' => 'recuperar_password.php',
       'layout' => LAYOUT_DEFECTO );

	   
/* AREA PERSONAL */	   
$conf['empresas'] = array(
       'archivo' => 'personal/empresas.php',
       'layout' => LAYOUT_DEFECTO );
$conf['clickear'] = array(
       'archivo' => 'personal/clickear.php',
       'layout' => LAYOUT_DEFECTO );
$conf['mantener'] = array(
       'archivo' => 'personal/mantener.php',
       'layout' => LAYOUT_DEFECTO );
$conf['papelera'] = array(
       'archivo' => 'personal/papelera.php',
       'layout' => LAYOUT_DEFECTO );
$conf['ganancias'] = array(
       'archivo' => 'personal/mis_ganancias.php',
       'layout' => LAYOUT_DEFECTO );
$conf['perfil'] = array(
       'archivo' => 'personal/perfil.php',
       'layout' => LAYOUT_DEFECTO );
$conf['historial_pagos'] = array(
       'archivo' => 'personal/historial_pagos.php',
       'layout' => LAYOUT_DEFECTO );?>