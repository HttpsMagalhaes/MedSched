<?php

require_once 'database/conexao.php';
$records_p = [];
$connection = newConnection();

if (isset($_GET['update'])) { //botão
    if (count($_POST) > 0) {
        $dados = $_POST;
        $updSQL = "UPDATE query SET name_patient = ?, date = ?, hours = ?, telephone_patient = ?, idMedical_insurance = ?, idProfessional = ? WHERE idQuery = ?";
        $stmt = $connection->prepare($updSQL);
        $params = [
            $dados['name_patient'],
            $dados['date'],
            $dados['hours'],
            $dados['telephone_patient'],
            $dados['idMedical_insurance'],
            $dados['idProfessional'],
            $_GET['update']
        ];
        $stmt->bind_param("ssssiii", ...$params);
        $stmt->execute();
    }
}

if (isset($_GET['update'])) { //botão
    $sql = "SELECT * FROM query WHERE idQuery = " . $_GET['update'];
    $result = $connection->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $records[] = $row;
        }
    } else {
        echo $connection->error;
    }
}

$records_pro = [];
$sql_pro = "SELECT DISTINCT * FROM professional";
$result_pro = $connection->query($sql_pro);

if ($result_pro->num_rows > 0) {
  while ($row = $result_pro->fetch_assoc()) {
    $records_pro[] = $row;
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

$connection->close();

?>

<a href="indexm.php?dir=paginas&file=gerenciar_consultas" class="btn btn-second" name="back"><span class="fa fa-arrow-circle-left"></span></a>

<div class="container p-4">
    <form method="POST" action="#">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputEmail4">Nome do profisional</label>
                <select class="form-select custom-select" name="idProfessional" required>
                    <option value="">Selecione o médico</option>
                    <?php foreach ($records_pro as $record) : ?>
                        <option value="<?= $record['idProfessional'] ?>"><?= $record['Name'] ?></option>
                    <?php endforeach ?>
                </select>
                <!-- <input type="text" class="form-control" id="inputEmail4" name="name_professional" placeholder="Nome completo"> -->
            </div>

            <?php foreach ($records as $record) : ?>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Nome do paciente</label>
                    <input type="text" class="form-control" id="inputPassword4" name="name_patient" placeholder="Nome completo" value="<?= $record['Name_patient'] ?>">
                </div>
                <div class="form-group col-md-3">
                    <label for="inputPassword4">Data da consulta</label>
                    <input type="date" class="form-control" id="inputPassword4" name="date" placeholder="dd/mm/aaaa" value="<?= $record['Date'] ?>">
                </div>
                <div class="form-group col-md-3">
                    <label for="inputAddress">Horário</label>
                    <input type="time" class="form-control" id="inputAddress" name="hours" placeholder="hh:mm" value="<?= $record['Hours'] ?>">
                </div>
                <div class="form-group col-md-3">
                    <label for="inputAddress">Telefone do paciente</label>
                    <input type="text" class="form-control" id="inputAddress" name="telephone_patient" placeholder="(xx) xxxxx-xxxx" value="<?= $record['Telephone_patient'] ?>">
                </div>
                <div class="form-group col-md-3">
                    <label for="inputEmail4">Convênio</label>
                    <select class="form-select custom-select" id="inputEmail4" name="idMedical_insurance" required value="<?= $record['idMedical_insurance'] ?>">
                        <option value="">Selecione o convênio</option>
                        <?php foreach ($records_m as $record) : ?>
                            <option value="<?= $record['idMedical_insurance'] ?>"><?= $record['Name'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group col-md-12">
                    <button type="submit" class="btn btn-second" name="salve">Salvar</button>
                </div>
            <?php endforeach ?>
    </form>
</div>