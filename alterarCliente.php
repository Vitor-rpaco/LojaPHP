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

		//Leitura do formulário
        $nomeAtualizado = $_POST["nomeAtualizado"];
        $endrecoAtualizado = $_POST["enderecoAtualizado"];
        $cepAtualizado = $_POST["cepAtualizado"];
        $cidadeAtualizada = $_POST["cidadeAtualizada"];
        $estadoAtualizado = $_POST["estadoAtualizado"];
        $cpf = $_POST["cpf"];

		//Pattern para Regexes
		$pattern = "/^[A-Z][a-z]*/m";
		$patternCEP = "/^[0-9][0-9][0-9][0-9][0-9]-[0-9]{3}$/";

        //Verificadores
        $nomeAtualizadoValido = 0;
        $enderecoAtualizadoValido = 0;
        $cepAtualizadoValido = 0;
        $cidadeAtualizadaValida = 0;
        $estadoAtualizadoValido = 0;

        if ($nomeAtualizado != "" && ctype_alpha($nomeAtualizado)) {
    		$nomeAtualizadoValido = 1;
    	}

		if($cepAtualizado != "" && preg_match($patternCEP, $cepAtualizado)){
			$cepAtualizadoValido = 1;
		}

		if ($endrecoAtualizado != "" && preg_match($pattern, $endrecoAtualizado)) {
	    	$enderecoAtualizadoValido = 1;
		}

		if ($cidadeAtualizada != "" && preg_match($pattern, $cidadeAtualizada)) {
	    	$cidadeAtualizadaValida = 1;
		}

		if ($estadoAtualizado != "" && ctype_alpha($estadoAtualizado)) {
	    	$estadoAtualizadoValido = 1;
		}

		if($nomeAtualizadoValido == 1 && $cepAtualizadoValido == 1 && $enderecoAtualizadoValido == 1 && $cidadeAtualizadaValida == 1 
		&& $estadoAtualizadoValido == 1){

			$sql = "UPDATE clientes 
			SET nome= '$nomeAtualizado', endereco= '$endrecoAtualizado', 
			cep= '$cepAtualizado', cidade= '$cidadeAtualizada', estado= '$estadoAtualizado' 
			WHERE cpf = '$cpf'";
			$result = $conn->query($sql);

			if($result){
				echo "Atualizacao confirmada!";
			}else{
				echo "Opa!, algo deu errado :(";
			}
		}
	}
?>