<div id="indice"><?
	include($INCLUDE_ROOT."/modulos/manual/indice.php");?>
</div>

<div id="paso"><?
	switch($_GET['paso']){
		case 1:
			include($INCLUDE_ROOT."/modulos/manual/paso1.php");
			break;
		case 2:
			include($INCLUDE_ROOT."/modulos/manual/pasoI2.php");
			break;
		case 4:
			include($INCLUDE_ROOT."/modulos/manual/pasoI4.php");
			break;
		case 6:
			include($INCLUDE_ROOT."/modulos/manual/pasoII2.php");
			break;
		case 7:
			include($INCLUDE_ROOT."/modulos/manual/pasoII3.php");
			break;
		case 9:
			include($INCLUDE_ROOT."/modulos/manual/pasoIII1.php");
			break;
		case 10:
			include($INCLUDE_ROOT."/modulos/manual/pasoIII2.php");
			break;
		case 11:
			include($INCLUDE_ROOT."/modulos/manual/pasoIII3.php");
			break;
		case 12:
			include($INCLUDE_ROOT."/modulos/manual/pasoIV1.php");
			break;
		case 13:
			include($INCLUDE_ROOT."/modulos/manual/pasoIV2.php");
			break;
	}?>
</div>