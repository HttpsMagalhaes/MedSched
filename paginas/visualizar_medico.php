<?php

// $date = DateTime::createFromFormat('d/m/Y', $dados['date']);
// $date ? $date->format('Y-m-d') : null,

require_once 'database/conexao.php';
$records_p = [];
$connection = newConnection();

$sql_p = "SELECT * FROM professional where professional.idBusiness = '" .$_SESSION["idBusiness"]. "'";
$result_p = $connection->query($sql_p);

if ($result_p->num_rows > 0) {
    while ($row = $result_p->fetch_assoc()) {
        $records_p[] = $row;
    }
} else {
    echo $connection->error;
}

$sql_pro = "SELECT DISTINCT business.name from business inner join professional on professional.idBusiness = business.idBusiness where professional.idBusiness = '" .$_SESSION["idBusiness"]. "'";
$result_pro = $connection->query($sql_pro);

if ($result_pro->num_rows > 0) {
    while ($row = $result_pro->fetch_assoc()) {
        $records_pro[] = $row;
    }
} else {
    echo $connection->error;
}

$name = "SELECT name from business where idBusiness = '" .$_SESSION["idBusiness"]. "'";
$name = $connection->query($name);
$name = $name->fetch_assoc();
?>

<!-- html -->
<div class="container">
    <h1><?= $name['name'] ?></h1>
    <table class="table table-light text-center">
        <thead>
            <tr>
                <th scope="col">Nome do profissional</th>
                <th scope="col">Especialidade</th>
                <th scope="col">CRM</th>
                <th scope="col">Telefone</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($records_p as $record) : ?>
                <th scope="row"><?= $record['Name'] ?></th>
                <td><?= $record['Specialty'] ?></td>
                <td><?= $record['Registry'] ?></td>
                <td><?= $record['Telephone'] ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>