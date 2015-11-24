<?php

/**
 * @author Douglas Haubert <dhaubert.ti@gmail.com>
 * 
 * Princípios de classes com padrão singleton:
 *   - Usadas para serem utilizadas em contexto global
 *   - Apenas uma instância em várias chamadas da classe
 * Vantagens: 
 *    - economia de memória e desempenho
 *    - acesso central a esta instancia
 * Ex.: Abaixo está ilustrada a implementação de uma classe para ações com banco de dados
 * mas podem ser usadas também para configurações, banco de dados 
 * e quaisquer valores comuns em todo escopo do projeto
 *
 * */
class DatabaseSingleton {

   public static $instance;

   private function __construct() {
      // Construtor private não vai permitir qualquer instância fora desta classe 
   }
   private function __clone() {
      // Clone private não vai permitir qualquer clonagem da instância
   }

   public static function getInstance() {
      if (!isset(DatabaseSingleton::$instance)) {
         DatabaseSingleton::$instance = new DatabaseSingleton();
      }
      return DatabaseSingleton::$instance;
   }
   public function connect(){
      // conexão com banco
   }

}

/**
 * Como seria feito sem o padrão
 * $database = new Database();
 * $database2 = new Database();
 * 
 * Resultado:
 * var_dump($database); //object(Database)#1 (0) { }
 * var_dump($database2); //object(Database)#2 (0) { } 
 */

// Como invocar:
$database = DatabaseSingleton::getInstance();
$database2 = DatabaseSingleton::getInstance();

// Resultado: ambas as instâncias possuem o mesmo ID, 
var_dump($database); //object(DatabaseSingleton)#1 (0) { }
var_dump($database2); //object(DatabaseSingleton)#1 (0) { } 
