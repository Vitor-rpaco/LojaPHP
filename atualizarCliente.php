<?php

	$servidor = "localhost";
	$usuario = "root";
	$senha = "";
	$nomeBanco = "lojaphp";

	$conn = new mysqli($servidor, $usuario, $senha, $nomeBanco);
	if ($conn->connect_error) {
		die("Conexao falhou: " . $conn->connect_error);
	}

	if($_SERVER['REQUEST_METHOD'] == "POST"){

		$cpf = $_POST["cpf"];

		$cpfValido = 0;

		$patternCPF = "/^[0-9]{3}\.[0-9]{3}\.[0-9]{3}-[0-9]{2}$/";

		if($cpf != "" && preg_match($patternCPF, $cpf)){
			$cpfValido = 1;
		}

		if($cpfValido == 1){

			$sql = "SELECT * FROM clientes WHERE cpf = '$cpf'";
			$result = $conn->query($sql);

			$item = $result->fetch_assoc();

            if ($result->num_rows == 0) {
                echo "Erro!, aluno não encontrado :(";
            }
		}
	}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Editar Cliente</title>
</head>
<body>

	<form action="alterarCliente.php" method="POST">

        <label>Busca</label>
        idCliente: <input type="text" name="idCliente" value="<?php echo $item['idCliente'] ?>" readonly>
        <br><br>
        Nome: <input type="text" name="nomeAtualizado" value="<?php echo $item['nome'] ?>" />
        <br><br>
        Endereco: <input type="text" name="enderecoAtualizado" value="<?php echo $item['endereco'] ?>" />
        <br><br>
        CEP: <input type="text" name="cepAtualizado" min= "0" minlength="9" maxlength="9"
        value="<?php echo $item['cep'] ?>" />
        <br><br>
        Cidade: <input type="text" name="cidadeAtualizada" value="<?php echo $item['cidade'] ?>" />
        <br><br>
        Estado: <input type="text" name="estadoAtualizado" minlegth= "2" maxlength="2"
        value="<?php echo $item['estado'] ?>" />
        <br><br>
        CPF: <input type="text" name="cpf" min= "0" minlength="14" maxlength="14" 
        value="<?php echo $item['cpf'] ?>" readonly/>

        <input type="submit" value="enviar">
    </form>
</body>
</html>