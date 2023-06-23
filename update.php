<?php
include "connection.php";

// Define the API endpoint
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $sql = "SELECT * FROM report";
    $result = mysqli_query($conn, $sql);

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
  $description = mysqli_real_escape_string($conn, $data->message);
  $title = mysqli_real_escape_string($conn, $data->name);

  $sql = "UPDATE  report SET description='$description' , title='$title' where rid='$rid' ";
  header('Content-Type: application/json');
  $result = mysqli_query($conn, $sql);
  if ($result) {
    $response = array('status' => 'success', 'message' => 'Data inserted successfully.');
  } else {
    $response = array('status' => 'error', 'message' => 'Data insertion failed: ' . mysqli_error($conn));
  }    
  echo json_encode($response);
  }
  
