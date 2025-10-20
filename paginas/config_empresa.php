<?php
require_once 'database/conexao.php';
$records_b = [];
$connection = newConnection();

$sql_b = "SELECT * FROM business";
$result_b = $connection->query($sql_b);

if ($result_b->num_rows > 0) {
  while ($row = $result_b->fetch_assoc()) {
    $records_b[] = $row;
  }
} else {
  echo $connection->error;
}
?>
<div class="container p-4">

  <form method="POST">

    <?php foreach ($records_b as $record) : ?>
      <h1 class="text-center"><?= $record['Name'] ?></h1>
      <input type="hidden" name="operacao" value="delete">
      <div class="form-row">
        <div class="form-group col-md-4">
          <label for="inputEmail4">Nome da empresa:</label>
          <p for="inputEmail4"><?= $record['Name'] ?></p>
        </div>
        <div class="form-group col-md-4">
          <label for="inputEmail4">Email:</label>
          <p for="inputEmail4"><?= $record['Email'] ?></p>
        </div>
        <div class="form-group col-md-4">
          <label for="inputEmail4">Senha:</label>
          <p for="inputEmail4"><?= $record['Password'] ?></p>
        </div>
        <div class="form-group col-md-4">
          <label for="inputPassword4">Cidade:</label>
          <p for="inputEmail4"><?= $record['City'] ?></p>
        </div>
        <div class="form-group col-md-4">
          <label for="inputAddress">Endereço:</label>
          <p for="inputEmail4"><?= $record['Street'] ?></p>
        </div>
        <div class="form-group col-md-3">
          <label for="inputAddress2">Bairro:</label>
          <p for="inputEmail4"><?= $record['NBHD'] ?></p>
        </div>
        <div class="form-group col-md-1">
          <label for="inputAddress2">Numero:</label>
          <p for="inputEmail4"><?= $record['Number'] ?></p>
        </div>
        <div class="form-group col-md-8">
          <a class="btn btn-second" href="index.php?dir=paginas&file=up_empresa&update=<?= $record['idBusiness'] ?>"><span class="fa fa-pencil-square-o"></span>Editar</a>
        </div>
        <div class="form-group col-md-4">
          <a class="btn btn-second" href="../login/login.php"><span class="fa fa-sign-out"></span> Sair</a>
        </div>
      <?php endforeach ?>
  </form>
</div>