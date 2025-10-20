<?php
if (count($_POST) > 0) {
  $dados = $_POST;

  require_once "database/conexao.php";

  $sql = "INSERT INTO query (name_patient, date, hours, telephone_patient, idMedical_insurance, idProfessional, idPatient ) VALUES (?, ?, ?, ?, ?, ?, ?)";

  $connection = newConnection();
  $stmt = $connection->prepare($sql);

  $params = [
    $dados['name_patient'],
    $dados['date'],
    $dados['hours'],
    $dados['telephone_patient'],
    $dados['idMedical_insurance'],
    $_SESSION["idProfessional"],
    $dados['idPatient']
  ];

  $stmt->bind_param("ssssiii", ...$params);

  if ($stmt->execute()) {
    unset($dados);
  }
}

require_once "database/conexao.php";
$connection = newConnection();

$records_pro = [];
$sql_pro = "SELECT * FROM professional";
$result_pro = $connection->query($sql_pro);

if ($result_pro->num_rows > 0) {
  while ($row = $result_pro->fetch_assoc()) {
    $records_pro[] = $row;
  }
} else {
  echo $connection->error;
}

$records_p = [];
$sql_p = "SELECT * FROM patient";
$result_p = $connection->query($sql_p);

if ($result_p->num_rows > 0) {
  while ($row = $result_p->fetch_assoc()) {
    $records_p[] = $row;
  }
} else {
  echo $connection->error;
}

$records_m = [];
$sql_m = "SELECT * FROM medical_insurance";
$result_m = $connection->query($sql_m);

if ($result_m->num_rows > 0) {
  while ($row = $result_m->fetch_assoc()) {
    $records_m[] = $row;
  }
} else {
  echo $connection->error;
}

$name = "SELECT name from professional where idProfessional = '" .$_SESSION["idProfessional"]. "'";
$name = $connection->query($name);
$name = $name->fetch_assoc();


$connection->close();
?>

<!-- html -->
<div class="container p-4">
  <form method="POST" action="#">
    <div class="form-row">
      <div class="form-group col-md-4">
        <label for="inputPassword4">Nome do profisional</label>
        <input type="text" class="form-control" id="inputPassword4" value="<?= $name['name'] ?>" placeholder="Nome completo" disabled="">
      </div>
      <div class="form-group col-md-4">
        <label for="inputEmail4">Nome do paciente responsavel</label>
        <select class="form-select custom-select" id="inputEmail4" name="idPatient" required>
          <option value="">Selecione o paciente</option>
          <?php foreach ($records_p as $record) : ?>
            <option value="<?= $record['idPatient'] ?>"><?= $record['Name'] ?></option>
          <?php endforeach ?>
        </select>
      </div>
      <div class="form-group col-md-4">
        <label for="inputPassword4">Nome do paciente</label>
        <input type="text" class="form-control" id="inputPassword4" name="name_patient" placeholder="Nome completo">
      </div>
      <div class="form-group col-md-3">
        <label for="inputPassword4">Data da consulta</label>
        <input type="date" class="form-control" id="inputPassword4" name="date" placeholder="dd/mm/aaaa">
      </div>
      <div class="form-group col-md-3">
        <label for="inputAddress">Horário</label>
        <input type="time" class="form-control" id="inputAddress" name="hours" placeholder="hh:mm">
      </div>
      <div class="form-group col-md-3">
        <label for="inputAddress">Telefone do paciente</label>
        <input type="text" class="form-control" id="inputAddress" name="telephone_patient" placeholder="(xx) xxxxx-xxxx">
      </div>
      <div class="form-group col-md-3">
        <label for="inputEmail4">Convênio</label>
        <select class="form-select custom-select" id="inputEmail4" name="idMedical_insurance" required>
          <option value="">Selecione o convênio</option>
          <?php foreach ($records_m as $record) : ?>
            <option value="<?= $record['idMedical_insurance'] ?>"><?= $record['Name'] ?></option>
          <?php endforeach ?>
        </select>
      </div>
      <div class="form-group col-md-12">
        <button type="submit" class="btn btn-second" name="sing_up">Marcar</button>
      </div>
  </form>
</div>