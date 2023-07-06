<?php
  require_once("template/header.php");
  //VERIFICA SE  USUARIO ESTA AUTENTICADO 
  require_once("dao/MovieDAO.php");
  require_once("models/Movie.php");

  //pegar id do filme
  $id = filter_input(INPUT_GET, "id");

  $movie;

  $movieDao = new MovieDAO($conn, $BASE_URL);

  if (empty($id)) {
    $message->setMessage("O Filme não foi encontrado!", "error", "/index.php");
    exit;
  }

  $movie = $movieDao->findById($id);

  // verifica se o filme existe
  if (!$movie) {
    $message->setMessage("O Filme não foi encontrado!", "error", "/index.php");
    exit;
  }

  

?>