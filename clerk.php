<?php
include "connection.php";

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization ");



if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $sql = "SELECT * FROM feedback";
    $result = mysqli_query($conn, $sql);

    $rows = array();
    while($r = mysqli_fetch_assoc($result)) {
        $rows[] = $r;
    }

    header('Content-Type: application/json');
    echo json_encode($rows);
}



