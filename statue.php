<?php
include "connection.php";

// Define the API endpoint
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $sql = "SELECT * FROM account";
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
  
    $id =$_GET['id'];
    $sql = "UPDATE account SET account_STATUS = 'ban' WHERE id = '$id' LIMIT 1";
  
    if (mysqli_query($conn, $sql)) {
      $response= json_encode(array('message' => 'user deleted'));
    } else {
      $response=json_encode(array('message' => 'Error deleting user'));
    }
    header('Content-Type: application/json');
  echo json_encode($response);
  }
  ?>