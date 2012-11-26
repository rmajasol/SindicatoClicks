<?php

/*
* Archivo de configuración para nuestra aplicación modularizada.
* Definimos valores por defecto y datos para cada uno de nuestros módulos.
*/
define('MODULO_DEFECTO', 'home');
define('LAYOUT_DEFECTO', 'layout1.php');
define('MODULO_PATH', realpath('./modulos/'));
define('LAYOUT_PATH', realpath('./layouts/'));

$conf['home'] = array(
       'archivo' => 'home.php',
       'layout' => LAYOUT_DEFECTO );
$conf['cargar_info'] = array(
       'archivo' => 'cargar_info.php',
       'layout' => LAYOUT_DEFECTO ); 
$conf['gestion_cobros'] = array(
       'archivo' => 'gestion_cobros.php',
       'layout' => LAYOUT_DEFECTO ); 
$conf['dar'] = array(
       'archivo' => 'dar.php',
       'layout' => LAYOUT_DEFECTO );
$conf['ver'] = array(
       'archivo' => 'ver.php',
       'layout' => LAYOUT_DEFECTO );
$conf['ver_empresa'] = array(
       'archivo' => 'ver_empresa.php',
       'layout' => LAYOUT_DEFECTO );
$conf['ver_usuario'] = array(
       'archivo' => 'ver_usuario.php',
       'layout' => LAYOUT_DEFECTO );
$conf['lista_usuarios'] = array(
       'archivo' => 'lista_usuarios.php',
       'layout' => LAYOUT_DEFECTO );
$conf['lista_empresas'] = array(
       'archivo' => 'lista_empresas.php',
       'layout' => LAYOUT_DEFECTO );
$conf['ins_usuario'] = array(
       'archivo' => 'ins_usuario.php',
       'layout' => LAYOUT_DEFECTO );
$conf['ins_empresa'] = array(
       'archivo' => 'ins_empresa.php',
       'layout' => LAYOUT_DEFECTO );
$conf['confirm_regs'] = array(
       'archivo' => 'confirm_regs.php',
       'layout' => LAYOUT_DEFECTO );