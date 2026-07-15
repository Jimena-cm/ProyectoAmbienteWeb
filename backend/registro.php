<?php

require_once "conexion.php";


header("Content-Type: application/json");


if($_SERVER["REQUEST_METHOD"]=="POST"){


$name = $_POST["name"];

$email = $_POST["email"];

$phone = $_POST["phone"];

$address = $_POST["address"];

$password = $_POST["password"];



try{


$stmt=$pdo->prepare(

"INSERT INTO users
(name,email,password,phone,address)

VALUES
(?,?,?,?,?)"

);



$stmt->execute([

$name,
$email,
$password,
$phone,
$address

]);



echo json_encode([

"success"=>true,

"message"=>"Usuario registrado correctamente"

]);



}catch(PDOException $e){


echo json_encode([

"success"=>false,

"message"=>"El correo ya existe"

]);


}


}

?>