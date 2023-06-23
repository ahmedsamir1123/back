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






// Get the data from Angular

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    $data = json_decode(file_get_contents("php://input"));

// Insert the data into the users table
$name = mysqli_real_escape_string($conn, $data->name);
$email = mysqli_real_escape_string($conn, $data->email);
$password=  mysqli_real_escape_string($conn, $data->password);

$sql = "INSERT INTO account (name, email,password,role) VALUES ('$name', '$email','$password','user')";

header('Content-Type: application/json');
$result = mysqli_query($conn, $sql);

if ($result) {

  $id = mysqli_insert_id($conn); // Get the auto-generated account ID

  $sql = "INSERT INTO users (id,name, email,password) VALUES ('$id','$name', '$email','$password')";
  $result = mysqli_query($conn, $sql);
  if ($result) {
    $response = array('status' => 'success', 'message' => 'Data inserted successfully.');
} else {
    $response = array('status' => 'error', 'message' => 'Data insertion failed for the users table: ' . mysqli_error($conn));
}
} else {
$response = array('status' => 'error', 'message' => 'Data insertion failed for the account table: ' . mysqli_error($conn));
}echo json_encode($response);
}

// Send the response back to Angular

if($_SERVER['REQUEST_METHOD'] == 'DELETE'){
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  $data = json_decode(file_get_contents('php://input'), true);

  $id =$_GET['id'];
  $sql = "UPDATE account SET password = NULL, name = NULL  WHERE id = '$id' LIMIT 1";

  if (mysqli_query($conn, $sql)) {
    $response= json_encode(array('message' => 'user deleted'));
  } else {
    $response=json_encode(array('message' => 'Error deleting user'));
  }
  header('Content-Type: application/json');
echo json_encode($response);
}
?>
