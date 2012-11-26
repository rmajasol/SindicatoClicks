<?php 
include("sesiones.php");

if($user->data['is_registered']){  
	$avvy = "SELECT * FROM phpbb_users WHERE user_id =" . $user->data['user_id']; 
	$result = mysql_query($avvy) or die (mysql_error()); 
 
	while($row = mysql_fetch_array($result)){ 
	$link = $row['user_avatar']; 
$width = $row['user_avatar_width']; 
$height = $row['user_avatar_height']; 
}?> 
<a href="<?php echo $phpbb_url_path?>memberlist.php?mode=viewprofile&amp;u=<?php echo $user->data['user_id'];?> " target="_self"></a> 
 
 
<table width="145" height="392" border="0" cellpadding="0" cellspacing="0" > 
  <tr> 
    <td align="center" valign="top"> 
        <table width="145" border="0" cellspacing="0" cellpadding="0"> 
          <tr> 
            <td align="center">Hola <a href="<?php echo $phpbb_url_path?>memberlist.php?mode=viewprofile&amp;u=<?php echo $user->data['user_id'];?> " target="_self"> <?php echo $user->data['username'];?> </a>!</td> 
          </tr> 
        </table> 
      <table width="135" height="255" border="0" cellpadding="0" cellspacing="0"> 
        <tr> 
            <td height="250" align="center" valign="middle"><img src="<?php echo $phpbb_url_path?>download/file.php?avatar=<? echo $link?> " border="0" width="<? echo $width?> " height=" <? echo $height?>" alt='Avatar' /></td> 
        </tr> 
      </table> 
      <table width="145" border="0" cellspacing="0" cellpadding="0"> 
          <tr> 
            <td align="center" valign="middle" class="Estilo5"><span class="Estilo20"><a href="<?php echo $phpbb_url_path?>ucp.php" >Visita tu<br /> 
            Panel de control</a><br />            
            <?php echo( "<a href=" . $phpbb_url_path . 'ucp.php?mode=logout&redirect=../index.php' . '&sid=' . $user->data['session_id'] . " >Cerrar Sesion</a>");?>.</td> 
        </tr> 
      </table> 
      <table width="145" height="72" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF"> 
          <tr> 
            <td align="center" valign="top">0</td> 
          </tr> 
      </table></td> 
  </tr> 
</table> 
 
 
 
<?php 
} else { 
 ?> 
 <table width="145" height="392" border="0" cellpadding="0" cellspacing="0"> 
  <tr> 
    <td width="145" align="center" valign="top"><p> 
 
        <form action="<?php echo $phpbb_url_path?>ucp.php?mode=login" target="_top" method="post" enctype="multipart/form-data"> 
          <img src="http://www.tudominio.com/avatar-default.jpg" alt="." width="135" height="250" /> Usuario: 
          <input name="username" type="text" style="BORDER-RIGHT: 0px; BORDER-TOP: 0px; BORDER-LEFT: 0px; WIDTH: 110px; BORDER-BOTTOM: 0px" value="" size="10" /> 
          <br /> 
          Contrase&ntilde;a:<br /> 
          <input type="password" name="password"  style="BORDER-RIGHT: 0px; BORDER-TOP: 0px;  BORDER-LEFT: 0px; WIDTH: 110px; BORDER-BOTTOM: 0px" size="10" maxlength="32"  > 
          <br /> 
          <input type="checkbox" name="autologin" id="autologin" class="checkbox" value="ON"  /> 
          Autologin 
          <input type="hidden" name="redirect" value="../index.php"> 
 
          <div><a href="<?php echo $phpbb_url_path?>ucp.php?mode=register" title="Léete las condiciones y decide si quieres pertenecer a esta comunidad." >Soy nuevo</a></div> 
          <div><a href="<?php echo $phpbb_url_path?>ucp.php?mode=sendpassword" title="Danos tu nombre de usuario y tu correo electr&oacute;nico y te mandamos una nueva" >Recordar password </a></div> 
          <input type="submit" value=" Entrar " name="login"  style="BORDER-RIGHT: 0px; BORDER-TOP: 0px;  BORDER-LEFT: 0px; WIDTH: 60px; BORDER-BOTTOM: 0px"> 
 
    </form></td> 
  </tr> 
</table> 
 
 
 
 
<?php }

?>
