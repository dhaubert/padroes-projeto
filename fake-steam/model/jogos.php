<?php
/**
 * @author Douglas Haubert <dhaubert.ti@gmail.com>
 * Classe para definir objeto jogo num caso de uso de uma loja de jogos online
 * SQL:
   CREATE TABLE `jogos` (
  `jogo_id` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  `valor` float(6,2) DEFAULT NULL,
  `capa` varchar(200) DEFAULT NULL,
  `tamanho` float(6,3) DEFAULT NULL COMMENT 'mb',
  PRIMARY KEY (`jogo_id`),
  KEY `fk_jogos_1_idx` (`categoria_id`),
  CONSTRAINT `fk_jogos_1` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`categoria_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

 */
class Jogos {
   private $jogoId;
   private $nome;
   private $valor;
   private $tamanho;
   private $categoria;
   private $capa;
   
   function __construct() {
      
   }
   function getJogoId() {
      return $this->jogoId;
   }

   function setJogoId($jogoId) {
      $this->jogoId = $jogoId;
      return $this;
   }

   function getNome() {
      return $this->nome;
   }

   function getValor() {
      return $this->valor;
   }

   function getTamanho() {
      return $this->tamanho;
   }

   function getCategoria() {
      return $this->categoria;
   }

   function setNome($nome) {
      $this->nome = $nome;
      return $this;
   }

   function setValor($valor) {
      $this->valor = $valor;
      return $this;
   }

   function setTamanho($tamanho) {
      $this->tamanho = $tamanho;
      return $this;
   }

   function setCategoria($categoria) {
      $this->categoria = $categoria;
      return $this;
   }
   function getCapa() {
      return $this->capa;
   }

   function setCapa($capa) {
      $this->capa = $capa;
      return $this;
   }



}

