<?php

class jogosView {

   function __construct() {
      
   }

   function criarEditar($parametros) {
      $categorias = $parametros['categorias'];
      $jogo = $parametros['jogo'];
      $titulo = "Cadastro de jogos";
      if (isset($jogo)) {
         $jogoId = $jogo->getJogoId();
         $jogoNome = $jogo->getNome();
         $jogoCategoriaId = $jogo->getCategoria()->getCategoriaId();
         $jogoTamanho = $jogo->getTamanho();
         $jogoValor = $jogo->getValor();
         $titulo = "Edição de jogos";
      }
      print_r($jogo);
      ob_start();
      ?>
      <h2><?= $titulo ?> </h2>
      <div id="div-add-jogos">
         <form name="formJogos" class="form-control">
            <input type="hidden" id="jogoId" name="jogoId" value="<?= $jogoId ?>"/>
            <div class="form-group">
               <label for="nome">Nome</label>
               <input class='form-control' type="text" id="nome" name="nome" value="<?= $jogoNome ?>"/>
            </div>
            <div class="form-group">
               <label for="nome">Categoria</label>
               <input class='form-control' type="text" id="nome" name="nome" value="<?= $jogoNome ?>"/>
            </div>
            <div class="form-group">
               <label for="categorias">Categoria</label>
               <?php echo $this->selectCategoria($categorias, $jogoCategoriaId); ?>
            </div>
            <div class="form-group">
               <label for="capa">URL Imagem capa</label>
               <input type="text" id="capa" name="capa" value="<?= $jogo->getCapa(); ?>"/>
            </div>
            <div class="form-group">
               <label for="tamanho">Tamanho (MB)</label>
               <input type="number" step="1" id="tamanho" name="tamanho" value="<?= $jogoTamanho ?>"/>
            </div>
            <div class="form-group">
               <label for="valor">Valor (R$)</label>
               <input type="number" step="1.0" id="valor" name="valor" value="<?= $jogoValor ?>"/>
            </div>
         </form>
      </div>
      <?php
      echo ob_get_clean();
   }

   function visualizar($parametros) {
      $jogos = $parametros['jogos'];
      echo '<pre>';
      print_r($jogos);
      echo '</pre>';
      ob_start();
      ?>
      <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
         <!-- Indicators -->
         <ol class="carousel-indicators">
            <?php
            for ($i = 0; $i < count($jogos); $i++) {
               ?>
               <li data-target="#carousel-example-generic" data-slide-to="<?= $i ?>" class="<?= $i == 0 ? 'active' : '' ?>"></li>
               ?<?php } ?>
         </ol>

         <!-- Wrapper for slides -->
         <div class="carousel-inner" role="listbox">
            <?php
            for ($i = 0; $i < count($jogos); $i++) {
               $jogo = $jogos[$i];
               ?>
               <div class="item <?= $i == 0 ? 'active' : '' ?>">
                  <img src="<?= $jogo->getCapa() ?>" alt="<?= $jogo->getNome() ?>">
                  <div class="carousel-caption">
                     <?= $jogo->getNome() ?> 
                     <a href="/fake-steam/?action=visualizar&id=<?= $jogo->getJogoId(); ?>" >
                        Comprar por R$ <?= $jogo->getValor() ?>
                     </a>
                  </div>
                  <div></div>
               </div>
               <?php
            }
            ?>
            <!-- Controls -->
            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
               <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
               <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
               <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
               <span class="sr-only">Next</span>
            </a>
         </div>
         <?php
         echo ob_get_clean();
      }

      function selectCategoria($categorias, $selectedId) {
         ob_start();
         ?>
         <select name="categorias" id='categorias' class="dropdown">
            <option value="false">Selecione uma categoria</option>
            <?php
            foreach ($categorias as $categoria) {
               $selected = $categoria->getCategoriaId() == $selectedId ? "selected" : "";
               ?>
               <option <?= $selected ?> value='<?= $categoria->getCategoriaId(); ?>'>
                  <?= $categoria->getNome(); ?>
               </option>
               <?php
            }
            ?>
         </select>
         <?php
         $select = ob_get_clean();
         return $select;
      }
      
      public function comprar($parametros){
         echo '<pre>';
         print_r($parametros['jogo']);
         echo '</pre>';
      }

   }
   ?>