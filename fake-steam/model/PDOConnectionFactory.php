<?php

class PDOConnectionFactory {

   public $connection = null;
   public $dbType = "mysql"; 
   public $host = "localhost";
   public $user = "example";
   public $senha = "example123";
   public $db = "padroes";
   public $persistent = false;

   public function PDOConnectionFactory($persistent = false) {
      if ($persistent != false) {
         $this->persistent = true;
      }
   }

   public function getConnection() {

      try {
         $this->connection = new PDO(
               $this->dbType . ":host=" . $this->host . ";dbname=" . $this->db,
               $this->user,
               $this->senha,
               array(PDO::ATTR_PERSISTENT => $this->persistent));
         $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         return $this->connection;
      } catch (PDOException $ex) {
         echo "Erro: impossível estabelecer conexão" . $ex->getMessage();
      }
   }

   public function close() {
      if ($this->connection != null){
         $this->connection = null;
      }
   }

}
