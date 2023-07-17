<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
</head>
</head>
<body>
    



<?php

/*if (isset($_POST['finalizarCompra'])) {
    require '../model/Manager.php';
    $qtdEstoque = efetuarCompra($_POST['qtd'], $_POST['imgPequena']);
    echo $qtdEstoque;
}*/

if (isset($_POST['finalizarCompra'])) {
    require '../model/Manager.php';
    
    // Obter a lista de produtos no carrinho
    $produtosCarrinho = getCarrinho();
    
    // Variável para armazenar erros de estoque
    $estoqueInsuficiente = false;
    
    // Verificar estoque de cada produto no carrinho
    foreach ($produtosCarrinho as $produto) {
        $imgpq = $produto['imgpq'];
        $qtdCarrinho = $produto['qtd'];
        
        // Obter a quantidade disponível do produto na tabela de produtos
        $qtdDisponivel = obterQuantidadeDisponivel($imgpq);
        
        // Verificar se a quantidade no carrinho é maior que a quantidade disponível
        if ($qtdCarrinho > $qtdDisponivel) {
            $estoqueInsuficiente = true;
            break;
        }
    }
    
    // Verificar se há estoque suficiente para todos os produtos
    if (!$estoqueInsuficiente) {
        // Realizar a operação de subtração do estoque e finalizar a compra
        foreach ($produtosCarrinho as $produto) {
            $imgpq = $produto['imgpq'];
            $qtdCarrinho = $produto['qtd'];
            
            // Subtrair a quantidade do produto no carrinho do estoque
            subtrairDoEstoque($imgpq, $qtdCarrinho);
        }
        deletarCarrinho();

        
    // Realizar o redirecionamento após a mensagem de sucesso
    echo '<script>
        setTimeout(function() {
            Swal.fire(
                "Compra realizada!",
                "Pedido efetuado com sucesso!",
                "success"
            ).then(function() {
                window.location.href = "../index.php"; // Redirecionar para a página inicial
            });
        }, 500);
    </script>';
?>

        

        <?php
    }else{
        echo "Não há estoque suficiente para finalizar a compra.";
    }
}






?>
</body>
</html>