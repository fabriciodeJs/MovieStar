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

// VERIFICA O TIPO DO FORMULARIO
if ($type === "register") {
  
  $name = filter_input(INPUT_POST, "name");
  $lastname = filter_input(INPUT_POST, "lastname");
  $email = filter_input(INPUT_POST, "email");
  $password = filter_input(INPUT_POST, "password");
  $confirmpassword = filter_input(INPUT_POST, "confirmpassword");

  // VERIFICAÇÃO DE DADOS MINIMOS 
  if ($name && $lastname && $email && $password) {
    // VERIFICAR SENHA
    if ($password !== $confirmpassword){
      $message->setMessage("As senhas não são iguais.", "error", "back");
      die();
    }
    // VERIFICAR SE JA EXISTE O EMAIL CADASTRADO
    if ($userDao->findByEmail($email)){
      $message->setMessage("E-mail Ja Cadastrado, tente outro e-mail.", "error", "back");
      die();
    }

    $user = new User();

    //CRIAÇÃO DE TOKEN E SENHA
    $userToken = $user->generateToken();
    $finalPassword = $user->generatePassword($password);

    $user->name = $name;
    $user->lastname = $lastname;
    $user->email = $email;
    $user->password = $finalPassword;
    $user->token = $userToken;

    $auth = true;

    $userDao->create($user, $auth);

  }else {
    // ENVIAR MESAGEM DE ERRO, DE FALTA DE DADOS
    $message->setMessage("Por favor, Preencha todos os campos.", "error", "back");
  }

} else if($type === "login") {
  


}