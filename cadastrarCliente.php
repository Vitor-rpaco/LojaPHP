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
		echo $nomeValido;
		echo "<br>";
    	
	}

	if($cpf != "" && ctype_digit($cpf)){
		echo "cpf ok";
		echo "<br>";
		$cpfValido = 1;
		echo $cpfValido;
		echo "<br>";

	}

	if($cep != "" && ctype_digit($cep)){
		echo "cep ok";
		echo "<br>";
		$cepValido = 1;
		echo $cepValido;
		echo "<br>";
	}

	//Problema com Endereco
	if ($testeEndereco != "" && ctype_alpha($endereco)) {
		echo "endereco ok";
		echo "<br>";
    	$enderecoValido = 1;
		echo $enderecoValido;
		echo "<br>";
	}

	//Problema com Cidade
	if ($testeCidade != "" && ctype_alpha($cidade)) {
		echo "cidade ok";
		echo "<br>";
    	$cidadeValida = 1;
		echo $cidadeValida;
		echo "<br>";
	}

	if ($estado != "" && ctype_alpha($estado)) {
		echo "estado ok";
		echo "<br>";
    	$estadoValido = 1;
    	echo $estadoValido;
		echo "<br>";
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