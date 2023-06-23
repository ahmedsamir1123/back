<?php
include "connection.php";

$data = json_decode(file_get_contents("php://input"));

// Define the API endpoint
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  $id = mysqli_real_escape_string($conn, $_GET['id']);

  $select = "SELECT * FROM template WHERE id = '$id'";
  $result = mysqli_query($conn, $select);
  $rows = array();
  while($r = mysqli_fetch_assoc($result)) {
      $rows[] = $r;
  }

  header('Content-Type: application/json');
  echo json_encode($rows);
}


