<?php

require_once("models/User.php");
require_once("models/Message.php");
require_once("dao/UserDAO.php");
require_once("db.php");
require_once("globals.php");

$message = new Message($BASE_URL);
$userDao = new UserDAO($conn, $BASE_URL);

// RESGATA O TIPO DO FORMULARIO
$type = filter_input(INPUT_POST, "type");

// ATUALIZAR USUARIO
if ($type === "update") {
  //RESGATA DADOS DO USUARIO
  $userData = $userDao->verifyToken();

  $name = filter_input(INPUT_POST, "name");
  $lastname = filter_input(INPUT_POST, "lastname");
  $email = filter_input(INPUT_POST, "email");
  $bio = filter_input(INPUT_POST, "bio");
  
  // CRIAR NOVO OBJETO
  $user = new User();

  $userData->name = $name;
  $userData->lastname = $lastname;
  $userData->email = $email;
  $userData->bio = $bio;

  //UPLOAD DA IMAGEM
  if (isset($_FILES['image']) && !empty($_FILES['image']['tmp_name'])) {
    $image = $_FILES['image'];
    $imageTypes = ["image/jpeg", "image/png", "image/jpg"];
    $jpgArray = ["image/jpg", "image/jpeg"];
    // VALIDANDO IMAGEM
    if (in_array($image['type'], $imageTypes)) {
    
      if (in_array($image, $jpgArray)) {
        $imageFile = imagecreatefromjpeg($image["tmp_name"]);
        
      }else {
        // IMAGEM PNG
        $imageFile = imagecreatefrompng($image["tmp_name"]);
        
      }

      $imageName = $user->imageGenerateName();
      imagejpeg($imageFile, "./img/users/" . $imageName, 100);

      $userData->image = $imageName;

    }else {
    $message->setMessage("Tipo de imagem Invalido, insira (PNG, JPEG ou JPG)!", "error", "back");
    }

  }
  
  $userDao->update($userData);

 //ATUALIZAR SENHA DO USUARIO 
}else if($type === "changepassword"){

  $password = filter_input(INPUT_POST, "password");
  $confirmpassword = filter_input(INPUT_POST, "confirmpassword");
  //RESGATA DADOS DO USUARIO
  $userData = $userDao->verifyToken();
  $id = $userData->id;
  
  if ($password == $confirmpassword) {
    
    $user = new User();

    $finalPassword = $user->generatePassword($password);

    $user->password = $finalPassword;
    $user->id = $id;

    $userDao->changePassword($user);

  }else {
    $message->setMessage("As senhas Não são iguais!", "error", "back");
  }

}else{

  $message->setMessage("Informações invalidas!", "error", "/index.php");
}

