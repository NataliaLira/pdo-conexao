<?php 
require_once ('conexao.php');
$consultaDB = $conexaoDB->prepare('SELECT * from produto');
$consulta = $consultaDB->execute();

$livros = $consultaDB->fetchAll(PDO::FETCH_ASSOC);

foreach($livros as $livro){
 
  echo $livro["nome"]."<br>".$livro["descricao"]."<br>".$livro["preco"]."<hr>";
}
?>