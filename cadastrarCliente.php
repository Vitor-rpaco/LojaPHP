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

	$nome = $_POST["nome"];
	$cpf = $_POST["cpf"];
	$endereco = $_POST["endereco"];
	$cep = $_POST["cep"];
	$cidade = $_POST["cidade"];
	$estado = $_POST["estado"];

	//Pattern para Regexes
	$patternCPF = "/^[0-9]{3}\.[0-9]{3}\.[0-9]{3}-[0-9]{2}$/";
	$patternCEP = "/^[0-9][0-9][0-9][0-9][0-9]-[0-9]{3}$/";

	//Fazer verificação
	$nomeValido = 0;
	$cpfValido = 0;
	$enderecoValido = 0;
	$cepValido = 0;
	$cidadeValida = 0;
	$estadoValido = 0;

	if ($nome != "" && ctype_alpha($nome)) {
		echo "Nome ok";
		echo "<br>";
    	$nomeValido = 1;
    	
	}

	if($cpf != "" && preg_match($patternCPF, $cpf)){
		echo "cpf ok";
		echo "<br>";
		$cpfValido = 1;
	}

	if($cep != "" && preg_match($patternCEP, $cep)){
		echo "cep ok";
		echo "<br>";
		$cepValido = 1;
	}

	//Problema com Endereco
	if ($endereco != "" && ctype_alpha($endereco)) {
		echo "endereco ok";
		echo "<br>";
    	$enderecoValido = 1;
	}

	//Problema com Cidade
	if ($cidade != "" && ctype_alpha($cidade)) {
		echo "cidade ok";
		echo "<br>";
    	$cidadeValida = 1;
	}

	if ($estado != "" && ctype_alpha($estado)) {
		echo "estado ok";
		echo "<br>";
    	$estadoValido = 1;
	}

	//Se, tudo ok: Então continue para a inserção no banco.
	if($nomeValido == 1 && $cpfValido == 1 && $cepValido == 1 && $enderecoValido == 1 && $cidadeValida == 1 
		&& $estadoValido == 1){

		$sql = "INSERT INTO clientes (nome, endereco, cep, cidade, estado, cpf) 
		VALUES ('$nome','$endereco','$cep', '$cidade', '$estado', '$cpf')";

		$result = $conn->query($sql);

		if($result){

			echo "Insert bem sucedido :)";
			echo "<br>";
			echo "<br>";
		}else{
			echo "Opa, houve um erro :(";
			echo "<br>";
			echo "<br>";
		}
	}
}

?>

<!--******************************************************-->
<html>
    <body>
        <button onclick="redirect()">Retornar</button>
    </body>
    <script>
        function redirect(){
            location.assign("/CRUDAV1/cadastrarCliente.html");
        }
    </script>
</html>