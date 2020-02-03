<?php 
require_once ('conexao.php');
$consultaDB = $conexaoDB->prepare('SELECT * from produto');
$consulta = $consultaDB->execute();

$livros = $consultaDB->fetchAll(PDO::FETCH_ASSOC);

foreach($livros as $livro){
 
  echo $livro["id_produto"]."<br>";
}
?>