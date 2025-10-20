<?php

// $date = DateTime::createFromFormat('d/m/Y', $dados['date']);
// $date ? $date->format('Y-m-d') : null,

require_once 'database/conexao.php';
$records_p = [];
$connection = newConnection();

if (isset($_GET['delete'])) { //botão   
    $delSQL = "DELETE FROM query WHERE idQuery = ?";
    $stmt = $connection->prepare($delSQL);
    $stmt->bind_param("i", $_GET['delete']);
    $stmt->execute();
}

$sql_p = "SELECT * from query inner join Medical_insurance on Medical_insurance.idMedical_insurance = query.idMedical_insurance where idProfessional = '" .$_SESSION["idProfessional"]. "' ORDER BY `date`";
$result_p = $connection->query($sql_p);

if ($result_p->num_rows > 0) {
    while ($row = $result_p->fetch_assoc()) {
        $records_p[] = $row;
    }
} else {
    echo $connection->error;
}

$records_pro = [];

$sql_pro = "SELECT professional.name from professional inner join query on query.idProfessional = professional.idProfessional";
$result_pro = $connection->query($sql_pro);

if ($result_pro->num_rows > 0) {
    while ($row = $result_pro->fetch_assoc()) {
        $records_pro[] = $row;
    }
} else {
    echo $connection->error;
}

$name = "SELECT name from professional where idProfessional = '" .$_SESSION["idProfessional"]. "'";
$name = $connection->query($name);
$name = $name->fetch_assoc();

?>

<!-- html -->
<div class="container">

    <h1><?= $name['name'] ?></h1>

    <table class="table table-light text-center">
        <thead>
            <tr>
                <th scope="col">Nome do paciente</th>
                <th scope="col">Data</th>
                <th scope="col">Horário</th>
                <th scope="col">Telefone</th>
                <th scope="col">Convênio</th>
                <th scope="col">Confirmação</th>
                <th scope="col">Editar</th>
                <th scope="col">Excluir</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($records_p as $record) : ?>
                <tr>
                    <th scope="row"><?= $record['Name_patient'] ?></th>
                    <td><?= $record['Date'] ?></td>
                    <td><?= $record['Hours'] ?></td>
                    <td><?= $record['Telephone_patient'] ?></td>
                    <td><?= $record['Name'] ?></td>
                    <td><button type="submit" class="btn btn-second"><span class="fa fa-check"></span></button></td>
                    <td><a href="indexm.php?dir=paginas&file=up_consulta&update=<?= $record['idQuery'] ?>" class="btn btn-second" name="update"><span class="fa fa-pencil-square-o"></span></a></td>
                    <td><a href="indexm.php?dir=paginas&file=gerenciar_consultas&delete=<?= $record['idQuery'] ?>" class="btn btn-second" name="delete"><span class="fa fa-trash-o"></span></a></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>