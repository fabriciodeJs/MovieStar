<?php
  require_once("template/header.php")
?>

<div id="main-container" class="container-fluid">
 <div class="col-md-12">
  <div class="row" id="auth-row">
    <div class="col-md-4" id="login-container">
      <h2>Entrar</h2>
      <form method="post" action="">
        <input type="hidden" name="type" value="login">
        <div class="form-group">
          <label for="email">E-mail</label>
          <input type="text" class="form-control" placeholder="Digite Seu e-mail" name="email" id="email">
        </div>
        <div class="form-group">
          <label for="password">Senha</label>
          <input type="password" class="form-control" placeholder="Digite Sua Senha" name="password" id="password">
        </div>
        <input type="submit" class="btn card-btn" value="Logar">
      </form>
    </div>
    <div class="col-md-4" id="register-container">
      <h2>Criar Conta</h2>
      <form action="<?= $BASE_URL ?>/auth_process.php" method="post">
        <input type="hidden" name="type" value="register">
        <div class="form-group">
          <label for="email">E-mail</label>
          <input type="text" class="form-control" placeholder="Digite Seu e-mail" name="email" id="email">
        </div>
        <div class="form-group">
          <label for="name">Nome</label>
          <input type="text" class="form-control" placeholder="Digite Seu Nome" name="name" id="name">
        </div>
        <div class="form-group">
          <label for="lastname">Sobrenome</label>
          <input type="text" class="form-control" placeholder="Digite Seu Sobrenome" name="lastname" id="lastname">
        </div>
        <div class="form-group">
          <label for="password">Senha</label>
          <input type="password" class="form-control" placeholder="Digite Sua Senha" name="password" id="password">
        </div>
        <div class="form-group">
          <label for="confirmpassword">Confirme sua Senha</label>
          <input type="password" class="form-control" placeholder="Confirme Sua Senha" name="confirmpassword" id="confirmpassword">
        </div>
        <input type="submit" class="btn card-btn" value="Cadastrar">
      </form>
    </div>
  </div>
 </div>
</div>


<?php
  require_once("template/footer.php")
?>