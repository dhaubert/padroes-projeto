<?php
/**
 * @author Douglas Haubert <dhaubert.ti@gmail.com>
 * 
 * Princípios de classes com padrão factory:
 *    - Classes que geralmente implementam uma interface ou herdam de classes abstratas,
 *       ou seja, que possuem elementos em comum para construir uma 'factory'
 *    - Classes que serao largamente utilizadas no codigo mas podem sofrer alteraçoes
 * Vantagens: 
 *    - flexibilidade
 *    - manutençao de código
 *    - teste
 * 
 * Ex.: abaixo e ilustrada a implementaçao de duas classes (samsung e iphone) 
 * que possuem uma classe generica (smartphone). Facilita para o desenvolvedor por nao
 * necessitar conhecer todas as implementacoes de classes no projeto e evita grandes refatoraçoes
 * quando essa classe necessitar manutençao
 */
interface smartphone {

   public function montar();
}

class iphone implements smartphone {

   public $isRetina;

   function __construct($isRetina) {
      $this->isRetina = $isRetina;
   }

   public function montar() {
      echo "<br/>Montando um iphone" . ($this->isRetina? " com tela de retina" : ".");
   }

}

class samsung implements smartphone {

   public $versaoAndroid;

   function __construct($numBotoes = 3, $versaoAndroid = '5.0.1') {
      $this->versaoAndroid = $versaoAndroid;
      $this->numBotoes = $numBotoes;
   }

   public function montar() {
      echo "<br/>Montando um smartphone samsung ANDROID v{$this->versaoAndroid} com {$this->numBotoes} botões.";
   }

}

class smartphoneFactory {

   public function criar($tipo) {
      //return new $tipo;
      switch ($tipo) {
         case 'samsung':
            return new samsung(3);
         case 'iphone': 
            return new iphone(true);
         default:
            break;
      }
   }

}

/**
 * Como seria feito sem o padrão
 * $iphone6 = new Iphone();
 * $iphone5 = new Iphone();
 * $iphone4S = new Iphone(false);
 * $s6 = new Samsung(3);
 * $s3 = new Samsung(3, '4.2.2');
 * $s10 = new Samsung(15, '10.1', false); //mudança de parametros no construtor
 * 
 */
/** Resultado: 
 * objetos criados um a um, caso tenha que alterar algum parâmetro, deve ser alterado em todas as instâncias
 * do objeto no projeto.
 */
// Como invocar:
$factory = new smartphoneFactory();
$iphone4S = $factory->criar('iphone');
$iphone5 = $factory->criar('iphone');
$samsungs6edge = $factory->criar('samsung');
$iphone4S->montar();
$iphone5->montar();
$samsungs6edge->montar();

/** Resultado: 
 * objetos criados dinamicamente e manutenção para iphone se dá internamente na classe factory
 */