<ul><?
	if ($modulo == 'home'){?>
    	<li class="selected"><?
    }else{?>
    	<li><?
    }?><a href="./">Inicio</a></li><?
	
    if ($registrado == 0){?>
        <li><a href="?mod=registrarse">Registrarse</a></li><?
    }
	
    if ($modulo == 'lista_empresas'){?>
    	<li class="selected"><?
    }else{?>
    	<li><?
    }?><a href="?mod=lista_empresas">PTCs</a></li><?
	
    if ($modulo == 'pagos_recibidos'){?>
    	<li class="selected"><?
    }else{?>
    	<li><?
    }?><a href="?mod=pagos_recibidos">Cobrado</a></li><?
	
    if ($modulo == 'pagos_pedidos'){?>
    	<li class="selected"><?
    }else{?>
    	<li><?
    }?><a href="?mod=pagos_pedidos">Por cobrar</a></li><?
	
    if ($modulo == 'noticias'){?>
    	<li class="selected"><?
    }else{?>
    	<li><?
    }?><a href="?mod=noticias">Noticias</a></li>
    
    <li><a href="./foro/" target="_blank">Foro</a></li><?
    
    if ($modulo == 'faq'){?>
    	<li class="selected"><?
    }else{?>
    	<li><?
    }?><a href="?mod=faq">FAQ</a></li>
    
    <li><a class="final" href="./foro/chat">Chat</a></li><?
    
    if ($admin == 1){?>
    	<li class="gestion"><a href="./gestion/">Gestión</a></li><?
    }?>
</ul>