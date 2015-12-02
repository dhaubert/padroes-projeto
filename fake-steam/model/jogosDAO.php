<?php

include_once 'DAOInterface.php';

class jogosDAO implements DAOInterface {

   private $pdo;
   private $debug;

   function __construct() {
      include_once 'PDOConnectionFactory.php';
      $this->pdo = new PDOConnectionFactory();
   }

   function getDebug() {
      return $this->debug;
   }

   function setDebug($debug) {
      $this->debug = $debug;
      return $this;
   }

   public function create($jogo) {
      $stmt = $this->pdo->getConnection()->prepare("
         INSERT INTO 
            padroes.jogos 
               (nome, capa, tamanho, categoria_id, valor)
            VALUES 
               (:nome, :capa, :tamanho, :categoriaId, :valor");
      $stmt->bindValue(':nome', $jogo->getNome(), PDO::PARAM_STR);
      $stmt->bindValue(':capa', $jogo->getCapa(), PDO::PARAM_STR);
      $stmt->bindValue(':tamanho', $jogo->getTamanho(), PDO::PARAM_STR);
      $stmt->bindValue(':categoriaId', $jogo->getCategoria()->getCategoriaId(), PDO::PARAM_INT);
      $stmt->bindValue(':valor', $jogo->getValor(), PDO::PARAM_STR);
      $success = $stmt->execute();
      var_dump($success);
      if ($success) {
         $id = $this->pdo->geConnection()->lastInsertId();
         $jogo->setJogoId($id);
      } else {
         $this->showError($success, $stmt);
         $jogo = false;
      }
      $this->pdo->close();
      return $jogo;
   }

   public function delete($jogo) {
      $stmt = $this->pdo->getConnection()->prepare("
         DELETE FROM 
            padroes.jogos 
         WHERE
            jogo_id = :jogoId");
      $stmt->bindValue(':jogoId', $jogo->getJogoId(), PDO::PARAM_INT);
      $success = $stmt->execute();
      var_dump($success);
      $this->showError($success, $stmt);
      $this->pdo->close();
      return $success;
   }

   public function findById($jogo) {
      $stmt = $this->pdo->getConnection()->prepare("
         SELECT 
            * 
         FROM 
            padroes.jogos j
            JOIN categorias c ON (c.categoria_id = j.categoria_id)
         WHERE
            jogo_id = :jogoId");
      $stmt->bindValue(':jogoId', $jogo->getJogoId(), PDO::PARAM_INT);
      $success = $stmt->execute();
      if ($success) {
         $jogos = $stmt->fetchAll(PDO::FETCH_ASSOC);
         $jogosObjs = $this->objectArray($jogos);
         return $jogosObjs[0];
      } else {
         $this->showError($success, $stmt);
         return false;
      }
      $this->pdo->close();
   }

   public function update($jogo) {
      $stmt = $this->pdo->getConnection()->prepare("
         UPDATE  
            padroes.jogos
         SET
            nome = :nome,
            categoria_id = :categoriaId,
            capa = :capa,
            valor = :valor,
            tamanho = :tamanho
         WHERE 
            jogo_id = :jogoId");
      
      $stmt->bindValue(':jogoId', $jogo->getJogoId(), PDO::PARAM_INT);
      $stmt->bindValue(':nome', $jogo->getNome(), PDO::PARAM_STR);
      $stmt->bindValue(':capa', $jogo->getCapa(), PDO::PARAM_STR);
      $stmt->bindValue(':tamanho', $jogo->getTamanho(), PDO::PARAM_STR);
      $stmt->bindValue(':categoriaId', $jogo->getCategoria()->getCategoriaId(), PDO::PARAM_INT);
      $stmt->bindValue(':valor', $jogo->getValor(), PDO::PARAM_STR);
      $success = $stmt->execute();
      var_dump($success);
      $this->showError($success, $stmt);
      $this->pdo->close();
      return $success;
   }

   public function listAll() {
      $stmt = $this->pdo->getConnection()->prepare("
         SELECT 
            j.jogo_id, j.nome, j.tamanho, j.categoria_id, j.valor, j.capa,
            c.nome AS categoria_nome
         FROM 
            padroes.jogos j
            JOIN categorias c ON (c.categoria_id = j.categoria_id)
            ");
      $success = $stmt->execute();
      if ($success) {
         $jogos = $stmt->fetchAll(PDO::FETCH_ASSOC);
         return $this->objectArray($jogos);
      } else {
         $this->showError($success, $stmt);
         return false;
      }
      $this->pdo->close();
   }

   private function showError($success, $stmt) {
      if ($this->debug && !$success) {
         print_r($stmt->errorInfo());
      }
   }
   
   private function objectArray(Array $jogosArray){
      include_once './model/jogos.php';
      include_once './model/categorias.php';
      $objs = array();
      $i = 0;
      foreach($jogosArray as $jogo){
         $objs[$i] = new Jogos();
         $objs[$i]->setJogoId($jogo['jogo_id']);
         $objs[$i]->setNome($jogo['nome']);
         $objs[$i]->setTamanho($jogo['tamanho']);
         $objs[$i]->setCapa($jogo['capa']);
         $objs[$i]->setValor($jogo['valor']);
         $categoria = new Categorias();
         $categoria->setNome($jogo['categoria_nome']);
         $categoria->setCategoriaId($jogo['categoria_id']);
         $objs[$i]->setCategoria($categoria);
         $i++;
      }
      return $objs;
   }

}
