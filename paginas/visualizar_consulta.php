<?php

// $date = DateTime::createFromFormat('d/m/Y', $dados['date']);
// $date ? $date->format('Y-m-d') : null,

require_once 'database/conexao.php';
$records_q = [];
$connection = newConnection();

$sql_q = "SELECT * FROM query where query.idPatient = '" .$_SESSION['idPatient']. "' ORDER BY `date`";
$result_q = $connection->query($sql_q);

if ($result_q->num_rows > 0) {
    while ($row = $result_q->fetch_assoc()) {
        $records_q[] = $row;
    }
} else {
    echo $connection->error;
}

$records_pro = [];

$sql_pro = "SELECT *, Medical_insurance.name as 'nameM', professional.name as 'nameP' from query inner join Medical_insurance on Medical_insurance.idMedical_insurance = query.idMedical_insurance inner join professional on professional.idProfessional = query.idprofessional  where query.idPatient = '" .$_SESSION['idPatient']."' ORDER BY `date`";
$result_pro = $connection->query($sql_pro);

if ($result_pro->num_rows > 0) {
    while ($row = $result_pro->fetch_assoc()) {
        $records_pro[] = $row;
    }
} else {
}

$name = "SELECT name from patient where idPatient = '" .$_SESSION["idPatient"]. "'";
$name = $connection->query($name);
$name = $name->fetch_assoc();

?>

<!-- html -->
<div class="container">

    <table class="table table-light text-center">
        <thead>
            <tr>
                <th scope="col">Nome do profissional</th>
                <th scope="col">Data</th>
                <th scope="col">Horário</th>
                <th scope="col">Telefone</th>
                <th scope="col">Convênio</th>
            </tr>
        </thead>
        <tbody>
                <h1><?= $name['name'] ?></h1>
            <?php foreach ($records_pro as $record) : ?>
                <tr>
                    <th scope="row"><?= $record['nameP'] ?></th>
                    <td><?= $record['Date'] ?></td>
                    <td><?= $record['Hours'] ?></td>
                    <td><?= $record['Telephone_patient'] ?></td>
                    <td><?= $record['nameM'] ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>