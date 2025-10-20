<?php
require_once 'database/conexao.php';
$records_p = [];
$connection = newConnection();

$sql_p = "SELECT * FROM patient where idPatient = '" .$_SESSION["idPatient"]. "'";
$result_p = $connection->query($sql_p);

if ($result_p->num_rows > 0) {
  while ($row = $result_p->fetch_assoc()) {
    $records_p[] = $row;
  }
} else {
  echo $connection->error;
}
?>

<div class="container p-4">
  <form method="POST">
    <?php foreach ($records_p as $record) : ?>
      <h1 class="text-center"><?= $record['Name'] ?></h1>
      <input type="hidden" name="operacao" value="delete">
      <div class="form-row">
        <div class="form-group col-md-9">
          <label for="inputEmail4">Nome completo:</label>
          <p for="inputEmail4"><?= $record['Name'] ?></p>
        </div>
        <div class="form-group col-md-3">
          <label for="inputPassword4">Data de nascimento:</label>
          <p for="inputEmail4"><?= $record['Birth'] ?></p>
        </div>
        <div class="form-group col-md-9">
          <label for="inputAddress">Email:</label>
          <p for="inputEmail4"><?= $record['Email'] ?></p>
        </div>
        <div class="form-group col-md-3">
          <label for="inputAddress2">Senha:</label>
          <p for="inputEmail4"><?= $record['Password'] ?></p>
        </div>
        <div class="form-group col-md-9">
          <a  class="btn btn-second" href="index.php?dir=paginas&file=up_paciente&update=<?= $record['idPatient'] ?>"><span class="fa fa-pencil-square-o"></span>Editar</a>
        </div>
        <div class="form-group col-md-3">
          <a class="btn btn-second" href="../login/login.php"><span class="fa fa-sign-out"></span> Sair</a>
        </div>
      <?php endforeach ?>
  </form>
</div>