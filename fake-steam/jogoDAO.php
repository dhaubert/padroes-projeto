<?php

class jogoDAO extends DAO implements DAOInterface{
   private $jogo;
   private $pdo;
   function __construct($jogo = NULL) {
      $this->jogo = $jogo;
      $this->pdo = new PDOConnectionFactory();
   }

   public function create($jogo) {
      
   }

   public function delete($jogo) {
      
   }

   public function findById($id) {
      
   }

   public function update($jogo) {
      
   }

}

