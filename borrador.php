<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin t&iacute;tulo</title>
</head>

<body><?
include ('config.php');
include ('funciones.php');
function construir_nombre($min=6, $max=8){
	$vocales = array("a", "e", "i", "o", "u");
    $consonantes = array("b", "c", "d", "f", "g", "j", "l", "m", "n", "p", "r", "s", "t");
    $random_nombre = rand($min, $max);//largo de la palabra
    $random = rand(0,1);//si empieza por vocal o consonante
    for($j=0;$j<$random_nombre;$j++){//palabra
    	switch($random){
        	case 0: 
				$random_vocales = rand(0, count($vocales)-1); 
				$nombre.= $vocales[$random_vocales]; 
				$random = 1; 
				break;
            case 1: 
				$random_consonantes = rand(0, count($consonantes)-1); 
				$nombre.= $consonantes[$random_consonantes]; 
				$random = 0; break;
       	}
 	}
    
	return $nombre;
}

$con = conectar();
$sql = "SELECT $ID FROM $TABLA_USUARIOS";
$res = mysql_query($sql) or die (mysql_error());
while ($fila = mysql_fetch_array($res)) {
	$pal = construir_nombre();
	$sql = "UPDATE $TABLA_USUARIOS SET $PASSWORD_USUARIO='$pal' WHERE $ID='$fila[$ID]'";
	$res2 = mysql_query($sql) or die (mysql_error());
}
desconectar($con);
echo "hecho";?>
</body>
</html>
