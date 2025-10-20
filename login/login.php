<?php

session_start();

require_once '../database/conexao.php';
$connection = newConnection();


function trueLogin($email, $pass)
{
    $connection = newConnection();

    $status = 0;

    $sql = "SELECT idPatient FROM patient WHERE Email = '" . $email . "' and Password = '" . $pass . "'";
    $sql1 = "SELECT idProfessional FROM professional WHERE Email = '" . $email . "' and Password = '" . $pass . "'";
    $sql2 = "SELECT idBusiness FROM business WHERE Email = '" . $email . "' and Password = '" . $pass . "'";

    $result = $connection->query($sql);
    $result1 = $connection->query($sql1);
    $result2 = $connection->query($sql2);

    if ($result->num_rows > 0) {
        $status = 1;
        $id = $result->fetch_assoc();
        $_SESSION["idPatient"] = $id['idPatient'];
    } else if ($result1->num_rows > 0) {
        $status = 2;
        $id = $result1->fetch_assoc();
        $_SESSION["idProfessional"] = $id['idProfessional'];
    } else if ($result2->num_rows > 0) {
        $status = 3;
        $id = $result2->fetch_assoc();
        $_SESSION["idBusiness"] = $id['idBusiness'];
    } else {
        $status = 0;
    }


    return $status;
}

if (isset($_POST['signin2'])) {
    $dados["Email"."Password"] = $_POST['signin2'];

    $email = $_POST['Email'];
    $password = $_POST['Password'];

        $statusLogin = trueLogin($email, $password);
        if (!$statusLogin) {
            die('Erro: Login' . $connection->connect_error);
        } else if($statusLogin == 1){
            if (!empty($_POST['signin2']["remember"])) {
                setcookie("Email", $_POST['signin2']["Email"], time() + 3600);
                setcookie("Email", $_POST['signin2']["Email"],);
                setcookie("Password", $_POST['signin2']["Password"], time() + 3600);
            } else {
                setcookie("Email", "");
                setcookie("Password", "");
            }
            $_SESSION['time'] = time();
            header("Location: ../indexp.php");

            die('Não ignore meu cabeçalho...');
        }else if($statusLogin == 2){
            if (!empty($_POST['signin2']["remember"])) {
                setcookie("Email", $_POST['signin2']["Email"], time() + 3600);
                setcookie("Email", $_POST['signin2']["Email"],);
                setcookie("Password", $_POST['signin2']["Password"], time() + 3600);
            } else {
                setcookie("Email", "");
                setcookie("Password", "");
            }
            $_SESSION['time'] = time();
            header("Location: ../indexm.php");

            die('Não ignore meu cabeçalho...');
        }else if($statusLogin == 3){
            if (!empty($_POST['signin2']["remember"])) {
                setcookie("Email", $_POST['signin2']["Email"], time() + 3600);
                setcookie("Email", $_POST['signin2']["Email"],);
                setcookie("Password", $_POST['signin2']["Password"], time() + 3600);
            } else {
                setcookie("Email", "");
                setcookie("Password", "");
            }
            $_SESSION['time'] = time();
            header("Location: ../indexb.php");

            die('Não ignore meu cabeçalho...');
        }
    }

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MedSched</title>
    <link rel="icon" href="../images/logo_saude.png">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">

        <!-- entrar -->
        <div class="content first-content">
            <div class="first-column">
                <h2 class="title title-primary">Seja bem vindo!</h2>
                <p class="description description-primary">Insira seus dados pessoais</p>
                <p class="description description-primary">e comece a jornada conosco</p>
                <img src="images/paciente.png" class="w-50">
                <div>
                    <button id="signin" class="btn btn-primary">Entrar</button>
                </div>
            </div>
            <div class="second-column">
                <h2 class="title title-second">Cadastrar</h2>
                <div class="social-media">
                    <ul class="list-social-media">
                        <a class="link-social-media" href="#">
                            <li class="item-social-media">
                                <i class="fab fa-facebook-f"></i>
                            </li>
                        </a>
                        <a class="link-social-media" href="#">
                            <li class="item-social-media">
                                <i class="fab fa-google-plus-g"></i>
                            </li>
                        </a>
                    </ul>
                    <div class="social-media">
                        <a href="login.php?dir=../login&file=cadastrar_paciente" type="submit" class="btn btn-second">Paciente</a>
                        <a href="login.php?dir=../login&file=cadastrar_medico" type="submit" class="btn btn-second">Medico</a>
                        <a href="login.php?dir=../login&file=cadastrar_empresa" type="submit" class="btn btn-second">Empresa</a>
                    </div>
                </div><!-- social media -->
                <div class="second-column-php">
                    <?php
                    if (isset($_GET['dir']) && isset($_GET['file'])) {
                        include(__DIR__ . "/{$_GET['dir']}/{$_GET['file']}.php");
                    } else {
                        include(__DIR__ . "/cadastrar_paciente.php");
                    }
                    ?>
                </div>
            </div>
        </div><!-- second-content -->

        <!-- cadastrar -->
        <div class="content second-content">
            <div class="first-column">
                <h2 class="title title-primary">Olá amigo!</h2>
                <p class="description description-primary">Muito bom te ver novamente.</p>
                <p class="description description-primary">Faça seu login e navegue com a gente.</p>
                <img src="images/login.png" class="w-50">
                <div>
                    <button id="signup" class="btn btn-primary">Cadastrar</button>
                </div>
            </div>
            <div class="second-column">
                <h2 class="title title-second">Login</h2>
                <ul class="list-social-media">
                    <a class="link-social-media" href="#">
                        <li class="item-social-media">
                            <i class="fab fa-facebook-f"></i>
                        </li>
                    </a>
                    <a class="link-social-media" href="#">
                        <li class="item-social-media">
                            <i class="fab fa-google-plus-g"></i>
                        </li>
                    </a>
                </ul>
                <p class="description description-second">Ou use sua conta para entrar:</p>
                <form name="signin2" class="form" action="#" method="post">

                    <div class="col-auto">
                        <div class="input-group mb-2">
                            <div class="input-group-text"><span class="fa fa-envelope"></span></div>
                            <input type="text" class="form-control" id="inlineFormInputGroup" name="Email" value="<?php if (isset($_COOKIE["Email"])) {
                                                                                                                        echo $_COOKIE["Email"];
                                                                                                                    } ?>" placeholder="Email">
                        </div>
                    </div>

                    <div class="col-auto">
                        <div class="input-group mb-2">
                            <div class="input-group-text"><span class="fa fa-lock"></span></div>
                            <input type="password" class="form-control" id="inlineFormInputGroup" name="Password" value="<?php if (isset($_COOKIE["Password"])) {
                                                                                                                                echo $_COOKIE["Password"];
                                                                                                                            } ?>" placeholder="Senha">
                        </div>
                    </div>

                    <a class="password" href="#">Esqueceu sua senha?</a>
                    <div class="w-100 d-flex justify-content-center">
                        <button class="btn btn-second" id="signin2" name="signin2" type="submit">Entrar</button>
                    </div>
                </form>
            </div><!-- second column -->
        </div>
    </div>
    <script src="js/app.js"></script>
</body>

</html>