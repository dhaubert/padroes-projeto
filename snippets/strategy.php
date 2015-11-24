<?php

/**
 * @author Douglas Haubert <dhaubert.ti@gmail.com>
 * 
 * Princípios de classes com padrão strategy:
 *   - Usadas quando há opções diferentes de tratar o mesmo problema, em tempo de execução
 * Vantagens: 
 *    - Desempenho
 * Ex.: Abaixo está ilustrada a implementação de uma classe para ordenação de um array de dados 
 * quaisquer. Caso o conjunto de dados for muito grande, executa um algoritmo com melhor eficiência,
 * caso contrário
 *
 * */
class QuickSort{

   private $dados;

   function __construct(Array $dados) {
      $this->dados = $dados;
   }

   public function sort() {
      /** quicksort 
       * @author PageConfig em http://pageconfig.com/post/implementing-quicksort-in-php
       */
      if (count($this->dados) < 2) {
         return $this->dados;
      }
      $left = $right = array();
      reset($this->dados);
      $pivot_key = key($this->dados);
      $pivot = array_shift($this->dados);
      foreach ($this->dados as $k => $v) {
         if ($v < $pivot) {
            $left[$k] = $v;
         } else {
            $right[$k] = $v;
         }
      }
      return array_merge(quicksort($left), array($pivot_key => $pivot), quicksort($right));
   }

}

class InsertSort{

   private $dados;

   function __construct(Array $dados) {
      $this->dados = $dados;
   }

   public function sort() {
      /** InsertSort
       * @author Udit em https://www.numetriclabz.com/insertion-sort-in-php/
       */
      $sortedArray = array();
      for ($i = 0; $i < count($this->dados); $i++) {
         $element = $this->dados[$i];
         $j = $i;
         while ($j > 0 && $sortedArray[$j - 1] > $element) {
            $sortedArray[$j] = $sortedArray[$j - 1];
            $j = $j - 1;
         }
         $sortedArray[$j] = $element;
      }
      return $sortedArray;
   }

}
/** Aqui fica a base do Strategy
 * Ordem um conjunto de dados de acordo com seu tamanho. Caso tenha mais de 100 dados, irá realizar
 * quicksort, caso contrário executará o algoritmo de inserção.
 * @param array $dados Dados que serão ordenados
 * @return array Dados ordenados
 */
function ordena(array $dados) {
   if (count($dados) > 100) {
      $obj = new QuickSort($dados);
   } else {
      $obj = new InsertSort($dados);
   }
   return $obj->sort();
}


/**
 * Exemplo de chamada sem o padrão:
 * sempre quicksort, independente do tamanho ou da sequencia dos dados
 * $dados = array(1,2,3,1,2,3,5,6,6,2,1);
 * $quick = new QuickSort($dados);
 * $dados = $quick->sort();
 * 
 */

$dados = array('banana', 'abacate', 'uva', 'chinelo', 'cafe');
$dados = ordena($dados);
print_r($dados);
/**
 * Resultado: trará sempre os dados ordenados com a melhor estratégia para o desempenho
 */