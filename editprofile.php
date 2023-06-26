<?php
  require_once("template/header.php");
  require_once("dao/UserDAO.php");
  require_once("models/User.php");
  
  $user = new User();
  $UserDao = new UserDAO($conn, $BASE_URL);
  $userData = $UserDao->verifyToken(true);

  $fullName = $user->getFullName($userData);

  if (empty($userData->image)) $userData->image = "user.png";
    
  
  
?>

<div id="main-container" class="container-fluid edit-profile-page">
  <div class="col-md-12">
    <form action="<?= $BASE_URL ?>user_process.php" method="post" enctype="multipart/form-data">
      <input type="hidden" name="type" value="update">
      <div class="row">
        <div class="col-md-4">
          <h1><?= $fullName ?></h1>
          <p class="page-description">Altere seus dados no formulário abaixo: </p>
          <div class="form-group">
            <label for="name">Nome: </label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Digite seu Nome"
              value="<?= $userData->name ?>">
          </div>
          <div class="form-group">
            <label for="lastname">Sobrenome: </label>
            <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Digite seu Sobrenome"value="<?= $userData->lastname ?>">
          </div>
          <div class="form-group">
            <label for="email">email: </label>
            <input type="text" readonly name="email" id="email" class="form-control disabled" placeholder="Digite seu email"
              value="<?= $userData->email ?>">
          </div>
          <input type="submit" class="btn card-btn" value="Alterar">
        </div>
        <div class="col-md-4">
          <div id="profile-image-container" 
          style="background-image: url('<?= $BASE_URL?>/img/users/<?= $userData->image ?>');"></div>
          <div class="form-group">
            <label for="image">Foto: </label>
            <input type="file" name="image" id="image" class="form-control-file">
          </div>
          <div class="form-group">
            <label for="bio">Sobre Você:</label>
            <textarea class="form-control" name="bio" id="bio" rows="5" placeholder="Conte quem é você!"><?= $userData->bio ?></textarea>
          </div>
        </div>
      </div>
    </form>
    <div class="row" id="change-password-container">
      <div class="col-md-4">
        <h2>Alterar a Senha</h2>
        <p class="page-description">Digite a Nova Senha e confirme, para alterar su senha:</p>
        <form action="<?= $BASE_URL ?>user_process.php" method="post">
          <input type="hidden" name="type" value="changepassword">
          <div class="form-group">
            <label for="password">Nova Senha: </label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Digite a nova senha">
          </div>
          <div class="form-group">
            <label for="confirmpassword">confirme sua Senha: </label>
            <input type="password" name="confirmpassword" id="confirmpassword" class="form-control" placeholder="confirme a nova senha">
          </div>
          <input type="submit" class="btn card-btn" value="Alterar Senha">
        </form>
      </div>
    </div>
  </div>
</div>


<?php
  require_once("template/footer.php");
?>