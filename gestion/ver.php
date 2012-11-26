<?
if ($_POST["usuario"] == ''){
	header("Location: ./?mod=ver_empresa&n=" . $_POST["empresa"]);
	exit;
}else if ($_POST["empresa"] == ''){
	header("Location: ./?mod=ver_usuario&n=" . $_POST["usuario"]);
	exit;
}?>