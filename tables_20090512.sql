-- Host: localhost
-- Generation Time: May 12, 2009 at 10:42 AM
-- Server version: 5.0.67
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `comunida_comunidadclickers`
--
CREATE DATABASE `comunida_comunidadclickers` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `comunida_comunidadclickers`;

-- --------------------------------------------------------

--
-- Table structure for table `acciones`
--

CREATE TABLE IF NOT EXISTS `acciones` (
  `id` mediumint(9) NOT NULL auto_increment,
  `id_usuario` mediumint(9) NOT NULL default '0',
  `id_usuario_to` mediumint(9) NOT NULL default '0',
  `id_empresa_from` mediumint(9) NOT NULL default '0',
  `accion` varchar(20) character set latin1 NOT NULL default '',
  `cantidad` float NOT NULL default '0',
  `fecha` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`),
  KEY `id_usuario` (`id_usuario`,`id_usuario_to`,`id_empresa_from`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=235 ;


--
-- Table structure for table `afiliados`
--

CREATE TABLE IF NOT EXISTS `afiliados` (
  `id` mediumint(9) NOT NULL auto_increment,
  `user` varchar(30) character set utf8 collate utf8_unicode_ci NOT NULL default '',
  `password` varchar(25) NOT NULL,
  `todas_empresas` smallint(1) NOT NULL default '0',
  `email` varchar(50) character set latin1 NOT NULL default '',
  `pais` varchar(25) NOT NULL default '',
  `paypal` varchar(50) character set latin1 NOT NULL default '',
  `alertpay` varchar(50) character set latin1 NOT NULL default '',
  `egold` varchar(50) character set latin1 NOT NULL default '',
  `forma_de_pago` varchar(50) NOT NULL default '',
  `fecha_inscripcion` date default '0000-00-00',
  `estilo_tabla` varchar(20) character set latin1 NOT NULL default 'default',
  `ver_scam` tinyint(1) NOT NULL default '0',
  `cobrado` float NOT NULL default '0',
  `pagado` float NOT NULL default '0',
  `is_colaborador` tinyint(1) NOT NULL default '0',
  `porc_colab` smallint(6) NOT NULL default '0',
  `ult_clicks` datetime NOT NULL default '0000-00-00 00:00:00',
  `interv_empresas` mediumint(9) NOT NULL default '0',
  `autopapelera` tinyint(1) NOT NULL default '0',
  `click_antiscam` tinyint(1) NOT NULL default '0',
  `click_n_ads` smallint(6) NOT NULL default '0',
  `click_n_dias` smallint(6) NOT NULL,
  `referido_por` varchar(50) NOT NULL default '',
  `ref_pagado` tinyint(1) NOT NULL default '0',
  `plan_upline` tinyint(4) NOT NULL default '0',
  `mantener_pap` tinyint(1) NOT NULL default '0',
  `ult_mantenim` datetime NOT NULL default '0000-00-00 00:00:00',
  `cookie` varchar(20) NOT NULL,
  `ip` varchar(20) NOT NULL,
  `pago_pedido` tinyint(1) NOT NULL,
  `fecha_pedido` date NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=296 ;


--
-- Table structure for table `detalles_pago_empresa`
--

CREATE TABLE IF NOT EXISTS `detalles_pago_empresa` (
  `id` mediumint(9) NOT NULL auto_increment,
  `id_historial` mediumint(9) NOT NULL default '0',
  `id_usuario` smallint(6) NOT NULL default '0',
  `id_empresa` smallint(6) NOT NULL default '0',
  `nombre_empresa` varchar(50) character set latin1 NOT NULL default '',
  `ganado_propio` float NOT NULL default '0',
  `ganado_refs` float NOT NULL default '0',
  `ganado_neto_anterior` float NOT NULL default '0',
  `porc_refs` smallint(6) NOT NULL default '0',
  `porc_sind` float NOT NULL default '0',
  `clicks` mediumint(9) NOT NULL default '0',
  `clicks_pagados` mediumint(9) NOT NULL default '0',
  `prec_click_ref` float NOT NULL default '0',
  `tipo_gestion` char(1) character set latin1 NOT NULL default '',
  `divisa` char(10) NOT NULL,
  `premium` tinyint(1) NOT NULL default '0',
  `e_dolar` float NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `id_historial` (`id_historial`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_empresa` (`id_empresa`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=582 ;


--
-- Table structure for table `detalles_pago_extra`
--

CREATE TABLE IF NOT EXISTS `detalles_pago_extra` (
  `id` mediumint(9) NOT NULL auto_increment,
  `id_historial` mediumint(9) NOT NULL default '0',
  `id_extra` mediumint(9) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `id_historial` (`id_historial`,`id_extra`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;


--
-- Table structure for table `difusion`
--

CREATE TABLE IF NOT EXISTS `difusion` (
  `id` mediumint(9) NOT NULL auto_increment,
  `usuario` varchar(30) character set latin1 NOT NULL default '0',
  `nombre` varchar(40) character set latin1 NOT NULL default '',
  `link` varchar(60) character set latin1 NOT NULL default '',
  `detalles` text NOT NULL,
  `fecha` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`id`),
  KEY `id_usuario` (`usuario`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;


--
-- Table structure for table `empresas`
--

CREATE TABLE IF NOT EXISTS `empresas` (
  `id` mediumint(9) NOT NULL auto_increment,
  `duenio` varchar(50) character set latin1 NOT NULL default '',
  `nombre` varchar(30) character set latin1 NOT NULL default '',
  `estado` varchar(20) character set latin1 NOT NULL default '',
  `divisa` char(10) NOT NULL,
  `cobrado` float NOT NULL default '0',
  `metodo_pago` varchar(30) character set latin1 NOT NULL default '',
  `ads_dia` smallint(6) NOT NULL default '0',
  `progreso` float NOT NULL default '0',
  `minimo` float NOT NULL default '0',
  `minimo_alcanzado` tinyint(1) NOT NULL default '0',
  `porcentaje_ref` smallint(6) NOT NULL default '0',
  `niveles_refs` smallint(6) NOT NULL default '0',
  `link_base` varchar(100) NOT NULL,
  `link_pedido` varchar(100) NOT NULL,
  `link_pagos` varchar(150) NOT NULL default '',
  `link_reg` varchar(200) character set latin1 NOT NULL default '',
  `link_surf` varchar(50) character set latin1 NOT NULL default '',
  `link_stats` varchar(50) character set latin1 NOT NULL default '',
  `gestion` char(1) character set latin1 NOT NULL default '',
  `clicks_global` mediumint(9) NOT NULL default '0',
  `c_ad_global` float NOT NULL default '0',
  `c_ad_propio` float NOT NULL default '0',
  `c_ad_ref` float NOT NULL default '0',
  `clicks_propio` mediumint(9) NOT NULL default '0',
  `clicks_ref` mediumint(9) NOT NULL default '0',
  `fecha_lanzamiento` date NOT NULL default '0000-00-00',
  `tipo` varchar(5) character set latin1 NOT NULL default '',
  `num_ref` smallint(6) NOT NULL default '0',
  `ha_pagado` tinyint(4) NOT NULL default '0',
  `pago_pedido` tinyint(1) NOT NULL default '0',
  `premium` tinyint(1) NOT NULL default '0',
  `fecha_ha_pagado` date NOT NULL default '0000-00-00',
  `fecha_pago_pedido` date NOT NULL default '0000-00-00',
  `cantidad_pedido` float NOT NULL default '0',
  `problema` tinyint(1) NOT NULL default '0',
  `motivo_problema` text NOT NULL,
  `refs_externos` mediumint(9) NOT NULL default '0',
  `causa_scam` varchar(150) NOT NULL default '',
  `prueba_scam` varchar(150) NOT NULL default '',
  `num_cobros` mediumint(9) NOT NULL default '0',
  `ganado_propio_e` float NOT NULL default '0',
  `ganado_refs_e` float NOT NULL default '0',
  `grav_scam` varchar(10) NOT NULL default '',
  `con_cheat_link` tinyint(1) NOT NULL default '0',
  `screen_cheat_link` varchar(200) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=294 ;



--
-- Table structure for table `extras`
--

CREATE TABLE IF NOT EXISTS `extras` (
  `id` mediumint(9) NOT NULL auto_increment,
  `id_usuario` mediumint(9) NOT NULL default '0',
  `cantidad` float NOT NULL default '0',
  `concepto` varchar(200) NOT NULL default '',
  `pagado` tinyint(1) NOT NULL default '0',
  `fecha` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`id`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;


--
-- Table structure for table `historial_pagos`
--

CREATE TABLE IF NOT EXISTS `historial_pagos` (
  `id` mediumint(9) NOT NULL auto_increment,
  `id_usuario` mediumint(9) NOT NULL default '0',
  `fecha` date NOT NULL default '0000-00-00',
  `numero` mediumint(9) NOT NULL default '0',
  `cantidad` float NOT NULL default '0',
  `link_recibo` varchar(150) character set latin1 NOT NULL default '',
  `metodo` varchar(20) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 PACK_KEYS=0 AUTO_INCREMENT=177 ;


--
-- Table structure for table `inscrip_temp`
--

CREATE TABLE IF NOT EXISTS `inscrip_temp` (
  `id` mediumint(9) NOT NULL auto_increment,
  `id_empresa` mediumint(9) NOT NULL,
  `id_usuario` mediumint(9) NOT NULL,
  `nick` varchar(35) collate utf8_spanish_ci NOT NULL,
  `fecha_inscripcion` date NOT NULL,
  `estado_inscr` varchar(20) collate utf8_spanish_ci NOT NULL default 'espera',
  PRIMARY KEY  (`id`),
  KEY `id_empresa` (`id_empresa`,`id_usuario`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=401 ;


--
-- Table structure for table `inscripciones`
--

CREATE TABLE IF NOT EXISTS `inscripciones` (
  `id` smallint(5) unsigned NOT NULL auto_increment,
  `id_usuario` mediumint(9) NOT NULL default '0',
  `id_empresa` mediumint(9) NOT NULL default '0',
  `nick` varchar(30) NOT NULL default '',
  `por_pagar` float NOT NULL default '0',
  `pagado` float NOT NULL default '0',
  `comision` float NOT NULL default '0',
  `numClicks` mediumint(9) NOT NULL default '0',
  `numClicks_pagados` mediumint(9) NOT NULL default '0',
  `ganado_propio` float NOT NULL default '0',
  `ganado_refs` float NOT NULL default '0',
  `ganado_neto_anterior` float NOT NULL default '0',
  `fecha_inscripcion` date NOT NULL default '0000-00-00',
  `por_comisionar` float NOT NULL default '0',
  `papelera` tinyint(4) NOT NULL default '0',
  `numClicks_temp` mediumint(9) NOT NULL default '0',
  `ganado_neto_temp` float NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_empresa` (`id_empresa`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1974 ;


--
-- Table structure for table `tiempos_pagos`
--

CREATE TABLE IF NOT EXISTS `tiempos_pagos` (
  `id` mediumint(9) NOT NULL auto_increment,
  `id_empresa` mediumint(9) NOT NULL default '0',
  `num` mediumint(9) NOT NULL default '0',
  `fecha_pedido` date NOT NULL default '0000-00-00',
  `fecha_pago` date NOT NULL default '0000-00-00',
  `cantidad` float NOT NULL default '0',
  `link` varchar(150) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `id_empresa` (`id_empresa`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=211 ;