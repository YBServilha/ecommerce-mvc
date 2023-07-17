<?php

function admLogin($email,$senha){
    include 'Conexao.php';
    $dados = array();
    $dados["result"] = 0;
    $sql = "SELECT * FROM administrador WHERE email = '{$email}' AND senha = '{$senha}' AND status = 1";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        $dados["result"] = 1;
        while($row = $result->fetch_assoc()){
            $dados["id"] = $row["id"];
            $dados["email"] = $row["email"];
        }
        $conn->close();
    }
    return $dados;
}


/* CRUD Produtos */






function adicionarProduto($imgPequena, $imgGrande, $classe, $marca, $peso, $qtd, $preco, $titulo, $texto, $status){
    include_once 'Conexao.php';
    include_once 'Ferramentas.php';
    //$cod = 'asdf';
    $cod = geradorStringRandom(8);

    $imgPequena = renomearArquivo($imgPequena, $cod);
    $destinoImgPequena = '../view/img/' . $imgPequena.'.png';

    //echo $destinoImgPequena;
    //exit();
    move_uploaded_file($_FILES['imgPequena']['tmp_name'], $destinoImgPequena);

    $imgGrande = renomearArquivo($imgGrande, $cod);

    $destinoImgGrande = '../view/img/' . $imgGrande.'.png';
    move_uploaded_file($_FILES['imgGrande']['tmp_name'], $destinoImgGrande);
    //$cod = substr($cod, 0, 4);
    date_default_timezone_set('America/Sao_Paulo');
    $dataHoraAtual = new DateTime();
    $dataHoraFormatada = $dataHoraAtual->format('Y-m-d H:i:s');
    $sql = "INSERT INTO produtos (cod, imgpq, imggd, classe, marca, peso, qtd, preco, titulo, texto, datahora, status) VALUES ('$cod', '$imgPequena', '$imgGrande', '$classe', '$marca', $peso, '$qtd', '$preco', '$titulo', '$texto', '$dataHoraFormatada', $status)";
    //$bug = "deu pau";
    $result = $conn->query($sql);
    return $sql;
}

function renomearArquivo($nomeOriginal, $cod) {
    // Remove tudo que vem depois do primeiro underline
    $nomeSemAposUnderline = preg_replace('/_.*$/', '', $nomeOriginal);

    // Adiciona o novo código após o underline
    $novoNome = $nomeSemAposUnderline . '_' . $cod;

    return $novoNome;
}

function getProdutos(){
    include_once 'Conexao.php';
    $sql = "SELECT * FROM produtos";
    $result = $conn->query($sql);
    $produtos = array();
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $produto = array(
                'cod' => $row['cod'],
                'imgpq' => $row['imgpq'],
                'imggd' => $row['imggd'],
                'classe' => $row['classe'],
                'marca' => $row['marca'],
                'peso' => $row['peso'],
                'qtd' => $row['qtd'],
                'preco' => $row['preco'],
                'titulo' => $row['titulo'],
                'texto' => $row['texto'],
                'datahora' => $row['datahora'],
                'status' => $row['status']
            );
            $produtos[] = $produto;
        }
    }
    
    return $produtos;
}

function excluirProduto($cod){
    include_once 'Conexao.php';
    $sql = "DELETE FROM produtos WHERE cod = '$cod'";
    $result = $conn->query($sql);
    return $result;
}

function atualizarStatusProduto($cod, $novoStatus) {
    include_once 'Conexao.php';
    $sqlSelect = "SELECT status FROM produtos WHERE cod = '$cod'";
    $resultSelect = $conn->query($sqlSelect);

    if ($resultSelect->num_rows > 0) {
        $row = $resultSelect->fetch_assoc();
        $statusAtual = $row['status'];
        
        if($statusAtual == $novoStatus){
        ?>
        <form method="post" name="myForm" id="myForm" action="../view/admGerenciar.php">
            <input type="hidden" name="msg" value="YA01">
        </form>
        <script>
            document.getElementById('myForm').submit();
        </script>
        <?php      
        }else{   
            //echo 'mudou';
            if ($statusAtual == 0) {
                $sql = "UPDATE produtos SET status = 1 WHERE cod = '$cod'";
            } else {
                $sql = "UPDATE produtos SET status = 0 WHERE cod = '$cod'";
            }
            $result = $conn->query($sql);
            return $result;
        }

    }
    
    return false;
}

