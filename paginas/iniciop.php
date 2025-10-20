<?php
require_once "database/conexao.php";
$connection = newConnection();

$records_spe = [];
$sql_spe = "SELECT DISTINCT specialty from professional";
$result_spe = $connection->query($sql_spe);

if ($result_spe->num_rows > 0) {
    while ($row = $result_spe->fetch_assoc()) {
        $records_spe[] = $row;
    }
} else {
    echo $connection->error;
}

$records_c = [];
$sql_c = "SELECT DISTINCT city from professional";
$result_c = $connection->query($sql_c);

if ($result_c->num_rows > 0) {
    while ($row = $result_c->fetch_assoc()) {
        $records_c[] = $row;
    }
} else {
    echo $connection->error;
}

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

if (count($_POST) > 0) {
    $dados = $_POST;
    $connection = newConnection();

    $records_p = [];

    require_once "database/conexao.php";
    if($dados['Name'] != "0" and $dados['Specialty'] != "0" and  $dados['City'] != "0"){
        $sql_p = "SELECT * FROM professional WHERE name ='" . $dados['Name'] . "' and specialty = '" . $dados['Specialty'] . "' and city ='" . $dados['City'] . "'";
        $result_p = $connection->query($sql_p);
    }else if($dados['Name'] != "0" and $dados['Specialty'] != "0"){
        $sql_p = "SELECT * FROM professional WHERE name ='" . $dados['Name'] . "' and specialty = '" . $dados['Specialty'] . "'";
        $result_p = $connection->query($sql_p);
    }else if($dados['Name'] != "0" and $dados['City'] != "0"){
        $sql_p = "SELECT * FROM professional WHERE name ='" . $dados['Name'] . "' and city = '" . $dados['City'] . "'";
        $result_p = $connection->query($sql_p);
    }else if($dados['Specialty'] != "0" and $dados['City'] != "0"){
        $sql_p = "SELECT * FROM professional WHERE specialty ='" . $dados['Specialty'] . "' and city = '" . $dados['City'] . "'";
        $result_p = $connection->query($sql_p);
    } else{
        $sql_p = "SELECT * FROM professional WHERE name ='" . $dados['Name'] . "' or specialty = '" . $dados['Specialty'] . "' or city ='" . $dados['City'] . "'";
        $result_p = $connection->query($sql_p);
    }
    if ($result_p->num_rows > 0) {
        while ($row = $result_p->fetch_assoc()) {
            $records_p[] = $row;
        }
    } else {
        echo $connection->error;
    }
} 

$connection->close();
?>

<div class="container p-4">
    <!-- was validated  -->
    <form class="form-row" method="post" action="#">
        <div class="form-group col-md-4">
            <label for="inputEmail4">Nome do profisional</label>
            <select class="form-select custom-select" name="Name">
                <option value="0">Selecione o médico</option>
                <?php foreach ($records_pro as $record) : ?>

                    <option value="<?= $record['Name'] ?>"><?= $record['Name'] ?></option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="inputEmail4">Especialidade</label>
            <select class="form-select custom-select" name="Specialty">
                <option value="0">Selecione a especialidade</option>
                <?php foreach ($records_spe as $record) : ?>

                    <option value="<?= $record['specialty'] ?>"><?= $record['specialty'] ?></option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="form-group col-md-3">
            <label for="inputEmail4">Cidade</label>
            <select class="form-select custom-select" name="City">
                <option value="0">Selecione a cidade</option>
                <?php foreach ($records_c as $record) : ?>

                    <option value="<?= $record['city'] ?>"><?= $record['city'] ?></option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="form-group col-md-1 div-btn">
            <button type="submit" class="h-50 btn btn-second"><span class="fa fa-search"></span></button>
        </div>
    </form>

</div>
<div>
    <table class="table table-light text-center">
        <tbody>
        <?php if(isset($records_p)) : ?>
            <?php foreach ($records_p as $record) : ?>
                <tr>
                    <th scope="row"><?= $record['Name'] ?></th>
                    <td><?= $record['Specialty'] ?></td>
                    <td><?= $record['City'] ?></td>
                    <td><?= $record['Telephone'] ?></td>
                    <td><?= $record['Registry'] ?></td>
                    <td><a href="indexp.php?dir=paginas&file=consulta_paciente&idProfessional=<?= $record['idProfessional'] ?>" class="btn btn-second" name="marcar"><span class="fa fa-plus"></span></a></td>
                </tr>
            <?php endforeach ?>
            <?php else : ?>
                <tr>
                    
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>