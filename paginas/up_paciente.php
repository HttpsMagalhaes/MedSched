<?php
require_once 'database/conexao.php';
$records_p = [];
$connection = newConnection();

if (isset($_GET['update'])) { //botão
    if (count($_POST) > 0) {
        $dados = $_POST;
        $updSQL = "UPDATE patient SET name = ?, birth = ?, email = ?, password = ? WHERE idPatient = ?";
        $stmt = $connection->prepare($updSQL);
        $params = [
            $dados['name'],
            $dados['birth'],
            $dados['email'],
            $dados['password'],
            $_GET['update']
        ];
        $stmt->bind_param("ssssi", ...$params);
        $stmt->execute();
    }
}

$sql_p = "SELECT * FROM patient";
$result_p = $connection->query($sql_p);

if ($result_p->num_rows > 0) {
    while ($row = $result_p->fetch_assoc()) {
        $records_p[] = $row;
    }
} else {
    echo $connection->error;
}
?>

<a href="indexp.php?dir=paginas&file=config_paciente" class="btn btn-second" name="back"><span class="fa fa-arrow-circle-left"></span></a>

<div class="container p-4">

    <form method="POST">
        <?php foreach ($records_p as $record) : ?>
            <h1 class="text-center"><?= $record['Name'] ?></h1>
            <input type="hidden" name="operacao" value="delete">
            <div class="form-row">
                <div class="form-group col-md-9">
                    <label for="inputEmail4">Nome completo</label>
                    <input type="text" class="form-control" id="inputEmail4" name="name" placeholder="Nome completo" value="<?= $record['Name'] ?>">
                </div>
                <div class="form-group col-md-3">
                    <label for="inputPassword4">Data de nascimento</label>
                    <input type="date" class="form-control" id="inputPassword4" name="birth" placeholder="dd/mm/aaaa" value="<?= $record['Birth'] ?>">
                </div>
                <div class="form-group col-md-12">
                    <label for="inputAddress">Email</label>
                    <input type="text" class="form-control" id="inputAddress" name="email" placeholder="email@gmail" value="<?= $record['Email'] ?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputAddress2">Senha</label>
                    <input type="text" class="form-control" id="inputAddress2" name="password" placeholder="Senha" value="<?= $record['Password'] ?>">
                </div>
                <div class="form-group col-md-12">
                    <button type="submit" class="btn btn-second" name="salve">Salvar</button>
                </div>
            </div>
        <?php endforeach ?>
    </form>
</div>