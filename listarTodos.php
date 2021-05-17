<?php

$servidor = "localhost";
$usuario = "root";
$senha = "";
$nomeBanco = "lojaphp";

//Estabelecer conexão com o servidor
$conn = new mysqli($servidor, $usuario, $senha, $nomeBanco);
if ($conn->connect_error) {
    die("Conexao falhou: " . $conn->connect_error);
}

//Lista cliente
$sql = "SELECT * FROM clientes";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($linha = $result->fetch_assoc()) {
        echo "id: " . $linha["idCliente"]
            . " Nome: " . $linha["nome"]
            . " Endereco: " . $linha["endereco"]
            . " cep: " . $linha["cep"]
            . " Cidade: " . $linha["cidade"]
            . " Estado: " . $linha["estado"]
            . " cpf: " . $linha["cpf"];
       echo "<br><br>";
    }
}

?>

<!--******************************************************-->
<html>
    <body>
        <button onclick="redirect()"> Retornar </button>
    </body>
    <script>
        function redirect(){
            location.assign("/CRUDAV1/clienteHome.html");
        }
    </script>
</html>