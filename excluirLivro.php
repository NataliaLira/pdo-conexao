<?php
// adiciona conexão ao banco de dados
require_once('conexao.php');

//prepara query
$consulta = $conexaoDB->prepare('SELECT * from editora');

//executa query
$resultado = $consulta->execute();

// guarda o resultado em array associativo
$editoras = $consulta->fetchAll(PDO::FETCH_ASSOC);


//trazendo dados do livro pelo id
$livroConsulta = $conexaoDB->prepare('SELECT * FROM produto WHERE id = :id');

$livroExecuta = $livroConsulta->execute([":id" => $_GET['id']]);

$livro = $livroConsulta->fetch(PDO::FETCH_ASSOC);

// ATENÇÃO: tente excluir algum livro que você adicionou, não é possivel excluir livros que estejam associados a tabela pedidos

// quando formulario é enviado entra nesse if
if (isset($_POST['excluir-livro'])) {

  //verifica campos preenchidos
  if ($_POST['nome'] != "" && $_POST['descricao'] != "") {

    //prepara a query
    $query = $conexaoDB->prepare('DELETE FROM produto WHERE id = :id');

    // executa query
    $resultado = $query->execute([
      ":id" => $_GET['id']
    ]);

    //se tudo der certo, redireciona para lista de livros :)
    header('location: livros.php');
  }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <title>Excluir Livro</title>
</head>

<body>
  <div class="container my-5">
    <h1>Excluir livro</h1>
  </div>
  <form method="POST" class="container">
    <label for="nome">Nome:</label>
    <input type="text" id="nome" name="nome" class="form-control" value="<?php echo $livro['nome']; ?>" readonly>
    <label for="descricao">Descrição:</label>
    <input type="text" name="descricao" id="descricao" class="form-control" value="<?php echo $livro['descricao']; ?>" readonly>
    <label for="preco">Preço:</label>
    <input type="number" name="preco" id="preco" class="form-control" value="<?php echo $livro['preco']; ?>" readonly>
    <label for="fk_editora">Editora</label>
    <select name="fk_editora" id="fk_editora" class="form-control" readonly>
      <?php foreach ($editoras as $editora) { ?>
        <!-- cria um option para cada editora -->
        <option value="<?php echo $editora["id"]; ?>" <?php echo ($editora["id"] == $livro['fk_editora']) ? "selected" : ""; ?>>
          <?php echo $editora["nome"]; ?>
        </option>
      <?php } ?>
    </select>

    <!-- o name do button é o que faz passar na condição do if -->
    <button name="excluir-livro" class="btn btn-danger my-5"> Excluir </button>
    <a href="livros.php" class="btn btn-default">Voltar</a>
  </form>
</body>

</html>