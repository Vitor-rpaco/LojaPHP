<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fileDirectory = "uploads/";
    $fileName = $fileDirectory . basename($_FILES["nomeArquivo"]["name"]);
    echo $fileName;
    $csvFileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $uploadOk = 0;
    //echo "<br>$csvFileType";
    if (isset($_POST["submit"])) {
        if (file_exists($fileName)) {
            echo "<br><br>Arquivo " . $_FILES["nomeArquivo"]["name"] . " Já existe. ";
        }
        elseif ($csvFileType != "csv") {
            echo "<br><br>Extensão " . $csvFileType . " do arquivo " . $_FILES["nomeArquivo"]["name"] . " não é permitida. ";
        } else {
            move_uploaded_file($_FILES["nomeArquivo"]["tmp_name"], $fileName);//"uploads/" . $storagename
            echo "<br><br>Gravado em: " . $fileName . "<br />";
        }
    }
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
</head>
<body>
	<form action="adcProdutos.php" method="POST">

		<label>Deseja fazer upload para o banco de dados?</label> 
		<input type="submit" name="enviar" value= "sim" />
		<button onclick="redirecionar()">Não</button>

	</form>
</body>
<script type="text/javascript">
	function redirecionar(){
		location.assign("/CRUDAV1/home.html");
	}
</script>
</html>>