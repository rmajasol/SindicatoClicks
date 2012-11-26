

<div class='boxtop3'><div></div></div>
<div class="content">
<div class="headerbar">ÍNDICE:</div><? 
if(isset($_GET['paso']) & $_GET['paso']<=4){?>
	<div class="parte_selected">
		<div class='boxtop6'><div></div></div><?
}else{?>
	<div class="parte">
		<div class='boxtop5'><div></div></div><?
}?>
        <div class="content">
        <div class="titulo_parte">I: Preparando el equipo.</div>
        <ol>
            <li><? 
                if($_GET['paso']==1){?>
                    <span class="sel"><?
                }else{?>
                	<span><?
                }?>
                <a href="/?mod=manual&paso=1">Instalar Mozilla Firefox.</a></span>
            </li>
            <li><? 
                if($_GET['paso']==2){?>
                    <span class="sel"><?
                }else{?>
                	<span><?
                }?>
                <a href="/?mod=manual&paso=2">Descargar KeePass.</a></span>
            </li>
            <li><? 
                if($_GET['paso']==3){?>
                    <span class="sel"><?
                }else{?>
                	<span><?
                }?>
                <a href="http://mail.google.com/mail/signup" target="_blank">Crearse cuenta gmail.</a></span>
            </li>
            <li><? 
                if($_GET['paso']==4){?>
                    <span class="sel"><?
                }else{?>
                	<span><?
                }?>
                <a href="/?mod=manual&paso=4">Crearse cuentas en Paypal y Alertpay.</a></span>
          	</li>
        </ol>
        </div><?
        if(isset($_GET['paso']) & $_GET['paso']<=4){?>
			<div class='boxbottom6'><div></div></div><?
		}else{?>
			<div class='boxbottom5'><div></div></div><?
		}?>
	</div><?
if(isset($_GET['paso']) & $_GET['paso']>4 & $_GET['paso']<=7){?>
	<div class="parte_selected">
		<div class='boxtop6'><div></div></div><?
}else{?>
	<div class="parte">
		<div class='boxtop5'><div></div></div><?
}?>
        <div class="content">
            <div class="titulo_parte">II: Preparando la cuenta.</div>
            <ol>     
                <li><a href="/foro/ucp.php?mode=register" target="_blank">Registrarse en Sindicatoclicks.</a></li>
                <li><a href="/?mod=manual&paso=6">Apuntarse a las PTCs.</a></li>
                <li><a href="/?mod=manual&paso=7">Configurar el perfil.</a></li>
            </ol>
        </div><?
        if(isset($_GET['paso']) & $_GET['paso']>4 & $_GET['paso']<=7){?>
			<div class='boxbottom6'><div></div></div><?
		}else{?>
			<div class='boxbottom5'><div></div></div><?
		}?>
	</div><?
if(isset($_GET['paso']) & $_GET['paso']>8 & $_GET['paso']<=11){?>
	<div class="parte_selected">
		<div class='boxtop6'><div></div></div><?
}else{?>
	<div class="parte">
		<div class='boxtop5'><div></div></div><?
}?>
        <div class="content">
            <div class="titulo_parte">III: Realizando los clicks.</div>
            <ol>
                <li><a href="/?mod=manual&paso=9">Realizar los clicks.</a></li>
                <li><a href="/?mod=manual&paso=10">Mantener las inactivas.</a></li>
                <li><a href="/?mod=manual&paso=11">Mandar PTCs a la 'papelera'.</a></li>
            </ol>
        </div><?
        if(isset($_GET['paso']) & $_GET['paso']>8 & $_GET['paso']<=11){?>
			<div class='boxbottom6'><div></div></div><?
		}else{?>
			<div class='boxbottom5'><div></div></div><?
		}?>
	</div><?
if(isset($_GET['paso']) & $_GET['paso']>11 & $_GET['paso']<=14){?>
	<div class="parte_selected">
		<div class='boxtop6'><div></div></div><?
}else{?>
	<div class="parte">
		<div class='boxtop5'><div></div></div><?
}?>
        <div class="content">
            <div class="titulo_parte">IV: Cobrando efectivo.</div>
            <ol>
                <li><a href="/?mod=manual&paso=12">Residentes Argentinos</a></li>
            	<li><a href="/?mod=manual&paso=13">Residentes Españoles.</a></li>
            </ol>
        </div><?
        if(isset($_GET['paso']) & $_GET['paso']>11 & $_GET['paso']<=14){?>
			<div class='boxbottom6'><div></div></div><?
		}else{?>
			<div class='boxbottom5'><div></div></div><?
		}?>
    </div>
<div class="corte"></div>
</div><!--FIN CONTENT-->
<div class='boxbottom3'><div></div></div>
</div>

