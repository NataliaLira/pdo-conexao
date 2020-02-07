<?php

// informações do banco de dados para conexão
$dsn = "mysql:host=localhost;dbname=livraria;port=3306";
$username = "root";
$password = "";

try {
  // cria conexão com banco de dados e guarda na variavel conexaoDB
  $conexaoDB = new PDO($dsn, $username, $password);
} catch (PDOException $e) {

  // exibe mensagem de erro caso não consiga fazer conexão
  echo "<h1> Nessa máquina não funciona!</h1><br>" . $e->getMessage();
}
