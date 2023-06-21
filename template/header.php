<?php
  require_once("globals.php");
  require_once("db.php");

  $flassMessage = [];

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
          <li class="nav-item">
            <a href="<?= $BASE_URL ?>/auth.php" class="nav-link">Entrar / Cadastrar</a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  
  <?php if(!empty($flassMessage['msg'])): ?>
    <div class="msg-container">
      <p class="msg <?= $flassMessage['type'] ?>"><?= $flassMessage['msg'] ?></p>
    </div>
  <?php endif; ?>
  