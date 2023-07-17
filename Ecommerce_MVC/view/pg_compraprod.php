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

    <!-- Conteúdo -->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            <h2 class="mt-2">Meu Carrinho</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
            <table class="table">
                <thead>
                <tr>
                    <th>Cod</th>
                    <th>Imagem</th>
                    <th>Classe</th>
                    <th>Título</th>
                    <th>Marca</th>
                    <th>Peso</th>
                    <th>Preço</th>
                    <th>Quantidade</th>

                </tr>
                </thead>
                <tbody>
                <?php
                if(isset($_POST['comprar'])){
                    include_once '../model/Manager.php';
                    $codCarrinho = $_POST['codCarrinho'];
                    $imgpq = $_POST['imgpq'];
                    $imggd = $_POST['imggd'];
                    $classe = $_POST['classe'];
                    $marca = $_POST['marca'];
                    $peso = $_POST['peso'];
                    @$qtd = $_POST['qtdDesejada'];
                    $preco = $_POST['preco'];
                    $titulo = $_POST['titulo'];
                    $texto = $_POST['texto'];
                    $status = 1;
                    
                    if(!isset($qtd)){
                        $qtd = 0;
                        
                        ?>
                        
                        <script>
                            alert("Produto está fora de estoque");
                        </script>
                        <?php
                    }
                    if(getProdutoCarrinho($imgpq)){
                        $produtos = getCarrinho();
                    ?>
                    <script>
                        alert("Você já incluiu este produto no carrinho!");
                    </script>
                    <?php
                        foreach($produtos as $produto) {
                    ?>

                <tr>
                    <td><?php 
                    echo $produto['cod']; 
                    ?></td>
                    <td><img src="img/<?php echo $produto['imgpq'].'.png';?>" alt="Imagem" class="img-fluid imgTabela"></td>
                    <td><?php echo $produto['classe']; ?></td>
                    <td><?php echo $produto['titulo']; ?></td>
                    <td><?php echo $produto['marca']; ?></td>
                    <td><?php echo $produto['peso'].'g'; ?></td>
                    <td><?php echo 'R$ '.$produto['preco']; ?></td>
                    <td><?php echo $produto['qtd']; ?></td>
                </tr>
                <?php 
                        }
                    }else{ 
                ?>

                    <?php
                    
                    $adicionarCarrinho = adicionarProdutoCarrinho($codCarrinho, $imgpq, $imggd, $classe, $marca, $peso, $qtd, $preco, $titulo, $texto, $status);
                    $produtos = getCarrinho();
                    foreach($produtos as $produto) {
                ?>
                <tr>
                    <td><?php echo $produto['cod']; ?></td>
                    <td><img src="img/<?php echo $produto['imgpq'].'.png';?>" alt="Imagem" class="img-fluid imgTabela"></td>
                    <td><?php echo $produto['classe']; ?></td>
                    <td><?php echo $produto['titulo']; ?></td>
                    <td><?php echo $produto['marca']; ?></td>
                    <td><?php echo $produto['peso'].'g'; ?></td>
                    <td><?php echo $produto['preco']; ?></td>
                    <td><?php echo $produto['qtd']; ?></td>
                </tr>
                <?php } }}?>
                <tr>
                <td colspan="6"></td>
                <td><strong>Total:</strong></td>
                <td id="total" colspan="7"></td>
                </tr>



                </tbody>
            </table>
            <form action="../controller/clientController.php" method="post">
                <input type="submit" class="btn btn-primary mb-5 mt-2" value="Finalizar Compra" name="finalizarCompra">
                <input type="hidden" name="qtd" value="<?php echo $qtd;?>">
                <input type="hidden" name="imgPequena" value="<?php echo $imgpq;?>">
            </form>
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


<script>
  // Função para calcular o total
  function calcularTotal() {
    // Seleciona todas as células que contêm os preços
    var precoCells = document.querySelectorAll('tbody tr td:nth-child(7)');
    var qtdCells = document.querySelectorAll('tbody tr td:nth-child(8)');
    var total = 0;

    // Percorre todas as células e soma os valores
    for (var i = 0; i < precoCells.length; i++) {
      var qtd = parseFloat(qtdCells[i].textContent);
      var preco = parseFloat(precoCells[i].textContent.replace('R$ ', ''));
      precoFinal = preco*qtd;
      total += precoFinal;
    }

    //for (var i = 0; i < precoCells.length; i++) {
     // var preco = parseFloat(precoCells[i].textContent.replace('R$ ', ''));
      //total += preco;
    //}

    // Atualiza o valor do total na célula correspondente
    var totalCell = document.querySelector('#total');
    totalCell.textContent = 'R$ ' + total.toFixed(2);
  }

  // Chama a função para calcular o total quando o documento estiver carregado
  document.addEventListener('DOMContentLoaded', calcularTotal);
</script>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>