<?php
  require_once("template/header.php");
  //VERIFICA SE  USUARIO ESTA AUTENTICADO 
  require_once("dao/MovieDAO.php");
  require_once("models/Movie.php");

  //pegar id do filme
  $id = filter_input(INPUT_GET, "id");

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

  // CHECA SE O FILME É DO USUARIO
  $userOwnsMovie = false;

  if (!empty($userData)) {
    if ($userData->id === $movie->users_id) {
      $userOwnsMovie = true;
    }
  }

  if (empty($movie->image)) $movie->image = "movie.jpg";

?>

<div id="main-container" class="container-fluid">
  <div class="row">
    <div class="offset-md-1 col-md-6 movie-container">
      <h1 class="page-title"><?= $movie->title ?></h1>
      <p class="movie-details">
        <span>Duração: <?= $movie->length ?></span>
        <span class="pipe"></span>
        <span><?= $movie->category ?></span>
        <span class="pipe"></span>
        <span><i class="fas fa-star"></i> 9</span>
      </p>
      <iframe src="<?= $movie->trailer ?>" width="560" height="315" frameborder='0' allow="accelerometer; autoplay; clipboard-wrinte; encryted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      <p><?= $movie->description ?></p>
    </div>
    <div class="col-md-4">
      <div class="movie-image-container" style="background-image: url('<?= $BASE_URL ?>/img/movies/<?= $movie->image ?>');"></div> 
    </div>
    <div class="offset-md-1 col-md-10" id="reviews-container">
      <h3 id="review-title">Avaliações: </h3>
      <!--- VERIFICA SE O USUARIO ESTA LOGADO PARA MOSTRAR AS REVIEWS --->
      <div class="col-md-12" id="review-form-container">
        <h4>Envie sua avaliação: </h4>
        <p class="page-description">Preencha o formulário com a nota e comentário</p>
        <form action="<?= $BASE_URL ?>/review_process.php" id="review-form" method="post">
          <input type="hidden" name="type" value="create">
          <input type="hidden" name="movies_id" value="<?= $movie->id ?>">
          <div class="form-group">
            <label for="rating" class="form-label">Nota do filme:</label>
            <select name="rating" id="rating" class="form-select">
              <option value="">Selecione</option>
              <optio value="10">10</optio>
              <option value="9">9</option>
              <option value="8">8</option>
              <option value="7">7</option>
              <option value="6">6</option>
              <option value="5">5</option>
              <option value="4">4</option>
              <option value="3">3</option>
              <option value="2">2</option>
              <option value="1">1</option>
            </select>
          </div>
          <div class="form-group">
            <label for="review">Seu Comentário</label>
            <textarea name="review" id="review" rows="3" placeholder="O que você achou do filme ?" class="form-control"></textarea>
          </div>
          <input type="submit" class="btn card-btn" value="Enviar Comentário">
        </form>
      </div>
      <!--- COMENTÁRIOS --->
      <div class="col-md-12 review">
        <div class="row">
          <div class="col-md-1">
            <div class="profile-image-container review-image" style="background-image: url('<?= $BASE_URL ?>/img/users/user.png');"></div>
          </div>
          <div class="col-md-9 author-details-container">
            <h4 class="author-name">
              <a href="#">Teste</a>
            </h4>
            <p><i class="fas fa-star"></i> 9</p>
          </div>
          <div class="col-md-12">
            <p class="comment-title">Comentário: </p>
            <p>Comentário do usuário</p>
          </div>
        </div>
      </div>
      <div class="col-md-12 review">
        <div class="row">
          <div class="col-md-1">
            <div class="profile-image-container review-image" style="background-image: url('<?= $BASE_URL ?>/img/users/user.png');"></div>
          </div>
          <div class="col-md-9 author-details-container">
            <h4 class="author-name">
              <a href="#">Teste</a>
            </h4>
            <p><i class="fas fa-star"></i> 9</p>
          </div>
          <div class="col-md-12">
            <p class="comment-title">Comentário: </p>
            <p>Comentário do usuário</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
  require_once("template/footer.php");
?>