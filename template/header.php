<?php
  require_once("globals.php");
  require_once("db.php");
  require_once("models/Message.php");
  require_once("dao/UserDAO.php");

  $message = new Message($BASE_URL);

  $flassMessage = $message->getMessage();

  if (!empty($flassMessage['msg'])) {
    // LIMPAR MESAGEM
    $message->clearMessage();
  }

  $UserDao = new UserDAO($conn, $BASE_URL);

  $userData = $UserDao->verifyToken(false);

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MovieStar</title>
  <link rel="shortcut icon" href="<?= $BASE_URL ?>/img/moviestar.ico" type="image/x-icon">
  <!-- FONT AWESOME -->
  <script src="https://kit.fontawesome.com/546ab0e97a.js" crossorigin="anonymous"></script>
  <!-- LINK BOOTSTRAP -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.css" integrity="sha512-lp6wLpq/o3UVdgb9txVgXUTsvs0Fj1YfelAbza2Kl/aQHbNnfTYPMLiQRvy3i+3IigMby34mtcvcrh31U50nRw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- LINK CSS -->
  <link rel="stylesheet" href="<?= $BASE_URL ?>/css/style.css">
</head>
<body>
  <header>
    <nav id="main-navbar" class="navbar navbar-expand-lg">
      <a href="<?= $BASE_URL ?>" class="navbar-brand">
        <img src="<?= $BASE_URL ?>/img/logo.svg" alt="logo" id="logo">
        <span id="moviestar-title">MovieStar</span>
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar"
      aria-controls="navbar" aria-expanded="false" aria-label="navigation">
        <i class="fas fa-bars"></i>
      </button>
      <form action="" method="GET" id="search-form" class="form-inline my-2 my-lg-0">
        <input type="text" name="q" id="search" class="form-control mr-sm-2" type="search" placeholder="Buscar Filmes" aria-label="search">
        <button id="btn-search" class="btn my-2 my-sm-0" type="submit">
          <i class="fas fa-search"></i>
        </button>
      </form>
      <div class="collapse navbar-collapse" id="navbar">
        <ul class="navbar-nav">
          <?php if($userData): ?>
            <li class="nav-item">
              <a href="<?= $BASE_URL ?>/newmovie.php" class="nav-link">
                <i class="far fa-plus-square"></i> Incluir Filmes
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= $BASE_URL ?>/dashbord.php" class="nav-link">Meus Filmes</a>
            </li>
            <li class="nav-item">
              <a href="<?= $BASE_URL ?>/editprofile.php" class="nav-link bold">
                <?= $userData->name ?>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= $BASE_URL ?>/logout.php" class="nav-link">Sair</a>
            </li>
          <?php else: ?>
            <li class="nav-item">
              <a href="<?= $BASE_URL ?>/auth.php" class="nav-link">Entrar / Cadastrar</a>
            </li>
          <?php endif; ?>
        </ul>
      </div>
    </nav>
  </header>
  
  <?php if(!empty($flassMessage['msg'])): ?>
    <div class="msg-container">
      <p class="msg <?= $flassMessage['type'] ?>"><?= $flassMessage['msg'] ?></p>
    </div>
  <?php endif; ?>
  