function getProduto($cod){
    include_once 'Conexao.php';
    $sql = "SELECT * FROM produtos where cod = '$cod'";
    $result = $conn->query($sql);
    $produtos = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $produto = array(
                'cod' => $row['cod'],
                'imgpq' => $row['imgpq'],
                'imggd' => $row['imggd'],
                'classe' => $row['classe'],
                'marca' => $row['marca'],
                'peso' => $row['peso'],
                'qtd' => $row['qtd'],
                'preco' => $row['preco'],
                'titulo' => $row['titulo'],
                'texto' => $row['texto'],
                'datahora' => $row['datahora'],
                'status' => $row['status']
            );
            $produtos[] = $produto;
        }
    }
    
    return $produtos;
}


/* Adicionar ao carrinho de compras */
function adicionarProdutoCarrinho($cod, $imgPequena, $imgGrande, $classe, $marca, $peso, $qtd, $preco, $titulo, $texto, $status) {
    include 'Conexao.php';
    include 'Ferramentas.php';
    date_default_timezone_set('America/Sao_Paulo');
    $dataHoraAtual = new DateTime();
    $dataHoraFormatada = $dataHoraAtual->format('Y-m-d H:i:s');
    $cod = geradorStringRandom(8);

    $sql = "INSERT INTO carrinho (cod, imgpq, imggd, classe, marca, peso, qtd, preco, titulo, texto, datahora, status) VALUES ('$cod', '$imgPequena', '$imgGrande', '$classe', '$marca', $peso, $qtd, '$preco', '$titulo', '$texto', '$dataHoraFormatada', $status)";
    $result = $conn->query($sql);

    return $result;
}


function getCarrinho(){
    include 'Conexao.php';
    $sql = "SELECT * FROM carrinho";
    $result = $conn->query($sql);
    $produtos = array();
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $produto = array(
                'cod' => $row['cod'],
                'imgpq' => $row['imgpq'],
                'imggd' => $row['imggd'],
                'classe' => $row['classe'],
                'marca' => $row['marca'],
                'peso' => $row['peso'],
                'qtd' => $row['qtd'],
                'preco' => $row['preco'],
                'titulo' => $row['titulo'],
                'texto' => $row['texto'],
                'datahora' => $row['datahora'],
                'status' => $row['status']
            );
            $produtos[] = $produto;
        }
    }
    
    return $produtos;
}

function getProdutoCarrinho($imgpq){
    include 'Conexao.php';
    $sql = "SELECT * FROM carrinho where imgpq = '$imgpq'";
    $result = $conn->query($sql);
    //$produtos = array();

    //return $sql;
    //exit();

    if ($result->num_rows > 0) {
            return true;
    }else{
        return false;
    }
}

/*function efetuarCompra($qtdSelecionada, $imgpq) {
    include 'Conexao.php';
    $sql = "SELECT qtd FROM produtos WHERE imgpq = '$imgpq'";
    $result = $conn->query($sql);
    $qtdEstoque = 0;
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $qtdEstoque = $row['qtd'];
    }
    
    return $qtdEstoque;
}*/



// Função para obter a quantidade disponível de um produto na tabela de produtos
function obterQuantidadeDisponivel($imgpq) {
    include 'Conexao.php';
    
    $sql = "SELECT qtd FROM produtos WHERE imgpq = '$imgpq'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['qtd'];
    } else {
        return 0;
    }
}

// Função para subtrair a quantidade do produto no carrinho do estoque
function subtrairDoEstoque($imgpq, $qtd) {
    include 'Conexao.php';
    
    $sql = "UPDATE produtos SET qtd = qtd - $qtd WHERE imgpq = '$imgpq'";
    $conn->query($sql);
}

function deletarCarrinho(){
    include 'Conexao.php';
    $sql = "delete from carrinho";
    $result = $conn->query($sql);
}


    







?>