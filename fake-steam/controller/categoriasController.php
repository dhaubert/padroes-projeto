<?php

class categoriasController {
   private $model;
   function __construct() {
      include_once './model/categoriasDAO.php';
      $this->model = new categoriasDAO();
   }
   function todasCategorias(){
      return $this->model->listAll();
   }

}

