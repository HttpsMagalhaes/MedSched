<?php

function newConnection($base = 'software'){
    $server = 'localhost';
    $user = 'root';
    $password = '';

    $connection = new mysqli($server, $user, $password, $base);

    if($connection -> connect_error){
        die('Erro: ' . $connection -> connect_error);
    }
    return $connection;
}
$base = 'software';
$connection = newConnection($base);
$sql = 'CREATE DATABASE IF NOT EXISTS $base';
$result = $connection -> query($sql);