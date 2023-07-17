<?php

    $servername = "localhost";
    $username   = "root";
    $password   = "";
    $dbname     = "mercadoavaliacao";

    // Criando a conexão
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Checkando a conexao
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

?>