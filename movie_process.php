<?php

require_once("models/Movie.php");
require_once("models/Message.php");
require_once("dao/UserDAO.php");
require_once("dao/UserDAO.php");
require_once("dao/MovieDAO.php");
require_once("db.php");
require_once("globals.php");


$message = new Message($BASE_URL);
$userDao = new UserDAO($conn, $BASE_URL);
$movieDao = new MovieDAO($conn, $BASE_URL);

// RESGATA O TIPO DO FORMULARIO
$type = filter_input(INPUT_POST, "type");

//RESGATA DADOS DO USUARIO
$userData = $userDao->verifyToken();

if ($type === "create") {

  $title = filter_input(INPUT_POST, "title");
  $description = filter_input(INPUT_POST, "description");
  $trailer = filter_input(INPUT_POST, "trailer");
  $category = filter_input(INPUT_POST, "category");
  $length = filter_input(INPUT_POST, "length");

  $movie = new Movie();
  

  //VALIDAÇÃO
  if (empty($title) or empty($description) or empty($category)) {
    $message->setMessage("Você precisa adicionar (TÍTULO, DESCRIÇÃO E CATEGORIA)", "error", "back");
    exit;
  }
  
  $movie->title = $title;
  $movie->description = $description;
  $movie->trailer = $trailer;
  $movie->category = $category;
  $movie->length = $length;
  $movie->users_id = $userData->id;

  //UPLOAD IMG

  if (isset($_FILES['image']) && !empty($_FILES['image']['tmp_name'])) {
    
    $image = $_FILES['image'];
    print_r($image);
    $imageTypes = ['image/jpeg', 'image/jpg', 'image/png'];
    $jpgArray = ["image/jpg", "image/jpeg"];

    if (in_array($image['type'], $imageTypes)) {
      //CHECA SE É JPG
      if (in_array($image['type'], $jpgArray)) {
        $imageFile = imagecreatefromjpeg($image["tmp_name"]);
      }else {
        // IMAGEM PNG
        $imageFile = imagecreatefrompng($image["tmp_name"]);
      }

      $imageName = $movie->imageGenerateName();
      imagejpeg($imageFile, "./img/movies/" . $imageName, 100);

      $movie->image = $imageName;

    }else {
      $message->setMessage("Tipo de imagem Invalido, insira (PNG, JPEG ou JPG)!", "error", "back");
    }

  }

  $movieDao->create($movie);

}else {
  $message->setMessage("Informações invalidas!", "error", "back");
}