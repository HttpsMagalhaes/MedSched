<?php

if (isset($_POST['singup2'])) {

    require_once "../database/conexao.php";

    $sql = "INSERT INTO professional (name, birth, email, password, specialty, telephone, registry, city, universityDegree, idBusiness) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $connection = newConnection();
    $stmt = $connection->prepare($sql);

    $params = [
        $_POST['name'],
        $_POST['birth'],
        $_POST['email'],
        $_POST['login_password'],
        $_POST['specialty'],
        $_POST['telephone'],
        $_POST['registry'],
        $_POST['city'],
        $_POST['universityDegree'],
        $_POST['idBusiness']
    ];

    $stmt->bind_param("sssssssssi", ...$params);

    if ($stmt->execute()) {
        unset($_POST);
    }
}

// pegar empresas
require_once "../database/conexao.php";
$connection = newConnection();

$records_pro = [];
$sql_pro = "SELECT * FROM business";
$result_pro = $connection->query($sql_pro);

if ($result_pro->num_rows > 0) {
    while ($row = $result_pro->fetch_assoc()) {
        $records_pro[] = $row;
    }
} else {
    echo $connection->error;
}
?>

<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

<form name="singup2" class="form" method="post" action="#">
    <div class="col-auto">
        <div class="input-group mb-2">
            <div class="input-group-text"><span class="fa fa-user"></span></div>
            <input type="text" class="form-control w-25" id="inlineFormInputGroup" name="name" placeholder="Nome Completo">
            <div class="input-group-text"><span class="fa fa-calendar"></span></div>
            <input type="date" class="form-control" id="inlineFormInputGroup" name="birth" placeholder="dd/mm/aaaa">
        </div>
    </div>

    <div class="col-auto">
        <div class="input-group mb-2">
            <div class="input-group-text"><span class="fa fa-envelope"></span></div>
            <input type="text" class="form-control w-25" id="inlineFormInputGroup" name="email" placeholder="Email">
            <div class="input-group-text"><span class="fa fa-phone"></span></div>
            <input type="text" class="form-control" id="inlineFormInputGroup" name="telephone" placeholder="Telefone">
        </div>
    </div>

    <div class="col-auto">
        <div class="input-group mb-2">
            <div class="input-group-text"><span class="fa fa-lock"></span></div>
            <input type="password" class="form-control login_password" id="inlineFormInputGroup" name="login_password" placeholder="Senha">
            <input type="password" class="form-control login_password" id="inlineFormInputGroup" name="login_password" placeholder="Digite novamente">
            <button type="button" value="hide" class="eyes form-control showPassword" data-bs-toggle="button">
                <div class="olhinho">
                    <span class="fa fa-eye-slash"></span>
                </div>
            </button>
        </div>
    </div>

    <div class="col-auto">
        <div class="input-group mb-2">
            <div class="input-group-text"><span class="fa fa-stethoscope"></span></div>
            <input type="text" class="form-control" id="inlineFormInputGroup" name="specialty" placeholder="Especialidade">
            <div class="input-group-text"><span class="fa fa-medkit"></span></div>
            <input type="text" class="form-control" id="inlineFormInputGroup" name="registry" placeholder="CRM">
        </div>
    </div>

    <div class="col-auto">
        <div class="input-group mb-2">
            <div class="input-group-text"><span class="fa fa-map-marker"></span></div>
            <input type="text" class="form-control" id="inlineFormInputGroup" name="city" placeholder="Cidade">
            <div class="input-group-text"><span class="fa fa-building"></span></div>
            <select class="form-select" name="idBusiness" required>
                <option value="">Business</option>
                <?php foreach ($records_pro as $record) : ?>
                    <option value="<?= $record['idBusiness'] ?>"><?= $record['Name'] ?></option>
                <?php endforeach ?>
            </select>
        </div>
    </div>

    <div class="col-auto">
        <div class="input-group mb-2">
            <div class="input-group-text"><span class="fa fa-graduation-cap"></span></div>
            <input type="file" class="form-control" id="inlineFormInputGroup" name="universityDegree" placeholder="Diploma">
            <div class="input-group-text">Foto diploma</div>
        </div>
    </div>
    <div class="w-100 d-flex justify-content-center">
        <button type="submit" class="btn btn-second" name="singup2">Cadastrar</button>
    </div>
</form>
<script>
    var btn = document.querySelector('.showPassword');
    var inputPass = document.querySelectorAll('.login_password');

    for (let i = 0; i < inputPass.length; i++) {
        btn.addEventListener('click', function() {
            var olhinho = document.querySelector(".olhinho");
            if (inputPass[i].getAttribute('type') == 'password') {
                for (let j = 0; j < inputPass.length; j++) {
                    olhinho.innerHTML = '<span class="fa fa-eye"></span>'
                    inputPass[i].setAttribute('type', 'text');
                }
            } else {
                for (let j = 0; j < inputPass.length; j++) {
                    inputPass[i].setAttribute('type', 'password');
                    olhinho.innerHTML = '<span class="fa fa-eye-slash"></span>'
                }
            }
        });
    }
</script>