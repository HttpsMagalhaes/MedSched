<?php

require_once('database/conexao.php');


if (count($_POST) > 0) {
  $dados = $_POST;
  $sql = "INSERT INTO contact_speciality (email, subject, description) VALUES (?, ?, ?)";

  $connection = newConnection();
  $stmt = $connection->prepare($sql);

  // $date = DateTime::createFromFormat('d/m/Y', $dados['date']);

  $params = [
    $dados['email'],
    $dados['subject'],
    // $date ? $date->format('Y-m-d') : null,
    $dados['description']
  ];

  $stmt->bind_param("sss", ...$params);

  if ($stmt->execute()) {
    unset($dados);
  }
}
?>

<div class="container p-4">
  <form class="form" method="POST" action="#">
    <div class="form-row">
      <div class="form-group col-md-12">
        <div class="custom-control custom-switch">
          <input type="checkbox" class="custom-control-input css-checked" id="customSwitch1">
          <label class="custom-control-label" for="customSwitch1" >Quer se identificar?</label>
        </div>
      </div>
      <div class="form-group col-md-12">
        <label for="inputEmail4">Email</label>
        <input type="text" class="form-control" id="inputEmail4" name= "email" placeholder="Email">
      </div>
      <div class="form-group col-md-12">
        <label for="inputEmail4">Assunto</label>
        <input type="text" class="form-control" id="inputEmail4" name= "subject" placeholder="Assunto">
      </div>
      <div class="form-group col-md-12">
        <label for="inputCity">Mensagem</label>
        <textarea type="text" class="form-control" id="inputCity" name= "description" placeholder="Descrição"></textarea>
      </div>
      <div class="form-group col-md-12">
        <button type="submit" class="btn btn-second">Enviar</button>
      </div>
  </form>
</div>