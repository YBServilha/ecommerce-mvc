<?php
session_start();
if(isset($_POST["admLogin"]) && $_POST["admLogin"] != ""){
    $login = $_REQUEST["email"];
    $senha = $_REQUEST["senha"];    
    require_once ('../model/Ferramentas.php');

    $respLogin = antiInjection($login);
    $respSenha = antiInjection($senha);

    if($respLogin == 0 || $respSenha == 0){
        // Ocorreu tentativa de invasão. Devolver ao index.php
        session_destroy();
        ?>
        <form method="post" name="myForm" id="myForm" action="admLogin.php">
            <input type="hidden" name="msg" value="FR24">
        </form>
        <script>
            document.getElementById('myForm').submit();
        </script>

        <?php
    }else{
        $senhaCriptografada = hash256($senha);
        require_once "../model/Manager.php";
        $dados = admLogin($login,$senhaCriptografada);
        if($dados["result"] == 1){
            $_SESSION["ADM-ID"] = $dados["id"];
            $_SESSION["ADM-EMAIL"] = $dados["email"];
            ?>
                <form method="post" name="myForm" id="myForm" action="../view/admGerenciar.php">
                    <input type="hidden" name="validado" value="0">
                </form>
                <script>
                    document.getElementById('myForm').submit();
                </script>
            <?php
        }else{
            // não retornou dados. Devolver ao admLogin.php
            session_destroy();
            ?>
            <form method="post" name="myForm" id="myForm" action="admLogin.php">
                <input type="hidden" name="msg" value="FR11">
            </form>
            <script>
                document.getElementById('myForm').submit();
            </script>

            <?php
        }
    }
}



/* Registro de produtos */



if(isset($_POST['registroProd'])){
    //echo 'Deu certo!';
    //$imgPequena = $_POST['imgPequena'];
    //$imgGrande = $_POST['imgGrande'];

    $imgPequena = $_FILES['imgPequena']['name'];
    $imgGrande = $_FILES['imgGrande']['name'];
    $classe = $_POST['classe'];
    $marca = $_POST['marca'];
    $peso = $_POST['peso'];
    $qtd = $_POST['qtd'];
    $preco = $_POST['preco'];
    $titulo = $_POST['titulo'];
    $texto = $_POST['texto'];
    $status = $_POST['status'];
    require_once ('../model/Ferramentas.php');
    $respImgPequena = antiInjection($imgPequena);
    $respImgGrande = antiInjection($imgGrande);
    $respClasse = antiInjection($_POST['classe']);
    $respMarca = antiInjection($_POST['marca']);
    $respPeso = antiInjection($_POST['peso']);
    $respQtd = antiInjection($_POST['qtd']);
    $respPreco = antiInjection($_POST['preco']);
    $respTitulo = antiInjection($_POST['titulo']);
    $respTexto = antiInjection($_POST['texto']);
    $respStatus = antiInjection($_POST['status']);
    /*if($respImgPequena == 0 || $respImgGrande == 0 || $respClasse == 0 || $respMarca == 0 || $respPeso == 0 || $respQtd == 0|| $respPreco == 0|| $respTitulo == 0|| $RespTexto == 0 || $respStatus == 0){
        // Ocorreu tentativa de invasão. Devolver ao index.php
        session_destroy();
        ?>
        <form method="post" name="myForm" id="myForm" action="../admLogin.php">
            <input type="hidden" name="msg" value="FR24">
        </form>
        <script>
            document.getElementById('myForm').submit();
        </script>
        <?php
    }else{
        echo 'deu certo';
    }*/
    require_once "../model/Manager.php";
    $produto = adicionarProduto($imgPequena, $imgGrande, $classe, $marca, $peso, $qtd, $preco, $titulo, $texto, $status);
    //echo $produto;
    ?>
    <form method="post" name="myForm" id="myForm" action="../view/admGerenciar.php">
        <input type="hidden" name="msg" value="BD52">
    </form>
    <script>
        document.getElementById('myForm').submit();
    </script>
    <?php
}


/* Exclusão de produto */
if(isset($_POST['excluir'])){
    $codProduto = $_POST['codProduto'];
    require_once ('../model/Ferramentas.php');
    $respCodProduto = antiInjection($codProduto);
    
    if($respCodProduto == 0){
        // Ocorreu tentativa de invasão. Devolver ao index.php
        session_destroy();
        ?>
        <form method="post" name="myForm" id="myForm" action="../admLogin.php">
            <input type="hidden" name="msg" value="FR24">
        </form>
        <script>
            document.getElementById('myForm').submit();
        </script>

        <?php
    }else{
        //echo 'sem injection';
        require_once('../model/Manager.php');
        if(excluirProduto($codProduto)){
            ?>
            <form method="post" name="myForm" id="myForm" action="../view/admGerenciar.php">
                <input type="hidden" name="msg" value="BD54">
            </form>
            <script>
                document.getElementById('myForm').submit();
            </script>
            <?php
        }else{
            ?>
            <form method="post" name="myForm" id="myForm" action="../admLogin.php">
                <input type="hidden" name="msg" value="FR24">
            </form>
            <script>
                document.getElementById('myForm').submit();
            </script>
            <?php
        }
    }
}


/* Edição do status do produto */
if(isset($_POST['editar'])){
    //echo 'edição do status';
    $codProduto = $_POST['codProduto'];
    $novoStatus = $_POST['status'];
    require_once ('../model/Ferramentas.php');
    $respCodProduto = antiInjection($codProduto);
    
    if($respCodProduto == 0){
        // Ocorreu tentativa de invasão. Devolver ao index.php
        session_destroy();
        ?>
        <form method="post" name="myForm" id="myForm" action="../admLogin.php">
            <input type="hidden" name="msg" value="FR24">
        </form>
        <script>
            document.getElementById('myForm').submit();
        </script>
        <?php
    }else{
        //echo 'sem injection';
        require_once('../model/Manager.php');
        if(atualizarStatusProduto($codProduto, $novoStatus)){
            //exit();
            ?>
            <form method="post" name="myForm" id="myForm" action="../view/admGerenciar.php">
                <input type="hidden" name="msg" value="BD53">
            </form>
            <script>
                document.getElementById('myForm').submit();
            </script>
            <?php
        }else{
            ?>
            <form method="post" name="myForm" id="myForm" action="../view/admGerenciar.php">
                <input type="hidden" name="msg" value="FR24">
            </form>
            <script>
                document.getElementById('myForm').submit();
            </script>
            <?php
        }
    }
}

?>