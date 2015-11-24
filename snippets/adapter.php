<?php
/**
 * @author Douglas Haubert <dhaubert.ti@gmail.com>
 * 
 * Princípios de classes com padrão adapter:
 *    - Classes que serao largamente utilizadas no codigo mas podem sofrer alteraçoes
 * Vantagens: 
 *    - flexibilidade
 *    - manutenção de codigo
 * 
 * Ex.: abaixo e ilustrada a implementaçao de uma classe que realiza interação com uma API arbitrária,
 * implementada apenas como exemplo para o Twitter
 */

class Twitter {
   
   public function tweet($mensagem){
      echo "Tweetando mensagem '{$mensagem}'.";
   }

}
class TwitterAdapter {
   private $twitter;
   function __construct($twitter) {
      $this->twitter = $twitter;
   }
   function enviarMensagem($mensagem){
      $this->twitter->tweet($mensagem);
   }

}


/**
 * Como seria feito sem o padrão
 * $twitter = new Twitter();
 * $twitter->tweet("Ola mundo");
 * ...
 * $twitter2 = new Twitter();
 * $twitter2->tweet("Hellooo");
 * 
 */
/** Resultado: 
 * eventualmente, se o twitter alterar o nome do método, 
 * de cara surge um fatal error em todas as instancias dessa classe
 */
// Como invocar:
$twitter = new TwitterAdapter(new Twitter());
$twitter->enviarMensagem("Mensagem adaptada.");
/** Resultado: 
 * objetos criados dinamicamente e manutenção para iphone se dá internamente na classe factory
 */