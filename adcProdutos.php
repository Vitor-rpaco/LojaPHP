<?php

$servidor = "localhost";
$usuario = "root";
$senha = "";
$nomeBanco = "lojaphp";

$conn = new mysqli($servidor, $usuario, $senha, $nomeBanco);
if ($conn->connect_error) {
    die("Conexao falhou: " . $conn->connect_error);
}

$arquivo = fopen("uploads/Produtos.csv", "r") or die("Não consegui abrir o arquivo, deu erro");
$numLinha = 1;

while ($linha = fgetcsv($arquivo, 1000, ";")) {
    
    $nomeProd = $linha[0];
    $descricaoProd = $linha[1];
    $precoProd = $linha[2];
    $qtdProd = $linha[3];
    $pesoProd = $linha[4];

    $sql = "INSERT INTO produtos (nome, descricao, preco, quantidade, peso) 
    VALUES ('$nomeProd','$descricaoProd','$precoProd', '$qtdProd', '$pesoProd')";

    if($numLinha > 1){
        $result = $conn->query($sql);

        if($result){
            echo ($numLinha - 1) . ": " . "Insert bem sucedido";
            echo "<br>";
            echo "<br>";
        }else{
            echo "Erro!";
        } 
    }

    $numLinha++;
}
?>