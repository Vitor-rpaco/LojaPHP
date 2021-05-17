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
		$cpfValido = 0;

		$patternCPF = "/^[0-9]{3}\.[0-9]{3}\.[0-9]{3}-[0-9]{2}$/";

		if($cpf != "" && preg_match($patternCPF, $cpf)){
			$cpfValido = 1;
		}

		if($cpfValido == 1){

			$sql = "SELECT * FROM clientes WHERE cpf = '$cpf'";
			$result = $conn->query($sql);

			if($result->num_rows == 0){
				echo "Erro, esse cliente nao existe :(";
			}else{
				$item = $result->fetch_assoc();

				echo "idCliente: " . $item["idCliente"];
				echo "<br>";
				echo "Nome: " . $item["nome"];
				echo "<br>";
				echo "Endereco: " . $item["endereco"];
				echo "<br>";
				echo "CEP: " . $item["cep"];
				echo "<br>";
				echo "Cidade: " . $item["cidade"];
				echo "<br>";
				echo "Estado: " . $item["estado"];
				echo "<br>";
				echo "CPF: " . $item["cpf"];
				echo "<br><br>";
			}
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