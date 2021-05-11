<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $operacao = $_POST["Op"];
    echo "Operação Selecionada: $operacao";

    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $nomeBanco = "dawfaeterj";

    //Estabelecer conexão com o servidor
    $conn = new mysqli($servidor, $usuario, $senha, $nomeBanco);
    if ($conn->connect_error) {
        die("Conexao falhou: " . $conn->connect_error);
    }

    //Lista aluno
    if ($listarAluno == 'listarAluno') {
        $sql = "SELECT * FROM `alunos`";
        $result = $conn->query($sql);
        echo $sql;
        echo "<br><br>";
        if ($result->num_rows > 0) {
            while ($linha = $result->fetch_assoc()) {
                echo "id: " . $linha["id"]
                    . " Nome: " . $linha["nome"]
                    . " Email: " . $linha["email"]
                    . " Email: " . $linha["matricula"];
               echo "<br><br>";
            }
        }
    }
}
?>