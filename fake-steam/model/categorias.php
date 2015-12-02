<?php

/**
 * @author Douglas Haubert <dhaubert.ti@gmail.com>
 * Categoria de jogos
 * SQL:
  CREATE TABLE `categorias` (
   `categoria_id` int(11) NOT NULL,
   `nome` varchar(45) DEFAULT NULL,
    PRIMARY KEY (`categoria_id`)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

 */
class categorias {
   private $categoriaId;
   private $nome;
   
   function __construct() {
      
   }
   function getCategoriaId() {
      return $this->categoriaId;
   }

   function getNome() {
      return $this->nome;
   }

   function setCategoriaId($categoriaId) {
      $this->categoriaId = $categoriaId;
      return $this;
   }

   function setNome($nome) {
      $this->nome = $nome;
      return $this;
   }
   

   

}

