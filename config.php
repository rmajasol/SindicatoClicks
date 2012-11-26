<?	 

	$HOSTNAME = "localhost";
	$USERNAME = "sindicat";
	$PASSWORD = "nHkEBOvpOY";
	$DATABASE = "sindicat_comunidadclickers";
	
	function conectar(){
		global $HOSTNAME, $USERNAME, $PASSWORD, $DATABASE;
		$idcnx = mysql_connect($HOSTNAME, $USERNAME, $PASSWORD) or DIE(mysql_error());
		mysql_select_db($DATABASE, $idcnx);
		
		return $idcnx;
	}

	function desconectar($arg){
		mysql_close($arg);
	}
	
	function eliminar_cookies($cookies){
		foreach($cookies as $cookie => $value){
			setcookie($cookie,"x", time() - 3600);
		}
	}	
	
	$TASA_E_D = 1.40; //valor en dólares de un euro
	$TARIFA1 = 0.8;
	$TARIFA2 = 0.2;
	
	$LONG_COOKIES = 7776000; //duración de la sesión en segundos;
	
	// constantes
	$miembros_1 = 5;
	$miembros_2 = 10;
	$miembros_3 = 20;
	$c_ad_1 = 0.5;
	$c_ad_2 = 0.9;
	$c_ad_3 = 1.2;
	$ads_dia_1 = 3;
	$ads_dia_2 = 7;
	$ads_dia_3 = 15;
	$c_dia_1 = 4;
	$c_dia_2 = 8;
	$c_dia_3 = 20;
	$porc_1 = 26;
	$porc_2 = 51;
	$porc_3 = 101;
	
	/*******************************
	*********datos de tabla empresas*********
	********************************/
	$TABLA_EMPRESAS = "empresas";	
	
	$ADS_DIA = "ads_dia";	
	$C_AD_GLOBAL = "c_ad_global";
	$C_AD_PROPIO = "c_ad_propio";
	$C_AD_REF = "c_ad_ref";
	$CANTIDAD_PEDIDO = "cantidad_pedido";
	$CAUSA_DE_SCAM = "causa_scam";
	$CLICKS_PROPIO = "clicks_propio";
	$CLICKS_REF = "clicks_ref";
	$CON_CHEATLINK = "con_cheat_link";
	$CHEATLINK_SCR = "screen_cheat_link";
	$DIVISA = "divisa";
	$DUEÑO = "duenio";
	$ESTADO = "estado";
	$FECHA_LANZAMIENTO = "fecha_lanzamiento";
	$FECHA_HA_PAGADO = "fecha_ha_pagado";
	$FECHA_PAGO_PEDIDO = "fecha_pago_pedido";
	$GANADO_PROPIO_E = "ganado_propio_e";
	$GANADO_REFS_E = "ganado_refs_e";
	$ID = "id";
	$LINK_BASE = "link_base";
	$LINK_PAGO_PEDIDO = "link_pedido";
	$LINK_COMPROBANTES_PAGO = "link_pagos";
	$LINK_REGISTRO = "link_reg";
	$LINK_SURF = "link_surf";
	$LINK_STATS = "link_stats";
	$METODO_DE_PAGO = "metodo_pago";
	$MINIMO = "minimo";	
	$MOTIVO_PROBLEMA = "motivo_problema";	
	$NIVELES_REF = "niveles_refs";
	$NOMBRE_DE_EMPRESA = "nombre";
	//$NUM_COBROS = "num_cobros";
	$NUM_REFS = "num_ref";
	$NUM_REFS_EXTERNOS = "refs_externos";
	$PAGO_PEDIDO = "pago_pedido";
	$PORCENTAJE_REFS = "porcentaje_ref";
	$PREMIUM = "premium";
	$PROBLEMA = "problema";
	$PROGRESO = "progreso";
	$PRUEBA_DE_SCAM = "prueba_scam";
	$GRAVEDAD_SCAM = "grav_scam";
	$TIPO = "tipo";
	$TIPO_GESTION = "gestion";
	
	
	/*******************************
	*********datos de tabla usuarios*********
	********************************/
	$TABLA_USUARIOS = "afiliados";	
	
	$ID = "id";
	$NOMBRE_DE_USUARIO = "user";
	$PASSWORD_USUARIO = "password";
	$VER_TODAS_EMPRESAS = "todas_empresas";
	$EMAIL = "email";
	$PAIS = "pais";
	$PAYPAL = "paypal";	
	$ALERTPAY = "alertpay";	
	$EGOLD = "egold";
	$FORMA_DE_PAGO = "forma_de_pago";	
	$FECHA_DE_INSCRIPCION = "fecha_inscripcion";
	$ESTILO_TABLA = "estilo_tabla";
	//$VER_SCAM = "ver_scam";
	$COBRADO = "cobrado";
	$PAGADO = "pagado";
	$IS_COLABORADOR = "is_colaborador";
	$PORCENTAJE_COLAB = "porc_colab";
	$ULTIMOS_CLICKS = "ult_clicks";
	$INTERVALO_EMPRESAS = "interv_empresas";
	$AUTOPAPELERA_ACT = "autopapelera";
	$DEJ_CLICK_ANTISCAM = "click_antiscam";
	$DEJ_CLICK_N_ADS = "click_n_ads";
	$DEJ_CLICK_N_DIAS = "click_n_dias";
	$REFERIDO_POR = "referido_por";
	$REFERIDO_PAGADO = "ref_pagado";
	$PLAN_UPLINE = "plan_upline";
	$MANTENER_PAP = "mantener_pap";
	$ULTIMO_MANTENIM = "ult_mantenim";
	$COOKIE_SESION = "cookie";
	$IP = "ip";
	
	
	/*******************************
	*********datos de tabla pagos*********
	********************************/
	$TABLA_PAGOS = "inscripciones";	
	
	$ID = "id";
	$ID_EMPRESA = "id_empresa";
	$ID_USUARIO = "id_usuario";
	$NICK = "nick";
	$CLICKS = "numClicks";
	$CLICKS_PAGADOS = "numClicks_pagados";
	$CLICKS_NETOS_TEMP = "numClicks_temp";
	$GANANCIA_NETA_ANTERIOR = "ganado_neto_anterior";
	$GANADO_PROPIO = "ganado_propio";
	$GANADO_REFS = "ganado_refs";
	$GANANCIA_NETA_TEMP = "ganado_neto_temp";
	$POR_PAGAR = "por_pagar";
	$POR_COMISIONAR = "por_comisionar";
	$PAGADO = "pagado";
	$COMISION = "comision";
	$FECHA_INSCRIPCION = "fecha_inscripcion";//$mysql_datetime = date("Y-m-d H:i:s");
	$PAPELERA = "papelera";
	
	
	/*******************************
	*********datos de avisos de inscripciones*********
	********************************/
	$TABLA_INSCRIPC_TEMP = "inscrip_temp";	
	
	$ID = "id";
	$ID_EMPRESA = "id_empresa";
	$ID_USUARIO = "id_usuario";
	$NICK = "nick";
	$FECHA_INSCRIPCION = "fecha_inscripcion";//$mysql_datetime = date("Y-m-d H:i:s");
	$ESTADO_INSCRIP = "estado_inscr";
	
	
	/*******************************
	*********datos de tabla tiempos de pago*********
	********************************/
	$TABLA_TIEMPOS_PAGOS = "tiempos_pagos";	
	
	$ID = "id";
	$ID_EMPRESA = "id_empresa";
	$NUMERO_P = "num";
	$FECHA_DE_PEDIDO = "fecha_pedido";
	$FECHA_DE_COBRO = "fecha_pago";
	$CANTIDAD = "cantidad";
	$LINK_COMPROBANTE = "link";
	
	
	/*******************************
	*********datos de tabla historial de pagos*********
	********************************/
	$TABLA_HISTORIAL_PAGOS = "historial_pagos";	
	
	$ID = "id";
	$ID_USUARIO = "id_usuario";
	$NUMERO = "numero";
	$FECHA = "fecha";
	//$CONTENIDO = "contenido";
	$CANTIDAD = "cantidad";
	$LINK_RECIBO = "link_recibo";
	$METODO = "metodo";
	
	
	/*******************************
	*********datos pago por cada empresa en historial de pagos*********
	********************************/
	$TABLA_DETALLES_P = "detalles_pago_empresa";	
	
	$ID = "id";
	$ID_HISTORIAL = "id_historial";
	$ID_USUARIO_D = "id_usuario";
	$ID_EMPRESA_D = "id_empresa";
	$EMPRESA_D = "nombre_empresa";
	$ESTADO_D = "estado_empresa";
	$GANADO_PROPIO_D = "ganado_propio";
	$GANADO_REFS_D = "ganado_refs";
	$GANADO_NETO_ANTERIOR_D = "ganado_neto_anterior";
	$PORCENTAJE_REFS_D = "porc_refs";
	$TARIFA_SINDIC_D = "porc_sind";
	$CLICKS_D = "clicks";
	$CLICKS_PAGADOS_D = "clicks_pagados";
	$PRECIO_CLICK_REF_D = "prec_click_ref";
	$TIPO_GESTION_D = "tipo_gestion";
	$DIVISA_D = "divisa";
	$PREMIUM_D = "premium";
	$E_DOLAR_D = "e_dolar";
	
	
	$TABLA_DETALLES_P_EXTRA = "detalles_pago_extra";
	
	$ID = "id";
	$ID_HISTORIAL = "id_historial";
	$ID_EXTRA = "id_extra";

	
	
	/*******************************
	*********datos de tabla acción*********
	********************************/
	$TABLA_ACCIONES = "acciones";	
	
	$ID = "id";
	$ID_USUARIO = "id_usuario";
	$ID_USUARIO_T = "id_usuario_to";
	$ID_EMPRESA_F = "id_empresa_from";
	$ACCION = "accion";
	$CANTIDAD = "cantidad";
	$FECHA = "fecha";
	
	
	/*******************************
	*********datos de tabla difusion*********
	********************************/
	$TABLA_DIFUSION = "difusion";	
	
	$ID = "id";
	$USER_DIF = "usuario";
	$NOMBRE_DIF = "nombre";
	$LINK_DIF = "link";
	$DETALLES_DIF = "detalles";
	$FECHA_DIF = "fecha";
	
	
	/*******************************
	*********datos de tabla extras*********
	********************************/
	$TABLA_EXTRAS = "extras";	
	
	$ID_EX = "id";
	$ID_USUARIO_EX = "id_usuario";
	$CANTIDAD_EX = "cantidad";
	$CONCEPTO_EX = "concepto";
	$PAGADO_EX = "pagado";
	$FECHA_EX = "fecha";
	
?>
