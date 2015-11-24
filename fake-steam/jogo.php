<?php
/**
 * @author Douglas Haubert <dhaubert.ti@gmail.com>
 * Classe para definir objeto jogo num caso de uso de uma loja de jogos online
 * SQL:
 * CREATE TABLE `examples`.`jogo` (
  `jogo_id` INT(11) NOT NULL,
  `nome` VARCHAR(100) NULL,
  `categoria_id` INT(11) NULL,
  `valor` FLOAT(6,2) NULL,
  `capa` VARCHAR(200) NULL,
  `tamanho` FLOAT(6,3) NULL COMMENT 'mb',
  PRIMARY KEY (`jogo_id`));
 */
class Jogo {
   private $nome;
   private $valor;
   private $tamanho;
   private $categoria;
   private $capa;
   
   function __construct() {
      
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

