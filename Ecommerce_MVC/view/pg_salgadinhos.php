<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AVALIAÇÃO</title>
    <link rel="stylesheet" href="css/estilo.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
</head>
<body>
    <header>
        <div class="container-fluid">
            <div class="row">
                <div class="col-4" style="background-color: #C0ECFF;">
                    <img src="imagem/logoMercadoAvaliacao.png" alt="" width="160">
                </div>
                <div class="col-4"  style="background-color: #C0ECFF;">
                </div>
                <div class="col-4"  style="background-color: #C0ECFF;">
                </div>
            </div>
        </div>
    </header>
<main>
    <div class="container">
        <div class="row">
            <div class="col-12" style="margin-top: 7px;">
        <!-- INÍCIO NAV -->
<nav class="navbar navbar-expand-lg navbar-dark rounded" style="background-color: #7AB92D; max-width: 1140px">
  
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#conteudoNavbarSuportado" aria-controls="conteudoNavbarSuportado" aria-expanded="false" aria-label="Alterna navegação">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="../index.php">Início</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="pg_latarias.php">Latarias</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="pg_salgadinhos.php">Salgadinhos</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Pesquisar" aria-label="Pesquisar">
      <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Pesquisar</button>
    </form>
  </div>
</nav>
<!-- FIM NAV -->
    </div>
    </div>

  <div class="container">
  <div class="row mt-2">
    <?php
    include_once '../model/Manager.php';
    $produtos = getProdutos();
    foreach ($produtos as $produto) {
      if($produto['classe'] == "s" && $produto['status'] == "1"){
    ?>
      <div class="col-md-3">
        <div class="card" style="width: 18rem;">
          <img class="card-img-top" src="img/<?php echo $produto['imgpq']; ?>.png" alt="Card image cap">
          <div class="card-body">
            <h5 class="card-title"><?php echo $produto['titulo']; ?></h5>
            <h5 class="card-title">Preço: <?php echo $produto['preco']; ?></h5>
            <p class="card-text"><?php echo $produto['texto']; ?></p>
            <form action="pg_exibeprod.php" method="post">
              <input type="submit" value="Ver Produto" class="btn btn-primary" name="verProduto">
              <input type="hidden" name="codProduto" value="<?php echo $produto['cod']?>">
            </form>
          </div>
        </div>
      </div>
    <?php 
      }
      } 
      ?>
  </div>
</div>
        
</main>
<footer>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 footer" style="background-color: #C0ECFF; height: 80px">
                <img src="../_ADM/imagens/_logoMercadoAvali_acao.png" alt="">
                <p>&copy;Trabalho realizado por: Yan Barbosa Servilha</p>
                <div class="redesSociais">
                    <p>Minhas redes:</p>
                    <div class="redes">
                        <a href="https://br.linkedin.com/in/yan-barbosa-servilha-923044269" target="_blank"><ion-icon name="logo-linkedin"></ion-icon></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<script src="js/busca.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>