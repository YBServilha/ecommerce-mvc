<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AVALIAÇÃO</title>
    <link rel="stylesheet" href="css/estilo.css">
    <script>
        function verificaSaida(){
            var resp = confirm("Tem certeza que deseja sair do sistema?");
            if(resp == true){
                window.location.assign("admLogout.php");
            }
        }
        function confirmDelete(id,imgpq,imggd){
            var resp = confirm ("Deseja realmente deletar?");
            if(resp == true){
                location.href="../controller/admController.php?admImgDelete=1&id=" + id + "&imgpq=" + imgpq + "&imggd=" + imggd;
            }else{
                return null;
            }
        }
    </script>
</head>
<body>
    <div id="cabecalhoPg">
       <table width="95%">
        <tr>
            <td class=""><img src="imagem/logoMercadoAvaliacao.png" width="90"></td>
            <td class="">
                <h3>Gerenciamento de Produtos</h3>
                <h4>Usuário: <?=$_SESSION["ADM-EMAIL"];?></h4>
            </td>
            <td><button onclick="verificaSaida();">Logout</button></td>
        </tr>
       </table>
    </div>
    <div id="conteudoPg">
    <div id="exibeFormGerenciar">
        <h1>Registro de Produtos</h1>
        <form action="../controller/admController.php" method="post" enctype="multipart/form-data">
            <label for="imagemPequena">Arquivo de Imagem Pequena (180x180)</label>
            <input type="file" id="imagemPequena" name="imgPequena"><br><br>
            <label for="imagemGrande">Arquivo de Imagem Grande (480x480)</label>
            <input type="file" id="imagemGrande" name="imgGrande"><br><br>
            <label>Classe:</label><br>
            <input type="radio" id="lataConserva" name="classe" value="l">
            <label for="lataConserva">LataOuConserva</label><br>
            <input type="radio" id="salgadinho" name="classe" value="s">
            <label for="salgadinho">Salgadinho</label><br><br>
            <label for="marca">Marca:</label><br>
            <input type="text" name="marca" id="marca"><br><br>
            <label for="peso">Peso conteúdo (gramas):</label><br>
            <input type="text" name="peso" id="peso"><br><br>
            <label for="qtd">Quantidade de unidades em estoque:</label><br>
            <input type="text" name="qtd" id="qtd"><br><br>
            <label for="preco">Preço por unidade:</label><br>
            <input type="text" name="preco" id="preco"><br><br>
            <label for="titulo">Título:</label><br>
            <input type="text" name="titulo" id="titulo"><br><br>
            <label for="texto">Texto:</label><br>
            <textarea id="texto" name="texto" rows="4" cols="50"></textarea><br><br>
            <label for="status">Status:</label><br>
            <select id="status" name="status">
                <option value="1">Ativo</option>
                <option value="0">Inativo</option>
            </select><br><br>
            <input type="submit" name="enviar">
            <input type="hidden" name="registroProd">

        </form>


    </div>
        <div id="exibeImagens">
            
        <table class="tabelaAdm" cellspacing="0" width="90%">
        <tr class="tabelaAdmTh">
            <th class="tabelaAdmTh">cod</th>
            <th class="tabelaAdmTh">imgpq</th>
            <th class="tabelaAdmTh">classe</th>
            <th class="tabelaAdmTh">marca</th>
            <th class="tabelaAdmTh">peso</th>
            <th class="tabelaAdmTh">qtd</th>
            <th class="tabelaAdmTh">preço</th>
            <th class="tabelaAdmTh">Título/Texto</th>
            <th class="tabelaAdmTh">status</th>
            <th class="tabelaAdmTh"></th>
        </tr>
        <?php 
            include_once '../model/Manager.php';
            $produtos = getProdutos();
            foreach($produtos as $produto){
            ?>
        <tr class="tabelaAdmTd">
            <td class="tabelaAdmTd"><?php echo $produto['cod'];?></td>
            <td class="tabelaAdmTd"><img class="imgTabelaAdm" src="img/<?php echo $produto['imgpq'].'.png'?>"><br><?php echo $produto['imgpq'];?></td>
            <td class="tabelaAdmTd"><?php echo $produto['classe'];?></td>
            <td class="tabelaAdmTd"><?php echo $produto['marca'];?></td>
            <td class="tabelaAdmTd"><?php echo $produto['peso'];?></td>
            <td class="tabelaAdmTd"><?php echo $produto['qtd'];?></td>
            <td class="tabelaAdmTd"><?php echo $produto['preco'];?></td>
            <td class="tabelaAdmTd"><strong><?php echo $produto['titulo'];?></strong><br><?php echo $produto['texto']?></td>
            <td class="tabelaAdmTd">
            <form action="../controller/admController.php" method="POST">
                <select name="status" id="status">
                    <?php  
                        if($produto['status'] == 0){
                    ?>
                        <option value="1" >Ativo</option>
                        <option value="0" selected>Inativo</option>
                    <?php
                        }else{
                    ?>
                        <option value="1" selected>Ativo</option>
                        <option value="0">Inativo</option>
                    <?php } ?>
                </select><br>
                
                    <input type="submit" value="Editar" name="editar">
                    <input type="hidden" name="codProduto" value="<?php echo $produto['cod'];?>">
                    <input type="hidden" name="novoStatus" value="<?php echo $produto['status'];?>">
                </form>
            </td>
            <td class="tabelaAdmTd"><form action="../controller/admController.php" method="POST"><input type="submit" value="Excluir" name="excluir"><input type="hidden" name="codProduto" value="<?php echo $produto['cod'];?>"></form></td>
        </tr>
        <?php }?>
        </table>

        </div>

    </div>

    <?php
		if(isset($_REQUEST["msg"])){
			$cod = $_REQUEST["msg"];
			require_once 'msg.php';
			$msg = $MSG[$cod];
			echo "<script>alert('". $msg . "');</script>";
		}

        
	?>
</body>
</html>