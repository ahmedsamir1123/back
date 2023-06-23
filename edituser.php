<?php
include "connection.php";
$data = json_decode(file_get_contents("php://input"));
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
  
    $select = "SELECT * FROM account WHERE id = '$id'";
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
    $id = mysqli_real_escape_string($conn, $data->id);
    $name = mysqli_real_escape_string($conn, $data->name);
    $email = mysqli_real_escape_string($conn, $data->email);
    $password = mysqli_real_escape_string($conn, $data->password);

    $sql = "UPDATE  account SET name='$name' , email='$email',password='$password' where id='$id' ";
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