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
      <li class="nav-item">
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
    <!-- Ínicio conteúdo-->

    <div class="container">
    <div class="row">
    <?php
      include_once '../model/Manager.php';
      @$produtos = getProduto($_POST['codProduto']);
      foreach ($produtos as $produto) {
    ?>
      <div class="col-md-6">
        <img src="img/<?php echo $produto['imggd'];?>.png" alt="Imagem" class="img-fluid">
      </div>
      <div class="col-md-6 mt-5">
        <div class="row">
          <div class="col-md-12"><strong><?php echo $produto['titulo']?></strong></div>
        </div>
        <div class="row">
          <div class="col-md-12"><?php echo $produto['texto']?></div>
        </div>
        <div class="row">
          <div class="col-md-12">Marca: <?php echo $produto['marca']?></div>
        </div>
        <div class="row">
          <div class="col-md-12">Peso: <?php echo $produto['peso'].'g'?></div>
        </div><br>
        <div class="row">
          <div class="col-md-12 txtPreco">Preço: <?php echo $produto['preco']?></div>
        </div>
        <div class="row">
          <div class="col-md-12">Quantidade disponível: <?php echo $produto['qtd']?></div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <label for="">Quantidade desejada:</label>
            <form action="pg_compraprod.php" method="post">
            <?php
              if($produto['qtd'] >= 12){
            ?>
            <select id="inputOpcoes" name="qtdDesejada">
              <?php
                for($i = 1; $i <= 12; $i++){

                
              ?>
              <option value="<?php echo $i;?>"><?php echo $i;?></option>
            
            <?php 
                }
            }
            ?>
            </select>
            <?php
              if($produto['qtd'] < 12){
            ?>
            <select id="inputOpcoes" name="qtdDesejada">
              <?php
                $qtdEstoque = $produto['qtd'];
                for($i = 1; $i <= $qtdEstoque; $i++){

                
              ?>
              <option value="<?php echo $i;?>"><?php echo $i;?></option>
            
            <?php 
                }
            }
            ?>
            </select>

          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            
              <input type="submit" value="Comprar" name="comprar">
              <input type="hidden" name="codCarrinho" value="<?php echo $produto['cod']?>">
              <input type="hidden" name="imgpq" value="<?php echo $produto['imgpq']; ?>">
              <input type="hidden" name="imggd" value="<?php echo $produto['imggd']; ?>">
              <input type="hidden" name="classe" value="<?php echo $produto['classe']; ?>">
              <input type="hidden" name="marca" value="<?php echo $produto['marca']; ?>">
              <input type="hidden" name="peso" value="<?php echo $produto['peso']; ?>">
              <input type="hidden" name="qtd" value="<?php echo $produto['qtd']; ?>">
              <input type="hidden" name="preco" value="<?php echo $produto['preco']; ?>">
              <input type="hidden" name="titulo" value="<?php echo $produto['titulo']; ?>">
              <input type="hidden" name="texto" value="<?php echo $produto['texto']; ?>">

            </form>
          </div>
        </div>
        <?php } ?>
      </div>
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
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>