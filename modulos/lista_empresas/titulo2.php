<h3><?
switch($_GET['estado']){
	case 'segura':?>
		Lista de empresas <span class="seguras">seguras</span> (<? echo "$count";?>)<?
		break;
	case 'antiscam':?>
		Lista de empresas <span class="antiscam">antiscam</span> (<? echo "$count";?>)<?
		break;
	case 'scam':?>
		Lista de empresas <span class="scam">scam!</span> (<? echo "$count";?>)<?
		break;
	default:?>
		Todas las empresas (<? echo "$count";?>)<?
}?>
</h3>
