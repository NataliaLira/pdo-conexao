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


// quando formulario é enviado entra nesse if
if (isset($_POST['editar-livro'])) {

  //verifica campos preenchidos
  if ($_POST['nome'] != "" && $_POST['descricao'] != "") {

    //prepara a query
    $query = $conexaoDB->prepare('UPDATE produto SET nome = :nome, descricao = :descricao, preco = :preco, fk_editora = :fk_editora, fk_categoria = 49, fk_autor = 41, imagem = "sem-imagem" WHERE id = :id');

    // executa query
    $resultado = $query->execute([
      ":id" => $_GET['id'],
      ":nome" => $_POST['nome'],
      ":descricao" => $_POST['descricao'],
      ":preco" => $_POST['preco'],
      ":fk_editora" => $_POST['fk_editora']
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

  <title>Editar Livro</title>
</head>

<body>
  <div class="container my-5">
    <h1>Editar livro</h1>
  </div>
  <form method="POST" class="container">
    <label for="nome">Nome Produto:</label>
    <input type="text" id="nome" name="nome" class="form-control" value="<?php echo $livro['nome']; ?>">
    <label for="descricao">Descrição:</label>
    <input type="text" name="descricao" id="descricao" class="form-control" value="<?php echo $livro['descricao']; ?>">
    <label for="preco">Preço:</label>
    <input type="number" name="preco" id="preco" class="form-control" value="<?php echo $livro['preco']; ?>">
    <label for="imagem">Imagem:</label>
    <input type="file" name="imagem" id="imagem" class="form-control">
    <label for="fk_editora">Editora</label>
    <select name="fk_editora" id="fk_editora" class="form-control">
      <?php foreach ($editoras as $editora) { ?>
        <!-- cria um option para cada editora -->
        <option value="<?php echo $editora["id"]; ?>" <?php echo ($editora["id"] == $livro['fk_editora']) ? "selected" : ""; ?>>
          <?php echo $editora["nome"]; ?>
        </option>

      <?php } ?>
    </select>
    <!-- o name do button é o que faz passar na condição do if -->
    <button name="editar-livro" class="btn btn-primary"> Enviar </button>
  </form>
</body>

</html>