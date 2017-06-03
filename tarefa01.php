<?php

$Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if(!empty($Dados['SendCadastra']) ){
	unset($Dados['SendCadastra']);

$nome = $Dados['nome'];
$nota = $Dados['nota'];

$conn = new PDO("mysql:host=127.0.0.1;dbname=education","root","");
$query = "INSERT INTO alunos (nome,nota) VALUES (:nome,:nota)";
$cadastrar = $conn->prepare($query);
$cadastrar->bindValue(':nome',$nome);
$cadastrar->bindValue(':nota',$nota);
$cadastrar->execute();

echo "Cadastrado com sucesso !";

}

?>




<form action="" method="post" >
<center>
	<label> Nome:</label>
	<input type="text" name="nome" placeholder="nome">
	<br/>


	<label> Nota do Aluno:</label>
	<input type="text" name="nota" placeholder="Nota do Aluno">
	<br/>
<br/>	<br/>
	<input type="submit" name="SendCadastra" value="cadastra">

	<br/>	<br/>


	<input type="submit" name="SendTodos" value="Mostrar todos Cadastrados">

	<br/>	<br/>

	<input type="submit" name="SendNota" value="As 3 melhores notas">

	<br/>	<br/>

	<input type="submit" name="SendPNota" value="As 3 Piores notas">

	</center>
</center>
</form>

<?php


if(!empty($Dados['SendTodos']) ){

$conn = new PDO("mysql:host=127.0.0.1;dbname=education","root","");
$query = "SELECT * FROM alunos";
$stmt   = $conn->query($query);
$visualiza = $stmt->fetchAll();


echo "<b>TODOS OS ALUNOS<b/><br><br>";
foreach ($visualiza as $visualiza2) {

	echo "<hr>Nome do Aluno : ". $visualiza2['nome']."<br/>";
	echo "Nota : ". $visualiza2['nota']."<br/>";
	echo "Numero de inscrição do Aluno :". $visualiza2['id']."<br/><hr>";
}



}

?>


<?php


if(!empty($Dados['SendNota']) ){


$conn = new PDO("mysql:host=127.0.0.1;dbname=education","root","");
$query = "SELECT * FROM `alunos` ORDER BY `alunos`.`nota` DESC LIMIT 3";
$stm = $conn->query($query);

$visualiza = $stm->fetchAll();

foreach ($visualiza as $visualiza2 ) {
	echo "<hr> Nome: ".$visualiza2['nome']." <br>Nota: ". $visualiza2['nota']."<br/><hr>";
}


}

?>

<?php


if(!empty($Dados['SendPNota']) ){


$conn = new PDO("mysql:host=127.0.0.1;dbname=education","root","");
$query = "SELECT * FROM `alunos` ORDER BY `alunos`.`nota` ASC LIMIT 3";
$stm = $conn->query($query);

$visualiza = $stm->fetchAll();

foreach ($visualiza as $visualiza2 ) {
	echo "<hr> Nome: ".$visualiza2['nome']." <br>Nota: ". $visualiza2['nota']."<br/><hr>";
}


}