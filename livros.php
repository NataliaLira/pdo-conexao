<?php
// adiciona conexão
require_once('conexao.php');

// prepara a query
$consultaDB = $conexaoDB->prepare('SELECT * from produto');

// executa a query
$consulta = $consultaDB->execute();

// guarda o resultado em array associativo
$livros = $consultaDB->fetchAll(PDO::FETCH_ASSOC);

?>



<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <title>Livraria</title>
</head>

<body>
  <div class="container my-5">
    <div class="row">
      <div class="col">
        <h1>Livraria</h1>
      </div>
      <div class="col text-right">
        <a href="cadastroLivro.php" class="btn btn-primary">Cadastrar livro</a>
      </div>
    </div>
  </div>
  <table class="table container">
    <thead>
      <tr>
        <th>Nome</th>
        <th>Descrição</th>
        <th>Preço</th>
        <th>Categoria</th>
        <th>Editora</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>
      <!-- listar todos os livros -->
      <?php foreach ($livros as $livro) : ?>
        <tr>
          <td><?php echo $livro['nome'] ?></td>
          <td width="40%"><?php echo $livro['descricao'] ?></td>
          <td><?php echo $livro['preco'] ?></td>
          <td><?php echo $livro['fk_categoria'] ?></td>
          <td><?php echo $livro['fk_editora'] ?></td>
          <td>
            <!-- redireciona mandando id do livro por parametro GET -->
            <a class="btn btn-secondary" href="editarLivro.php?id=<?php echo $livro['id'] ?>">editar</a>
            <a class="btn btn-danger" href="excluirLivro.php?id=<?php echo $livro['id'] ?>">excluir</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</body>

</html>