<?php
require_once 'database/conexao.php';
$records_p = [];
$connection = newConnection();

if (isset($_GET['update'])) { //botão
    if (count($_POST) > 0) {
        $dados = $_POST;
        $updSQL = "UPDATE professional SET name = ?, birth = ?, email = ?, password = ?, specialty = ?, telephone = ?, registry = ?, city = ?, universityDegree = ?, idBusiness = ? WHERE idProfessional = ?";
        $stmt = $connection->prepare($updSQL);
        $params = [
            $dados['name'],
            $dados['birth'],
            $dados['email'],
            $dados['password'],
            $dados['specialty'],
            $dados['telephone'],
            $dados['registry'],
            $dados['city'],
            $dados['universityDegree'],
            $dados['idBusiness'],
            $_GET['update']
        ];
        $stmt->bind_param("sssssssssii", ...$params);
        $stmt->execute();
    }
}
$sql_pro = "SELECT * FROM professional";
$result_pro = $connection->query($sql_pro);

if ($result_pro->num_rows > 0) {
    while ($row = $result_pro->fetch_assoc()) {
        $records_pro[] = $row;
    }
} else {
    echo $connection->error;
}
?>

<a href="indexm.php?dir=paginas&file=config_medico" class="btn btn-second" name="back"><span class="fa fa-arrow-circle-left"></span></a>

<div class="container p-4">

    <form method="POST">
        <?php foreach ($records_pro as $record) : ?>
            <h1 class="text-center">"<?= $record['Name'] ?>"</h1>
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
                <div class="form-group col-md-4">
                    <label for="inputAddress2">Senha</label>
                    <input type="text" class="form-control" id="inputAddress2" name="password" placeholder="Senha" value="<?= $record['Password'] ?>">
                </div>
                <div class="form-group col-md-4">
                    <label for="inputCity">Telefone</label>
                    <input type="text" class="form-control" id="inputCity" name="telephone" placeholder="Digite novamente" value="<?= $record['Telephone'] ?>">
                </div>
                <div class="form-group col-md-3">
                    <label for="inputCity">Especialidade</label>
                    <input type="text" class="form-control" id="inputCity" name="specialty" placeholder="Digite novamente" value="<?= $record['Specialty'] ?>">
                </div>
                <div class="form-group col-md-3">
                    <label for="inputCity">CRM</label>
                    <input type="text" class="form-control" id="inputCity" name="registry" placeholder="Digite novamente" value="<?= $record['Registry'] ?>">
                </div>

                <div class="form-group col-md-3">
                    <label for="inputCity">Cidade</label>
                    <input type="text" class="form-control" id="inputCity" name="city" placeholder="Digite novamente" value="<?= $record['City'] ?>">
                </div>
                <div class="form-group col-md-3">
                    <label for="inputCity">Empresa</label>
                    <input type="text" class="form-control" id="inputCity" name="idBusiness" placeholder="Digite novamente" value="<?= $record['idBusiness'] ?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputCity">Diploma</label>
                    <label class="custom-file" for="exampleFormControlFile1">
                        <input type="file" class="form-control-file" id="exampleFormControlFile1" name="universityDegree" value="<?= $record['UniversityDegree'] ?>">
                        Adicioneseu diploma
                    </label>
                </div>
                <div class="form-group col-md-12">
                    <button type="submit" class="btn btn-second" name="salve">Salvar</button>
                </div>
            </div>
        <?php endforeach ?>
    </form>
</div>