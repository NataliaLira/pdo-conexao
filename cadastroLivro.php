<?php 
require_once('conexao.php');
$consulta = $conexaoDB->prepare('SELECT * from editora');
$resultado = $consulta->execute();

$editoras = $consulta->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Cadastro</title>
</head>
<body>
  <form action="" method="POST">
    <label for="nomeProduto">Nome Produto:</label>
        <input type="text" id='nomeProduto'>
    <label for="descricao">Descrição:</label>
        <input type="text" name="" id="descricao">
    <label for="">Preço:</label>
         <input type="number">
    <label for="">Imagem:</label>
        <input type="file">
     <label for="">Editora</label>
         <select name="" id="">
        <?php foreach($editoras as $editora) { ?>
            <option value=""> <?php echo $editora["nome"]; ?></option>
        <?php } ?>
         </select>
         <button> Enviar </button>


  </form>
</body>
</html>