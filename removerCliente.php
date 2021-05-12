<?php

$servidor = "localhost";
$usuario = "root";
$senha = "";
$nomeBanco = "lojaphp";

$conn = new mysqli($servidor, $usuario, $senha, $nomeBanco);
if ($conn->connect_error) {
    die("Conexao falhou: " . $conn->connect_error);
}

if($_SERVER["REQUEST_METHOD"] == "POST"){

	$cpf = $_POST["cpf"];

	$patternCPF = "/^[0-9]{3}\.[0-9]{3}\.[0-9]{3}-[0-9]{2}$/";
	$cpfValido = 0;

	if($cpf != "" && preg_match($patternCPF, $cpf)){
		echo "cpf ok";
		echo "<br>";
		$cpfValido = 1;
	}

	if($cpfValido == 1){

		$sql = "DELETE FROM clientes WHERE cpf = '$cpf'";
        $result = $conn->query($sql);
	}
}

?>