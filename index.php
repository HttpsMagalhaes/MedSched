<!doctype html>
<html lang="en">

<head>
  <title>MedSched</title>
  <link rel="" href="index.php?dir=images&file=logo.png">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" href="images/logo_saude.png">
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="bootstrap/css/style.css">
</head>

<body>
  <div class="wrapper d-flex align-items-stretch">
    <nav id="sidebar" class="active">
      <ul class="list-unstyled components mb-5">
        <li class="active">
          <a href="index.php?dir=paginas&file=inicio"><img src="images/logo_branca.png" alt="" class="logo-image"></span>MedSched</a>
        </li>
        <li class="active">
          <a href="index.php?dir=paginas&file=inicio"><span class="fa fa-home"></span>Home</a>
        </li>
        <li>
          <a href="login/login.php"><span class="fa fa-sign-in"></span>Login</a>
        </li>
        <li>
          <a href="login/login.php"><span class="fa fa-id-card-o"></span>Cadastrar</a>
        </li>
        <li>
          <a href="index.php?dir=paginas&file=contato"><span class="fa fa-paper-plane"></span>Contato</a>
        </li>
      </ul>

      <div class="footer">
        <p>
          Copyright &copy; MedSched.com
        </p>
        <p>
          <span class="fa fa-envelope"></span> | <span class="fa fa-whatsapp"></span> | <span class="fa fa-linkedin-square"></span> | <span class="fa fa-instagram"></span>
        </p>
      </div>
    </nav>


    <div id="content" class="p-4 p-md-5">

      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">

          <button type="button" id="sidebarCollapse" class="rounded btn-second">
            <i class="fa fa-bars"></i>
            <span class="sr-only"></span>
          </button>
          <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa fa-bars"></i>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="nav navbar-nav ml-auto">
              <li class="nav-item">
                <a class="nav-link" href="index.php?dir=paginas&file=contato_especialista">Converse com um especialista</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>

      <main>
        <?php
        if (isset($_GET['dir']) && isset($_GET['file'])) {
          include(__DIR__ . "/{$_GET['dir']}/{$_GET['file']}.php");
        } else {
          include(__DIR__ . "/paginas/inicio.php");
        }
        ?>
      </main>
    </div>
  </div>

  <script src="bootstrap/js/jquery.min.js"></script>
  <script src="bootstrap/js/popper.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <script src="bootstrap/js/main.js"></script>
  <script src="bootstrap/js/bootstrap.bundle.js"></script>
</body>

</html>