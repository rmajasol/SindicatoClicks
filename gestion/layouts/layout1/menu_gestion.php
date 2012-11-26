<ul>
 	<li><a href="./">Index</a><li><?
	
    if ($modulo == 'gestion_cobros'){?>
    	<li class="selected"><?
    }else{?>
    	<li><?
    }?><a href="?mod=gestion_cobros">Gestion de cobros</a></li><?
	
    if ($modulo == 'cargar_info'){?>
    	<li class="selected"><?
    }else{?>
    	<li><?
    }?><a href="?mod=cargar_info">Cargar info</a></li><?
	
    if ($modulo == 'confirm_regs'){?>
    	<li class="selected"><?
    }else{?>
    	<li><?
    }?><a href="?mod=confirm_regs">Confirmaciones</a></li>
    
    <li><a href="../">Salir a la web</a></li>
</ul>