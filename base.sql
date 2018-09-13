-- phpMyAdmin SQL Dump
-- version 3.3.3
-- http://www.phpmyadmin.net
--
-- Servidor: mysql08.uni5.net
-- Tempo de Geração: Abr 10, 2014 as 02:24 PM
-- Versão do Servidor: 5.1.70
-- Versão do PHP: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Banco de Dados: `npi`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

CREATE TABLE IF NOT EXISTS `categorias` (
  `id_categoria` int(4) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(50) NOT NULL,
  `arquivo` varchar(20) NOT NULL,
  `status` char(1) NOT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `log`
--

CREATE TABLE IF NOT EXISTS `log` (
  `id_log` int(4) NOT NULL AUTO_INCREMENT,
  `url` varchar(300) NOT NULL,
  `data` datetime NOT NULL,
  PRIMARY KEY (`id_log`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `noticias`
--

CREATE TABLE IF NOT EXISTS `noticias` (
  `id_noticia` int(4) NOT NULL AUTO_INCREMENT,
  `id_categoria` int(4) NOT NULL,
  `id_site` int(4) NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `image` varchar(300) NOT NULL,
  `link` varchar(300) NOT NULL,
  `fonte` varchar(30) NOT NULL,
  `data` datetime NOT NULL,
  `tipo` char(1) NOT NULL,
  `status` char(1) NOT NULL,
  PRIMARY KEY (`id_noticia`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `sites`
--

CREATE TABLE IF NOT EXISTS `sites` (
  `id_site` int(4) NOT NULL AUTO_INCREMENT,
  `id_categoria` int(4) NOT NULL,
  `site` varchar(50) NOT NULL,
  `arquivo` varchar(20) NOT NULL,
  `status` char(1) NOT NULL,
  `data_update` datetime NOT NULL,
  PRIMARY KEY (`id_site`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
