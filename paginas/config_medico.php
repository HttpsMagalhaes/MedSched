<?php
require_once 'database/conexao.php';
$records_pro = [];
$connection = newConnection();

$sql_pro = "SELECT * FROM professional where idProfessional = '" .$_SESSION["idProfessional"]. "'";
$result_pro = $connection->query($sql_pro);

if ($result_pro->num_rows > 0) {
    while ($row = $result_pro->fetch_assoc()) {
        $records_pro[] = $row;
    }
} else {
    echo $connection->error;
}
?>
<div class="container p-4">

    <form>
        <?php foreach ($records_pro as $record) : ?>
            <h1 class="text-center"><?= $record['Name'] ?></h1>
            <input type="hidden" name="operacao" value="delete">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="inputEmail4">Nome completo:</label>
                    <p for="inputEmail4"><?= $record['Name'] ?></p>
                </div>
                <div class="form-group col-md-4">
                    <label for="inputPassword4">Data de nascimento:</label>
                    <p for="inputEmail4"><?= $record['Birth'] ?></p>
                </div>
                <div class="form-group col-md-4">
                    <label for="inputAddress2">Telefone:</label>
                    <p for="inputEmail4"><?= $record['Telephone'] ?></p>
                </div>
                <div class="form-group col-md-4">
                    <label for="inputAddress">Email:</label>
                    <p for="inputEmail4"><?= $record['Email'] ?></p>
                </div>
                <div class="form-group col-md-4">
                    <label for="inputAddress2">Senha:</label>
                    <p for="inputEmail4"><?= $record['Password'] ?></p>
                </div>
                <div class="form-group col-md-4">
                    <label for="inputAddress2">Cidade:</label>
                    <p for="inputEmail4"><?= $record['City'] ?></p>
                </div>
                <div class="form-group col-md-4">
                    <label for="inputAddress2">Especialidade:</label>
                    <p for="inputEmail4"><?= $record['Specialty'] ?></p>
                </div>
                <div class="form-group col-md-4">
                    <label for="inputAddress2">Empresa:</label>
                    <p for="inputEmail4"><?= $record['idBusiness'] ?></p>
                </div>
                <div class="form-group col-md-4">
                    <label for="inputAddress2">CRM:</label>
                    <p for="inputEmail4"><?= $record['Registry'] ?></p>
                </div>
                <div class="form-group col-md-9">
                    <a class="btn btn-second" href="index.php?dir=paginas&file=up_medico&update=<?= $record['idProfessional'] ?>"><span class="fa fa-pencil-square-o"></span>Editar</a>
                </div>
                <div class="form-group col-md-3">
                    <a class="btn btn-second" href="../login/login.php"><span class="fa fa-sign-out"></span> Sair</a>
                </div>
            <?php endforeach ?>

    </form>
</div>