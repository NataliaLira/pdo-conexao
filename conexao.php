<?php 

$dsn = "mysql:host=localhost;dbname=livraria;port=3306";
$username = "root";
$password = "";

try {
  $conexaoDB = new PDO($dsn, $username, $password);
 // echo "<h1>DEU CERTO MEU IRMÃO</h1>";
} catch (PDOException $e){
 echo "<h1> Nessa máquina não funciona!</h1><br>".$e->getMessage();
}






?> 
