<!DOCTYPE html>
<html>
   <head>
      <meta charset="UTF-8">
      <title> Fake Steam - Sua loja de jogos online </title>
      <link rel="stylesheet" href="/fake-steam/assets/bootstrap/css/bootstrap.min.css"/>
      <script type="text/javascript" src="/fake-steam/assets/jquery.min.js"></script>
      <script type="text/javascript" src="/fake-steam/assets/bootstrap/js/bootstrap.min.js"></script>
   </head>
         <div class="page-header">
        <h1>Fake Steam <small>Sua loja de jogos online</small></h1>
      </div>
      <?php
         $action = isset($_GET['action'])? $_GET['action'] : 'index';
         include_once "controller/jogosController.php";
         $controller = new jogosController();
         $controller->$action();
      ?>
   </body>
</html>