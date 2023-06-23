<?php
include "connection.php";

$data = json_decode(file_get_contents("php://input"));

// Define the API endpoint
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  $rid = mysqli_real_escape_string($conn, $_GET['rid']);

  $select = "SELECT * FROM report WHERE rid = '$rid'";
  $result = mysqli_query($conn, $select);
  $rows = array();
  while($r = mysqli_fetch_assoc($result)) {
      $rows[] = $r;
  }

  header('Content-Type: application/json');
  echo json_encode($rows);
}



if ($_SERVER['REQUEST_METHOD'] == 'PUT'){


  // Insert the data into the users table
  $rid = mysqli_real_escape_string($conn, $data->rid);
  $description = mysqli_real_escape_string($conn, $data->description);
  $title = mysqli_real_escape_string($conn, $data->title);
  $sql = "UPDATE  report SET description='$description' , title='$title' where rid='$rid' ";
  header('Content-Type: application/json');
  $result = mysqli_query($conn, $sql);
  if ($result) {
    $response = array('status' => 'success', 'message' => 'Data inserted successfully.');
  } else {
    $response = array('status' => 'error', 'message' => 'Data insertion failed: ' . mysqli_error($conn));
  }
  // Send the response back to Angular
  echo json_encode($response);
  }
?>