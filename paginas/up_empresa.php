<?php
require_once 'database/conexao.php';
$records_p = [];
$connection = newConnection();

if (isset($_GET['update'])) { //botão
    if (count($_POST) > 0) {
        $dados = $_POST;
        $updSQL = "UPDATE business SET name = ?, email = ?, password = ?, city = ?, NBHD = ?, street = ?, number = ?, WHERE idBusiness = ?";
        $stmt = $connection->prepare($updSQL);
        $params = [
            $dados['name'],
            $dados['email'],
            $dados['password'],
            $dados['city'],
            $dados['NBHD'],
            $dados['street'],
            $dados['number'],
            $_GET['update']
        ];
        $stmt->bind_param("ssssssii", ...$params);
        $stmt->execute();
    }
}
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

<a href="indexb.php?dir=paginas&file=config_empresa" class="btn btn-second" name="back"><span class="fa fa-arrow-circle-left"></span></a>

<div class="container p-4">

    <form method="POST">
        <?php foreach ($records_b as $record) : ?>
            <h1 class="text-center"><?= $record['Name'] ?></h1>
            <input type="hidden" name="operacao" value="delete">
            <div class="form-row">
                <div class="form-group col-md-9">
                    <label for="inputEmail4">Nome completo</label>
                    <input type="text" class="form-control" id="inputEmail4" name="name" placeholder="Nome completo" value="<?= $record['Name'] ?>">
                </div>
                <div class="form-group col-md-3">
                    <label for="inputPassword4">Cidade</label>
                    <input type="text" class="form-control" id="inputPassword4" name="city" placeholder="Cidade" value="<?= $record['City'] ?>">
                </div>
                <div class="form-group col-md-9">
                    <label for="inputEmail4">Email</label>
                    <input type="text" class="form-control" id="inputEmail4" name="email" placeholder="Nome completo" value="<?= $record['Email'] ?>">
                </div>
                <div class="form-group col-md-3">
                    <label for="inputEmail4">Senha</label>
                    <input type="text" class="form-control" id="inputEmail4" name="password" placeholder="Nome completo" value="<?= $record['Password'] ?>">
                </div>
                <div class="form-group col-4">
                    <label for="inputAddress">Bairro</label>
                    <input type="text" class="form-control" id="inputAddress" name="NBHD" placeholder="Bairro" value="<?= $record['NBHD'] ?>">
                </div>
                <div class="form-group col-md-4">
                    <label for="inputAddress2">Rua</label>
                    <input type="text" class="form-control" id="inputAddress2" name="street" placeholder="Rua" value="<?= $record['Street'] ?>">
                </div>
                <div class="form-group col-md-4">
                    <label for="inputCity">Numero</label>
                    <input type="text" class="form-control" id="inputCity" name="number" placeholder="N°" value="<?= $record['Number'] ?>">
                </div>
                <div class="form-group col-md-12">
                    <button type="submit" class="btn btn-second" name="salve">Salvar</button>
                </div>
            </div>
        <?php endforeach ?>
    </form>
</div>