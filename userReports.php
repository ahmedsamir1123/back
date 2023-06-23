<?php

include "connection.php";


// Define the API endpoint
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $sql = "SELECT * FROM report ";
    $result = mysqli_query($conn, $sql);
    $rows = array();
    while($r = mysqli_fetch_assoc($result)) {
        $rows[] = $r;
    }

    header('Content-Type: application/json');
    echo json_encode($rows);
}


if($_SERVER['REQUEST_METHOD'] == 'DELETE'){
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    $data = json_decode(file_get_contents('php://input'), true);

    $rid =$_GET['rid'];
    $sql = "DELETE FROM report WHERE rid = '$rid' LIMIT 1";
    
    if (mysqli_query($conn, $sql)) {
      $response= json_encode(array('message' => 'Report deleted'));
    } else {
      $response=json_encode(array('message' => 'Error deleting report'));
    }
    header('Content-Type: application/json');
echo json_encode($response);
}

