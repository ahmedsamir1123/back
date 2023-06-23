<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization ");
$host='localhost';
$name = 'root';
$pass= '';
$dbName= 'final';

$conn = mysqli_connect($host,$name,$pass,$dbName);


if(!$conn){
    die("connection failed:" . mysqli_connect_error());
}

