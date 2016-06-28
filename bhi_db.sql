-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 11-04-2016 a las 15:40:10
-- Versión del servidor: 5.5.47-0ubuntu0.14.04.1
-- Versión de PHP: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `bhi_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adelantochina`
--

CREATE TABLE IF NOT EXISTS `adelantochina` (
  `cod_ch` int(11) NOT NULL AUTO_INCREMENT,
  `cod_ord` int(11) NOT NULL,
  `fe_prim_ch` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `monto_ch` decimal(11,2) NOT NULL,
  `notas_ch` char(150) COLLATE utf8_bin NOT NULL,
  `tipo_ch` varchar(1) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`cod_ch`),
  UNIQUE KEY `cod_ch` (`cod_ch`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `adelantochina`
--

INSERT INTO `adelantochina` (`cod_ch`, `cod_ord`, `fe_prim_ch`, `monto_ch`, `notas_ch`, `tipo_ch`) VALUES
(4, 1, '2015-05-28 16:37:06', 1.00, '', 'P'),
(6, 3, '2015-05-28 16:37:25', 23.00, '', 'P'),
(7, 3, '2015-05-28 06:00:00', 10.00, '', 'P'),
(8, 8, '2015-06-30 06:00:00', 150000.00, 'Se realizo con el giro de la 003', 'P'),
(10, 8, '2015-07-28 06:00:00', 15234.00, '', 'P');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adelantocliente`
--

CREATE TABLE IF NOT EXISTS `adelantocliente` (
  `cod_adcli` int(11) NOT NULL AUTO_INCREMENT,
  `cer_ori` char(1) COLLATE utf8_bin NOT NULL,
  `fe_firm_contra` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fe_pri_ad` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `monto_ad` decimal(11,2) NOT NULL,
  `tipo_cam_ad` char(1) COLLATE utf8_bin NOT NULL,
  `met_pag_ad` char(1) COLLATE utf8_bin NOT NULL,
  `banco_ad` char(30) COLLATE utf8_bin NOT NULL,
  `cod_ord` int(11) NOT NULL,
  `mon_ar_ad` decimal(11,2) NOT NULL,
  `tipo_ad` varchar(1) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`cod_adcli`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=25 ;

--
-- Volcado de datos para la tabla `adelantocliente`
--

INSERT INTO `adelantocliente` (`cod_adcli`, `cer_ori`, `fe_firm_contra`, `fe_pri_ad`, `monto_ad`, `tipo_cam_ad`, `met_pag_ad`, `banco_ad`, `cod_ord`, `mon_ar_ad`, `tipo_ad`) VALUES
(1, 'S', '2015-03-19 06:00:00', '2015-03-19 06:00:00', 1.00, '', 'C', '', 1, 2.00, 'P'),
(8, 'S', '2015-04-20 06:00:00', '2015-04-21 06:00:00', 3000.00, 'B', 'B', '3000', 2, 3000.00, 'A'),
(9, 'S', '2015-04-17 06:00:00', '2015-04-17 06:00:00', 42.12, '', 'C', '', 2, 0.00, 'A'),
(10, 'S', '2015-05-21 06:00:00', '2015-05-21 06:00:00', 0.00, 'B', 'E', '', 1, 0.00, 'P'),
(18, '', '2015-05-28 06:00:00', '2015-05-28 06:00:00', 1.00, '', '', '', 3, 0.00, 'P'),
(19, '', '2015-06-23 06:00:00', '2015-06-23 06:00:00', 1.00, 'P', 'C', '', 6, 1.00, 'P'),
(20, '', '2015-06-24 06:00:00', '2015-06-24 06:00:00', 123.30, 'P', 'C', '', 7, 17.30, 'P'),
(21, '', '2015-06-30 06:00:00', '2015-06-30 06:00:00', 150000.00, 'O', '', '', 8, 9.09, 'A'),
(23, '', '2015-07-01 06:00:00', '2015-07-01 06:00:00', 9999.00, 'B', '', '', 9, 20.00, 'P'),
(24, '', '2015-07-01 06:00:00', '2015-07-01 06:00:00', 2000.00, 'B', '', '', 9, 10.98, 'P');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `amparos`
--

CREATE TABLE IF NOT EXISTS `amparos` (
  `cod_ord` int(11) NOT NULL,
  `cod_amp` int(11) NOT NULL,
  `djai` varchar(150) NOT NULL,
  `med_cau` varchar(150) NOT NULL,
  `seg_cau` varchar(150) NOT NULL,
  `oficio` varchar(150) NOT NULL,
  `ventaja` varchar(1) NOT NULL,
  `packing_list` varchar(150) NOT NULL,
  `exp_decla` varchar(150) NOT NULL,
  `price_list` varchar(150) NOT NULL,
  `not_comp` varchar(150) NOT NULL,
  `cer_ori` varchar(150) NOT NULL,
  `desp` varchar(150) NOT NULL,
  `pol_seg` varchar(150) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `amparos`
--

INSERT INTO `amparos` (`cod_ord`, `cod_amp`, `djai`, `med_cau`, `seg_cau`, `oficio`, `ventaja`, `packing_list`, `exp_decla`, `price_list`, `not_comp`, `cer_ori`, `desp`, `pol_seg`) VALUES
(2, 0, 'oca.txt', 'oca.txt', 'oca.txt', 'oca.txt', 'o', 'oca.txt', 'oca.txt', 'oca.txt', 'oca.txt', 'oca.txt', 'oca.txt', 'oca.txt'),
(1, 0, '0-europeWW-1430386211.gif', '0-europeWW-1430386211 (1).gif', '10408656_1673635719530740_7119405622408468654_n.jpg', '', '', '', '', '', '', '', '', ''),
(3, 0, '', '', '', '', '0', '', '', '', '', '', '', ''),
(7, 0, '', '', '', '', 'S', '', '', '', '', '', '', ''),
(8, 0, '14073DJAI253801Y..pdf', '14073DJAI253801Y.pdf', '14073DJAI253801Y.pdf', '14073DJAI253801Y..pdf', 'S', '20251 - PACKING LIST.doc', '20251 - EXPORT DECLARATION.xls', '20251 - PRICE LIST.doc', '', '20251 - DRAFT CO.doc', '', 'poliza seguro.pdf');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cheques`
--

CREATE TABLE IF NOT EXISTS `cheques` (
  `cod_ord` int(11) NOT NULL,
  `cod_che` bigint(11) NOT NULL AUTO_INCREMENT,
  `lugar_che` char(30) NOT NULL,
  `bco_emi_che` char(40) NOT NULL,
  `nro_che` bigint(11) NOT NULL,
  `fe_emi_che` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `emi_che` char(40) NOT NULL,
  `paga_che` char(40) NOT NULL,
  `observa_che` char(150) NOT NULL,
  `fe_sal_che` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `concep_ing_che` char(40) NOT NULL,
  `concep_sal_che` char(40) NOT NULL,
  `fe_dif_che` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `cod_ref` varchar(30) NOT NULL,
  `monto_che` float NOT NULL,
  `estado_che` int(1) NOT NULL,
  `resto12` varchar(1) NOT NULL,
  PRIMARY KEY (`cod_che`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Volcado de datos para la tabla `cheques`
--

INSERT INTO `cheques` (`cod_ord`, `cod_che`, `lugar_che`, `bco_emi_che`, `nro_che`, `fe_emi_che`, `emi_che`, `paga_che`, `observa_che`, `fe_sal_che`, `concep_ing_che`, `concep_sal_che`, `fe_dif_che`, `cod_ref`, `monto_che`, `estado_che`, `resto12`) VALUES
(2, 1, 'adelantocliente', 'NACION', 1, '2015-04-17 06:00:00', '', '', '', '2015-04-17 06:00:00', '', '', '2015-04-17 06:00:00', '9', 0, 0, ''),
(1, 2, 'transportes', 'nacion', 4444, '2015-04-20 06:00:00', 'pepe', '', '', '2015-04-20 06:00:00', '', '', '2015-04-20 06:00:00', '3', 0, 0, ''),
(2, 5, 'Terminal', 'CIUDAD', 2222, '2015-05-19 04:11:49', '', '', '', '2015-05-19 06:00:00', '', '', '2015-05-19 06:00:00', '', 0, 0, ''),
(2, 6, 'Terminal', 'CIUDAD', 2222, '2015-05-19 06:00:00', '', '', '', '2015-05-19 06:00:00', '', '', '2015-05-19 06:00:00', '3', 0, 0, ''),
(2, 7, 'Ivetra/Tap', 'NACION', 3, '2015-05-19 06:00:00', '', '', '', '2015-05-19 06:00:00', '', '', '2015-05-19 06:00:00', '9', 4, 0, ''),
(2, 9, 'Transporte', 'CIUDAD', 11111, '2015-05-19 06:00:00', '', '', '', '2015-05-19 06:00:00', '', '', '2015-05-19 06:00:00', '11', 0, 0, ''),
(2, 10, 'Transporte', 'COMAFI', 1, '2015-05-19 06:00:00', '', '', '', '2015-05-19 06:00:00', '', '', '2015-05-19 06:00:00', '11', 0, 0, ''),
(2, 11, 'Transporte', 'PIANO', 2, '2015-05-19 06:00:00', '', '', '', '2015-05-19 06:00:00', '', '', '2015-05-19 06:00:00', '11', 0, 0, ''),
(2, 12, 'Transporte', 'CIUDAD', 5, '2015-05-19 06:00:00', '', '', '', '2015-05-19 06:00:00', '', '', '2015-05-19 06:00:00', '11', 0, 0, ''),
(1, 13, 'adelantocliente', 'NACION', 1, '2015-05-21 06:00:00', '', '', '', '2015-05-21 06:00:00', '', '', '2015-05-21 06:00:00', '1', 0, 0, ''),
(7, 14, 'Seguridad', 'COMAFI', 1, '2015-06-02 06:00:00', '', '', '', '2015-06-02 06:00:00', '', '', '2015-06-02 06:00:00', '15', 1, 0, ''),
(7, 15, 'OrdenDeCompra', 'COMAFI', 1, '2015-06-02 06:00:00', '', '', '', '2015-06-02 06:00:00', '', '', '2015-06-02 06:00:00', '7', 1, 0, ''),
(7, 18, 'OrdenDeCompra', 'CIUDAD', 3, '2015-06-02 06:00:00', '', '', '', '2015-06-02 06:00:00', '', '', '2015-06-02 06:00:00', '7', 3, 0, ''),
(7, 19, 'OrdenDeCompra', 'NACION', 12345, '2015-06-17 06:00:00', 'NACION', '', 'ninguna', '2015-06-17 06:00:00', '', '', '2015-06-17 06:00:00', '7', 54321, 0, ''),
(6, 20, 'OrdenDeCompra', 'NACION', 12345, '2015-06-17 06:00:00', 'NACION', '', 'ninguna', '2015-06-17 06:00:00', 'AAAA', 'SSSSS', '2015-06-17 06:00:00', '6', 54321, 0, ''),
(6, 21, 'adelantocliente', 'ICBC', 1, '2015-06-23 06:00:00', '', '', '', '2015-06-23 06:00:00', '', '', '2015-06-23 06:00:00', '19', 0, 0, ''),
(7, 22, 'adelantocliente', 'NACION', 1, '2015-06-24 06:00:00', '', '', '', '2015-06-24 06:00:00', '', '', '2015-06-24 06:00:00', '20', 1000, 0, 'S'),
(7, 23, 'adelantocliente', 'CIUDAD', 2, '2015-06-24 06:00:00', '', '', '', '2015-06-24 06:00:00', '', '', '2015-06-24 06:00:00', '20', 2000, 0, 'S'),
(8, 24, 'adelantocliente', '1', 1, '2015-06-30 06:00:00', '', '', '', '2015-06-30 06:00:00', '', '', '2015-06-30 06:00:00', '21', 25000, 0, 'S'),
(8, 27, 'adelantocliente', '2', 2, '2015-06-30 06:00:00', '', '', '', '2015-06-30 06:00:00', '', '', '2015-06-30 06:00:00', '21', 25600, 0, 'S'),
(8, 28, 'adelantocliente', '3', 3, '2015-06-30 06:00:00', '', '', '', '2015-06-30 06:00:00', '', '', '2015-06-30 06:00:00', '21', 25400, 0, 'S'),
(8, 29, 'adelantocliente', '4', 4, '2015-06-30 06:00:00', '', '', '', '2015-06-30 06:00:00', '', '', '2015-06-30 06:00:00', '21', 50700, 0, 'S'),
(9, 30, 'adelantocliente', 'NACION', 23, '2015-07-01 06:00:00', '', '', '', '2015-07-01 06:00:00', '', '', '2015-07-01 06:00:00', '23', 1500, 0, 'S'),
(9, 31, 'adelantocliente', 'CIUDAD', 124, '2015-07-01 06:00:00', '', '', '', '2015-07-01 06:00:00', '', '', '2015-07-01 06:00:00', '23', 250, 0, 'S'),
(9, 32, 'adelantocliente', 'NACION', 123, '2015-07-01 06:00:00', '', '', '', '2015-07-01 06:00:00', '', '', '2015-07-01 06:00:00', '24', 152, 0, 'S'),
(9, 33, 'adelantocliente', 'ITAU', 321, '2015-07-01 06:00:00', '', '', '', '2015-07-01 06:00:00', '', '', '2015-07-01 06:00:00', '24', 150, 0, 'S');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE IF NOT EXISTS `clientes` (
  `cod_cli` int(11) NOT NULL AUTO_INCREMENT,
  `ape_cli` char(40) NOT NULL,
  `nom_cli` char(40) NOT NULL,
  `dni` int(8) NOT NULL,
  `cuil` int(11) NOT NULL,
  `dir_per` char(80) NOT NULL,
  `tel_per` int(20) NOT NULL,
  `tel_movil` int(24) NOT NULL,
  `cp_per` char(40) NOT NULL,
  `cuil_empre` int(11) NOT NULL,
  `dir_empre` char(150) NOT NULL,
  `tel_empre` int(20) NOT NULL,
  `cp_empre` char(40) NOT NULL,
  `int_empre` int(8) NOT NULL,
  PRIMARY KEY (`cod_cli`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`cod_cli`, `ape_cli`, `nom_cli`, `dni`, `cuil`, `dir_per`, `tel_per`, `tel_movil`, `cp_per`, `cuil_empre`, `dir_empre`, `tel_empre`, `cp_empre`, `int_empre`) VALUES
(1, 'martinez', 'martin', 11111111, 0, '', 0, 0, '', 0, '', 0, '', 0),
(2, 'DAYAN', 'JONY', 0, 0, '', 0, 0, '', 0, '', 0, '', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comercialinvoice`
--

CREATE TABLE IF NOT EXISTS `comercialinvoice` (
  `cod_ci` int(11) NOT NULL,
  `cod_ord` int(11) NOT NULL,
  `num_com_inv` varchar(11) COLLATE utf8_bin NOT NULL,
  `monto_com_inv` decimal(11,2) NOT NULL,
  `giro_com_inv` varchar(1) COLLATE utf8_bin NOT NULL,
  `fe_fin_prod` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `file_com_inv` varchar(250) COLLATE utf8_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `comercialinvoice`
--

INSERT INTO `comercialinvoice` (`cod_ci`, `cod_ord`, `num_com_inv`, `monto_com_inv`, `giro_com_inv`, `fe_fin_prod`, `file_com_inv`) VALUES
(0, 2, '2', 2.00, '', '2015-04-19 06:00:00', ''),
(0, 1, '1232', 2.01, 'N', '2015-05-21 06:00:00', ''),
(0, 7, 'asd345', 111.00, 'N', '2015-06-17 06:00:00', ''),
(0, 8, '20253', 12345.00, 'N', '2015-06-30 06:00:00', ''),
(0, 9, '1', 123.00, 'N', '2015-07-02 06:00:00', 'minimo_logo.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cotizachina`
--

CREATE TABLE IF NOT EXISTS `cotizachina` (
  `cod_prod_cotch` int(11) NOT NULL AUTO_INCREMENT,
  `pre_ch_cot` decimal(11,2) NOT NULL,
  `a_fac_cot` decimal(11,2) NOT NULL,
  `pres_siva` decimal(11,2) NOT NULL,
  `pres_civa` decimal(11,2) NOT NULL,
  `fe_cot` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `cod_ele_cot` int(11) NOT NULL,
  `cant_cot` decimal(11,2) NOT NULL,
  `tiempo_max_prod` int(11) NOT NULL,
  PRIMARY KEY (`cod_prod_cotch`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- Volcado de datos para la tabla `cotizachina`
--

INSERT INTO `cotizachina` (`cod_prod_cotch`, `pre_ch_cot`, `a_fac_cot`, `pres_siva`, `pres_civa`, `fe_cot`, `cod_ele_cot`, `cant_cot`, `tiempo_max_prod`) VALUES
(24, 4.00, 0.00, 0.00, 0.00, '2015-05-20 06:00:00', 2, 200.00, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cotizacliente`
--

CREATE TABLE IF NOT EXISTS `cotizacliente` (
  `cod_cot_cli` int(11) NOT NULL AUTO_INCREMENT,
  `cod_cli` int(11) NOT NULL,
  `cod_ele_cot` int(11) NOT NULL,
  `precio_cot` decimal(11,2) NOT NULL,
  `notas_cot` varchar(250) NOT NULL,
  `canti_cot` decimal(11,2) NOT NULL,
  `fe_cot_cli` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`cod_cot_cli`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `cotizacliente`
--

INSERT INTO `cotizacliente` (`cod_cot_cli`, `cod_cli`, `cod_ele_cot`, `precio_cot`, `notas_cot`, `canti_cot`, `fe_cot_cli`) VALUES
(1, 1, 2, 324.00, '234sdf', 23.00, '2015-03-20 17:32:32');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentaciones`
--

CREATE TABLE IF NOT EXISTS `documentaciones` (
  `cod_doc` int(11) NOT NULL,
  `packing_list` varchar(150) NOT NULL,
  `cod_ord` int(11) NOT NULL,
  `ins_emb` varchar(150) NOT NULL,
  `ins_pic_doc` varchar(1) NOT NULL,
  `load_pic_doc` varchar(150) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `documentaciones`
--

INSERT INTO `documentaciones` (`cod_doc`, `packing_list`, `cod_ord`, `ins_emb`, `ins_pic_doc`, `load_pic_doc`) VALUES
(0, 'oca.txt', 2, 'ordenes.sql', 'N', 'proyecto2-voslohaces-2015.doc'),
(0, '', 1, '0-europeWW-1430386211 (1).gif', 'S', ''),
(0, '#1474 PACKING LIST.xls', 8, '20195 - COMMERCIAL INVOICE.doc', 'S', 'CIMG0758.JPG');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `elementoscot`
--

CREATE TABLE IF NOT EXISTS `elementoscot` (
  `cod_ele_cot` int(11) NOT NULL AUTO_INCREMENT,
  `nom_ele_cot` varchar(100) NOT NULL,
  `cod_ele_ba` varchar(20) NOT NULL,
  `cod_ele_ch` varchar(20) NOT NULL,
  `des_ele_cot` varchar(150) NOT NULL,
  `peso_ele_cot` decimal(11,2) NOT NULL,
  `ancho_ele_cot` decimal(11,2) NOT NULL,
  `cant_max_cot` decimal(11,2) NOT NULL,
  `notas` varchar(250) NOT NULL,
  PRIMARY KEY (`cod_ele_cot`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `elementoscot`
--

INSERT INTO `elementoscot` (`cod_ele_cot`, `nom_ele_cot`, `cod_ele_ba`, `cod_ele_ch`, `des_ele_cot`, `peso_ele_cot`, `ancho_ele_cot`, `cant_max_cot`, `notas`) VALUES
(2, 'JERSHEY', 'a3', 'a2', 'Descripcion jershey', 10.00, 20.00, 50.00, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `elementosord`
--

CREATE TABLE IF NOT EXISTS `elementosord` (
  `cod_eleord` int(11) NOT NULL AUTO_INCREMENT,
  `cod_ord` int(11) NOT NULL,
  `cod_presu_or` int(11) NOT NULL,
  `des_ord` char(255) NOT NULL,
  `anota_ord` char(255) NOT NULL,
  `precio_ba_ord` decimal(11,2) NOT NULL,
  `precio_china_ord` decimal(11,2) NOT NULL,
  `canti_ord` decimal(11,2) NOT NULL,
  PRIMARY KEY (`cod_eleord`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Volcado de datos para la tabla `elementosord`
--

INSERT INTO `elementosord` (`cod_eleord`, `cod_ord`, `cod_presu_or`, `des_ord`, `anota_ord`, `precio_ba_ord`, `precio_china_ord`, `canti_ord`) VALUES
(2, 2, 2, 'MODAL', 'ESTAMPADO', 9.00, 4.00, 0.00),
(3, 3, 5, 'tela', 'negra', 2.00, 2.00, 0.00),
(4, 1, 0, 'tela color negro', 'modal', 1.00, 1.00, 1.00),
(5, 4, 7, '1', '1', 1.00, 1.00, 0.00),
(6, 4, 7, '2', '2', 2.00, 2.00, 0.00),
(7, 4, 7, '3', '3', 3.00, 3.00, 0.00),
(8, 4, 7, '4', '4', 4.00, 4.00, 0.00),
(9, 4, 0, '5', '5', 5.00, 5.00, 5.00),
(10, 5, 8, '1', '1', 1.00, 1.00, 0.00),
(11, 5, 8, '2', '2', 2.00, 2.00, 0.00),
(12, 5, 8, '3', '3', 3.00, 3.00, 0.00),
(13, 5, 8, '4', '4', 4.00, 4.00, 0.00),
(14, 6, 9, '1', '1', 1.00, 2.00, 1.00),
(15, 6, 9, '2', '2', 2.00, 3.00, 2.00),
(16, 6, 9, '3', '3', 3.00, 4.00, 3.00),
(17, 6, 9, '6', '6', 6.00, 6.00, 7.00),
(18, 6, 0, '10', '10', 10.00, 10.00, 10.00),
(19, 6, 0, '0.5', '0.5', 0.50, 0.50, 0.50),
(20, 6, 0, '1', '1', 1.00, 1.00, 1.00),
(21, 7, 10, '1', '1', 1.00, 1.00, 1.00),
(22, 8, 12, '1', '', 1.00, 1.00, 1.00),
(23, 8, 12, '2', '', 2.00, 2.00, 2.00),
(24, 8, 12, '3', '', 3.00, 3.00, 3.00),
(25, 8, 12, '4', '', 4.00, 4.00, 4.00),
(26, 8, 12, '5', '', 5.00, 5.00, 5.00),
(27, 9, 13, 'tela', 'negra', 1.00, 2.00, 3.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `elementospresu`
--

CREATE TABLE IF NOT EXISTS `elementospresu` (
  `cod_elepresu` int(11) NOT NULL AUTO_INCREMENT,
  `cod_presu` int(11) NOT NULL,
  `des_elepresu` char(255) NOT NULL,
  `anota_elepresu` char(255) NOT NULL,
  `precio_ba` decimal(11,2) NOT NULL,
  `precio_china` decimal(11,2) NOT NULL,
  `canti_presu` decimal(11,2) NOT NULL,
  PRIMARY KEY (`cod_elepresu`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Volcado de datos para la tabla `elementospresu`
--

INSERT INTO `elementospresu` (`cod_elepresu`, `cod_presu`, `des_elepresu`, `anota_elepresu`, `precio_ba`, `precio_china`, `canti_presu`) VALUES
(1, 1, 'tela color negro', 'modal', 1.00, 1.00, 1.00),
(2, 2, 'MODAL', 'ESTAMPADO', 9.00, 4.00, 24000.00),
(3, 3, 'MODAL', 'ESTAMPADO', 9.00, 4.00, 0.00),
(4, 4, 'negra', 'as', 1.00, 1.00, 1.00),
(5, 4, 'verde', 'yerset', 2.00, 2.00, 2.00),
(6, 5, 'tela', 'negra', 2.00, 2.00, 4.00),
(7, 6, 'jersey', 'negra', 30.23, 23.11, 4.00),
(8, 6, 'tela', 'negra', 30.23, 23.11, 4.00),
(9, 6, 'verde', 'azul', 1.00, 1.00, 1.00),
(10, 7, '1', '1', 1.00, 1.00, 1.00),
(11, 7, '2', '2', 2.00, 2.00, 2.00),
(12, 7, '3', '3', 3.00, 3.00, 3.00),
(13, 7, '4', '4', 4.00, 4.00, 4.00),
(14, 8, '1', '1', 1.00, 1.00, 0.00),
(15, 8, '2', '2', 2.00, 2.00, 0.00),
(16, 8, '3', '3', 3.00, 3.00, 0.00),
(17, 8, '4', '4', 4.00, 4.00, 0.00),
(18, 9, '1', '1', 1.00, 2.00, 1.00),
(19, 9, '2', '2', 2.00, 3.00, 2.00),
(20, 9, '3', '3', 3.00, 4.00, 3.00),
(21, 9, '6', '6', 6.00, 6.00, 7.00),
(22, 10, '1', '1', 1.00, 1.00, 1.00),
(23, 11, '1', '1', 1.00, 1.00, 1.00),
(24, 12, '1', '', 1.00, 1.00, 1.00),
(25, 12, '2', '', 2.00, 2.00, 2.00),
(26, 12, '3', '', 3.00, 3.00, 3.00),
(27, 12, '4', '', 4.00, 4.00, 4.00),
(28, 12, '5', '', 5.00, 5.00, 5.00),
(29, 13, 'tela', 'negra', 1.00, 2.00, 3.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `embarques`
--

CREATE TABLE IF NOT EXISTS `embarques` (
  `cod_emb` int(11) NOT NULL AUTO_INCREMENT,
  `cod_ord` int(11) NOT NULL,
  `num_bl` varchar(25) COLLATE utf8_bin NOT NULL,
  `fe_inst_emb` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fe_emb` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `fe_llegada_emb` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `estado_emb` varchar(1) COLLATE utf8_bin NOT NULL,
  `notas_emb` char(150) COLLATE utf8_bin NOT NULL,
  `file_emb` varchar(250) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`cod_emb`),
  UNIQUE KEY `cod_emb` (`cod_emb`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `embarques`
--

INSERT INTO `embarques` (`cod_emb`, `cod_ord`, `num_bl`, `fe_inst_emb`, `fe_emb`, `fe_llegada_emb`, `estado_emb`, `notas_emb`, `file_emb`) VALUES
(1, 2, '1111', '2015-04-18 06:00:00', '2015-04-19 06:00:00', '2015-04-20 06:00:00', '4', 'vvvvvvvvv', ''),
(4, 9, '23', '2015-07-02 06:00:00', '2015-07-02 06:00:00', '2015-07-02 06:00:00', '1', '', 'logo_lg.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturadetalles`
--

CREATE TABLE IF NOT EXISTS `facturadetalles` (
  `cod_facdet` int(11) NOT NULL AUTO_INCREMENT,
  `cod_fac` int(11) NOT NULL,
  `monto_uss_facdet` decimal(11,2) NOT NULL,
  `monto_ar_facdet` decimal(11,2) NOT NULL,
  `des_facdet` varchar(40) NOT NULL,
  `cod_variable` int(11) NOT NULL,
  `canti_facdet` decimal(11,2) NOT NULL,
  PRIMARY KEY (`cod_facdet`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `facturadetalles`
--

INSERT INTO `facturadetalles` (`cod_facdet`, `cod_fac`, `monto_uss_facdet`, `monto_ar_facdet`, `des_facdet`, `cod_variable`, `canti_facdet`) VALUES
(1, 1, 1.00, 0.00, 'tela color negro', 1, 0.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

CREATE TABLE IF NOT EXISTS `facturas` (
  `cod_fac` int(11) NOT NULL AUTO_INCREMENT,
  `cod_cli` int(11) NOT NULL,
  `monto_fac` decimal(11,2) NOT NULL,
  `fe_fac` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `monto_ar_fac` decimal(11,2) NOT NULL,
  `tipo_fac` varchar(1) NOT NULL,
  `destino` varchar(10) NOT NULL,
  `cod_ord` int(11) NOT NULL,
  `estado_fac` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`cod_fac`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `facturas`
--

INSERT INTO `facturas` (`cod_fac`, `cod_cli`, `monto_fac`, `fe_fac`, `monto_ar_fac`, `tipo_fac`, `destino`, `cod_ord`, `estado_fac`) VALUES
(1, 1, 0.00, '2015-03-09 06:00:00', 0.00, '', 'BHI', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas_ingresantes`
--

CREATE TABLE IF NOT EXISTS `facturas_ingresantes` (
  `cod_fac_ing` bigint(20) NOT NULL AUTO_INCREMENT,
  `lugar_fac_ing` varchar(50) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `cod_ord` bigint(20) NOT NULL,
  `arch_fac_ing` varchar(200) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `nro_fac_ing` bigint(20) NOT NULL,
  `fe_a_fac_ing` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `met_pag_fac_ing` varchar(1) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `banco_fac_ing` varchar(50) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `tipo_fac_ing` varchar(1) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `percep_iva_fac_ing` float(10,2) NOT NULL,
  `ganancias_fac_ing` float(10,2) NOT NULL,
  `gravado_fac_ing` float(10,2) NOT NULL,
  `iva_ins_fac_ing` float(10,2) NOT NULL,
  `iva_no_ins_fac_ing` float(10,2) NOT NULL,
  `nro_remito_fac_ing` bigint(20) NOT NULL,
  `recep_iibb_fac_ing` float(10,2) NOT NULL,
  `no_grabado_fac_ing` float(10,2) NOT NULL,
  `total_fac_ing` float(10,2) NOT NULL,
  `fe_cierre_fac` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`cod_fac_ing`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Volcado de datos para la tabla `facturas_ingresantes`
--

INSERT INTO `facturas_ingresantes` (`cod_fac_ing`, `lugar_fac_ing`, `cod_ord`, `arch_fac_ing`, `nro_fac_ing`, `fe_a_fac_ing`, `met_pag_fac_ing`, `banco_fac_ing`, `tipo_fac_ing`, `percep_iva_fac_ing`, `ganancias_fac_ing`, `gravado_fac_ing`, `iva_ins_fac_ing`, `iva_no_ins_fac_ing`, `nro_remito_fac_ing`, `recep_iibb_fac_ing`, `no_grabado_fac_ing`, `total_fac_ing`, `fe_cierre_fac`) VALUES
(8, 'Terminal', 2, '', 123, '2015-05-20 23:27:01', 'C', '', 'F', 100000000.00, 0.00, 0.00, 0.00, 0.00, 0, 0.00, 0.00, 111111.11, '2016-05-01 06:00:00'),
(9, 'Ivetra/Tap', 2, '', 2, '2015-05-19 06:00:00', 'C', '', 'F', 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0.00, 0.00, 5.00, '0000-00-00 00:00:00'),
(11, 'Transporte', 2, '', 9, '2015-05-19 06:00:00', 'C', '', 'F', 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0.00, 0.00, 123.00, '0000-00-00 00:00:00'),
(12, 'Seguridad', 1, '10325575_1539294399432580_403173802302584646_n.jpg', 1, '2015-05-21 06:00:00', 'E', '', 'F', 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0.00, 0.00, 1.00, '0000-00-00 00:00:00'),
(13, 'Transporte', 1, 'business-cards-51.jpg', 1, '2015-05-21 06:00:00', 'E', '', 'F', 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0.00, 0.00, 1.00, '0000-00-00 00:00:00'),
(14, 'Transporte', 1, '', 2, '2015-05-22 16:15:25', 'E', '', 'F', 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0.00, 0.00, 2.00, '0000-00-00 00:00:00'),
(15, 'Seguridad', 7, '', 1, '2015-06-02 06:00:00', 'E', '', 'F', 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0.00, 0.00, 0.00, '0000-00-00 00:00:00'),
(16, 'Terminal', 8, '021 caratula.jpg', 124535, '2015-06-30 06:00:00', 'B', '', 'F', 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0.00, 0.00, 0.00, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inspectionpictures`
--

CREATE TABLE IF NOT EXISTS `inspectionpictures` (
  `cod_ins_pic` int(11) NOT NULL AUTO_INCREMENT,
  `cod_ord` int(11) NOT NULL,
  `insp_pic` varchar(1) COLLATE utf8_bin NOT NULL,
  `file_desp` varchar(150) COLLATE utf8_bin NOT NULL,
  `fe_desp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `num_desp` varchar(25) COLLATE utf8_bin NOT NULL,
  `monto_desp` decimal(11,2) NOT NULL,
  `tip_cam_desp` varchar(1) COLLATE utf8_bin NOT NULL,
  `moto_ar_desp` decimal(11,2) NOT NULL,
  `pos_ara` decimal(11,2) NOT NULL,
  `der_imp` decimal(11,2) NOT NULL,
  `multa_desp` decimal(11,2) NOT NULL,
  `iva_desp` decimal(11,2) NOT NULL,
  `ara_desp` decimal(11,2) NOT NULL,
  `ing_bru` decimal(11,2) NOT NULL,
  `met_pag_desp` varchar(1) COLLATE utf8_bin NOT NULL,
  `banco_desp` varchar(30) COLLATE utf8_bin NOT NULL,
  `tas_estad` decimal(11,2) NOT NULL,
  `iva_ad_desp` decimal(11,2) NOT NULL,
  `imp_gan` decimal(11,2) NOT NULL,
  `serv_guar` decimal(11,2) NOT NULL,
  `djai` bigint(20) NOT NULL,
  PRIMARY KEY (`cod_ins_pic`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `inspectionpictures`
--

INSERT INTO `inspectionpictures` (`cod_ins_pic`, `cod_ord`, `insp_pic`, `file_desp`, `fe_desp`, `num_desp`, `monto_desp`, `tip_cam_desp`, `moto_ar_desp`, `pos_ara`, `der_imp`, `multa_desp`, `iva_desp`, `ara_desp`, `ing_bru`, `met_pag_desp`, `banco_desp`, `tas_estad`, `iva_ad_desp`, `imp_gan`, `serv_guar`, `djai`) VALUES
(1, 2, '', '', '2015-04-17 06:00:00', '222', 22.00, '', 22.00, 22.00, 22.00, 22.00, 22.00, 22.00, 0.00, 'E', '22', 22.00, 22.00, 22.00, 22.00, 22),
(2, 7, '', '', '2015-06-17 06:00:00', '123rtyr', 0.00, '', 111.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 'B', 'Nacion', 0.00, 0.00, 0.00, 0.00, 0),
(3, 8, '', '051134-H.pdf', '2015-06-30 06:00:00', '14001ic0440', 0.00, '', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '', '', 0.00, 0.00, 0.00, 0.00, 0),
(4, 9, '', 'logo_lg.png', '2015-07-02 06:00:00', '', 0.00, '', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '', '', 0.00, 0.00, 0.00, 0.00, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ordenes`
--

CREATE TABLE IF NOT EXISTS `ordenes` (
  `cod_ord` int(11) NOT NULL AUTO_INCREMENT,
  `cod_cli` int(11) NOT NULL,
  `num_unico` int(11) unsigned zerofill NOT NULL,
  `observa_ord` char(150) COLLATE utf8_bin NOT NULL,
  `cod_presu_or` int(11) NOT NULL,
  `contrato_or` char(100) COLLATE utf8_bin NOT NULL,
  `pi_or` char(100) COLLATE utf8_bin NOT NULL,
  `po_or` char(100) COLLATE utf8_bin NOT NULL,
  `fe_alt_ord` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fe_ul_mod` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `destino` varchar(10) COLLATE utf8_bin NOT NULL,
  `estado_ord` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`cod_ord`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `ordenes`
--

INSERT INTO `ordenes` (`cod_ord`, `cod_cli`, `num_unico`, `observa_ord`, `cod_presu_or`, `contrato_or`, `pi_or`, `po_or`, `fe_alt_ord`, `fe_ul_mod`, `destino`, `estado_ord`) VALUES
(1, 1, 00000000002, 'tela ...', 1, '', '', '', '2015-03-09 17:23:28', '0000-00-00 00:00:00', 'BSD', 0),
(2, 2, 00000000001, '', 2, 'CONTRATO MODELO 037 (1).doc', 'PI CLIENTE.xlsx', 'PO FIRMADA.pdf', '2015-03-09 23:13:05', '0000-00-00 00:00:00', 'BHI', 0),
(3, 1, 00000000000, '', 5, '', '', '', '2015-04-21 22:53:08', '0000-00-00 00:00:00', '', 1),
(4, 2, 00000000000, '', 7, '', '', '', '2015-05-27 07:54:17', '0000-00-00 00:00:00', '', 1),
(5, 2, 00000000000, '', 8, '', '', '', '2015-05-27 08:01:58', '0000-00-00 00:00:00', '', 1),
(6, 1, 00000000000, '', 9, '', '', '', '2015-05-27 08:06:13', '0000-00-00 00:00:00', '', 1),
(7, 2, 00000000000, '', 10, '', '', '', '2015-05-28 18:15:45', '0000-00-00 00:00:00', 'BHI', 1),
(8, 2, 00000000003, 'PRUEBA DE DOCS', 12, 'CONTRATO MODELO 004.docx', 'PI CLIENTE.xlsx', '', '2015-06-30 17:38:03', '0000-00-00 00:00:00', '', 0),
(9, 2, 00000000004, '', 13, 'preparcial pasajeros aeropuerto.cpp', 'form1.scx', '', '2015-07-01 20:30:13', '0000-00-00 00:00:00', '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pos`
--

CREATE TABLE IF NOT EXISTS `pos` (
  `cod_presu` int(11) NOT NULL,
  `cod_po` int(11) NOT NULL,
  `des_po` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pos`
--

INSERT INTO `pos` (`cod_presu`, `cod_po`, `des_po`) VALUES
(11, 0, 'asd.jpg'),
(12, 0, 'PO CHINA.xls'),
(12, 0, 'FORMULARIO DE PAGOS POLO.xlsx'),
(13, 0, 'jquery-1.9.0.min.js');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presupuestos`
--

CREATE TABLE IF NOT EXISTS `presupuestos` (
  `cod_presu` int(11) NOT NULL AUTO_INCREMENT,
  `cod_cli` int(11) NOT NULL,
  `observa_presu` char(150) NOT NULL,
  `estado_presu` int(1) NOT NULL DEFAULT '1',
  `contrato` char(100) NOT NULL,
  `pi` char(100) NOT NULL,
  `po` char(100) NOT NULL,
  `fecha_alta` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`cod_presu`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Volcado de datos para la tabla `presupuestos`
--

INSERT INTO `presupuestos` (`cod_presu`, `cod_cli`, `observa_presu`, `estado_presu`, `contrato`, `pi`, `po`, `fecha_alta`) VALUES
(1, 1, 'tela ...', 2, '', '', '', '2015-03-09 17:23:28'),
(2, 2, '', 2, '', '', '', '2015-03-09 23:13:05'),
(3, 2, '', 0, '', '', '', '2015-04-16 01:10:23'),
(4, 2, '', 1, '', '', '', '2015-04-21 17:20:58'),
(5, 1, '', 2, '', '', '', '2015-04-21 22:53:08'),
(6, 2, '', 1, '', '', '', '2015-05-27 07:43:08'),
(7, 2, '', 2, '', '', '', '2015-05-27 07:54:17'),
(8, 2, '', 2, '', '', '', '2015-05-27 08:01:58'),
(9, 1, '', 2, '', '', '', '2015-05-27 08:06:13'),
(10, 2, '', 2, '', '', '', '2015-05-28 18:15:45'),
(11, 2, 'esto es una prueba', 1, '156438_569321466418893_1547001772_n.jpg', 'batman.png', 'ff3e9391dad72402b2d574b29b792043.jpg', '2015-06-10 16:51:49'),
(12, 2, 'PRUEBA DE DOCS', 2, 'CONTRATO MODELO 004.docx', 'PI CLIENTE.xlsx', '', '2015-06-30 17:38:03'),
(13, 2, '', 2, 'preparcial pasajeros aeropuerto.cpp', 'form1.scx', '', '2015-07-01 20:30:13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `cod_usu` int(11) NOT NULL AUTO_INCREMENT,
  `des_usu` char(20) NOT NULL,
  `clave` char(16) NOT NULL,
  PRIMARY KEY (`cod_usu`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`cod_usu`, `des_usu`, `clave`) VALUES
(1, 'admin', 'admin'),
(2, 'user', 'user'),
(3, 'usuario', 'usuario'),
(4, 'usuariob2', 'usuariob2'),
(5, 'usuariob3', 'usuariob');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
