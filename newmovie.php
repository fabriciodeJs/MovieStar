<?php
  require_once("template/header.php");
  //VERIFICA SE  USUARIO ESTA AUTENTICADO 
  require_once("dao/UserDAO.php");
  require_once("models/User.php");

  $user = new User();
  $UserDao = new UserDAO($conn, $BASE_URL);

  $userData = $UserDao->verifyToken(true);
?>

<div id="main-container" class="container-fluid newmovie">
  <div class="offset-md-4 col-md-4 new-movie-container">
    <h1 class="page-title">Adicionar Filme</h1>
    <p class="page-description">Adicione sua crítica</p>
    <form action="<?= $BASE_URL ?>/movie_process.php" method="POST" id="add-movie-form"
    enctype="multipart/form-data">
      <input type="hidden" name="type" value="create">
      <div class="form-group">
        <label class="form-label" for="title">Titulo do Filme:</label>
        <input type="text" name="title" class="form-control" id="title" placeholder="Digite o titutlo do filme">
      </div>
      <div class="form-group">
        <label class="form-label" for="Image">Imagem:</label>
        <input type="file" name="image" class="form-control" id="image">
      </div>
      <div class="form-group">
        <label class="form-label" for="length">Duração:</label>
        <input type="text" name="length" class="form-control" id="length" placeholder="Digite a duração do filme">
      </div>
      <div class="form-group">
        <label class="form-label" for="category">Categoria:</label>
        <select name="category" id="category" class="form-select">
          <option value="">Selecione</option>
          <option value="Ação">Ação</option>
          <option value="Comédia">Cómedia</option>
          <option value="Terror">Terror</option>
          <option value="Fantasia / ficção">Fantasia / Ficção</option>
          <option value="Romance">Romance</option>
        </select>
      </div>
      <div class="form-group">
        <label class="form-label" for="trailer">Trailer:</label>
        <input type="text" name="trailer" class="form-control" id="trailer" placeholder="Insira a URL do Trailer">
      </div>
      <div class="form-group">
        <label class="form-label" for="description">Descrição do Filme:</label>
        <textarea name="description" class="form-control" id="description" rows="5" placeholder="Descreva o Filme"></textarea>
        <input type="submit" value="Cadastar" class="btn card-btn">
      </div>
      
    </form>
  </div>
</div>


<?php
  require_once("template/footer.php");
?>