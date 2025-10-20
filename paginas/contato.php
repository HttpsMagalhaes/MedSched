<?php

// require_once $_SERVER['DOCUMENT_ROOT']."/projeto 1 - boostrap-drive/projeto 1 - boostrap/database/conexao.php";
require_once "database/conexao.php";


if (count($_POST) > 0) {
  $dados = $_POST;
  $sql = "INSERT INTO contact (email, topic, message) VALUES (?, ?, ?)";

  $connection = newConnection();
  $stmt = $connection->prepare($sql);

  // $date = DateTime::createFromFormat('d/m/Y', $dados['date']);

  $params = [
    $dados['email'],
    $dados['topic'],
    // $date ? $date->format('Y-m-d') : null,
    $dados['message']
  ];

  $stmt->bind_param("sss", ...$params);

  if ($stmt->execute()) {
    unset($dados);
  }
}
?>

<div class="container p-4">
  <form class="form" method="POST" action="#">
    <div class="form-group col-md-12">
      <label for="inputEmail4">Email</label>
      <input type="text" class="form-control" id="inputEmail4" name="email" placeholder="Email">
    </div>
    <div class="form-group col-md-12">
      <label for="inputEmail4">Assunto</label>
      <input type="text" class="form-control" id="inputEmail4" name="topic" placeholder="Topico">
    </div>
    <div class="form-group col-md-12">
      <label for="inputCity">Mensagem</label>
      <textarea type="text" class="form-control" id="inputCity" name="message" placeholder="Descrição"></textarea>
    </div>
    <div class="form-group col-md-12">
      <button type="submit" class="btn btn-second">Enviar</button>
    </div>
  </form>
</div>