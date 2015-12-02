<?php
class JogosController {
      private $model;
      public function __construct() {
         include_once './view/jogosView.php';
         include_once "./model/jogosDAO.php";
         include_once "./model/jogos.php";
         $this->model = new JogosDAO();
      }
      public function index(){
         $jogos = $this->model->listAll();
         $parametros = array('jogos'=> $jogos);
         $view = new JogosView();
         $view->visualizar($parametros);
      }
      public function adicionar(){
         if($_POST['adicionar']){
            
         }
         include_once 'categoriasController.php';
         $catController = new categoriasController();
         $categorias = $catController->todasCategorias();
         $view = new JogosView();
         $parametros = array('categorias' => $categorias);
         $view->criarEditar($parametros);
      }
      public function editar(){
         echo "editar";
      }
      public function excluir(){
         echo "excluir";
      }
      public function visualizar(){
         $id = $_GET['id'];
         if(is_numeric($id)){
            $game = new Jogos();
            $game->setJogoId($id);
            $jogo = $this->model->findById($game);
            $view = new JogosView();
            $parametros = array('jogo' => $jogo);
            $view->comprar($parametros);
         }
      }
      
}
