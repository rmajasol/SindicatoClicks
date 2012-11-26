<?php 
 
define('IN_PHPBB', true); // se define que se va a usar phpbb. 
$phpbb_root_path = './foro/';// el path directo del servidor a phpbb3, varia algo dependiendo del servidor, si hay errores con esto en el mismo error sale el path correcto. 
$phpbb_url_path = './foro/'; // la url hacia tu phpbb3 
$phpEx = substr(strrchr(__FILE__, '.'), 1); // tipo de extension 
include($phpbb_root_path . 'common.' . $phpEx); // incluimos el common.php que es muy importante para la bd 
include($phpbb_root_path . 'config.' . $phpEx); //include de config.php  importante tambien en bd usuarios  y pass
 
// iniciamos sesion 
$user->session_begin(); 
$auth->acl($user->data); 
 ?> 
