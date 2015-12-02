<?php
include_once 'DAOInterface.php';
class categoriasDAO implements DAOInterface{

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

   public function create($categoria) {
      
   }

   public function delete($categoria) {
      
   }

   public function findById($categoria) {
      
   }

   public function listAll() {
      $stmt = $this->pdo->getConnection()->prepare("
         SELECT 
            * 
         FROM 
            padroes.categorias
            ");
      $success = $stmt->execute();
      if ($success) {
         $categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);
         return $this->objectArray($categorias);
      } else {
         $this->showError($success, $stmt);
         return false;
      }
      $this->pdo->close();
   }

   public function update($categoria) {
      
   }
   
   private function objectArray($categorias){
      include_once './model/categorias.php';
      $objs = array();
      $i = 0;
      foreach($categorias as $categoria){
         $objs[$i] = new Categorias();
         $objs[$i]->setNome($categoria['nome']);
         $objs[$i]->setCategoriaId($categoria['categoria_id']);
         $i++;
      }
      return $objs;
   }

}
