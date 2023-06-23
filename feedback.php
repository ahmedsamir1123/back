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

// // Close the database connection
// mysqli_close($conn);



// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//     $data = json_decode(file_get_contents('php://input'));
//     $Uname = $_POST['username'];
//     $email = $_POST['email'];
//     $pass = $_POST['password'];
//     // Insert data into the database
//     $sql = "INSERT INTO users (username, email , password ) VALUES (z, '$data->$email','$data->$password')";
//     mysqli_query($conn, $sql);

//     // Return a success message
//     $response = array('success' => true);
//     header('Content-Type: application/json');
//     echo json_encode($response);
// }

// Get the data from Angular

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    $data = json_decode(file_get_contents("php://input"));

// Insert the data into the users table
$uid = mysqli_real_escape_string($conn, $data->uid); // Assuming the UID property name is 'uid'
$name = mysqli_real_escape_string($conn, $data->name);
$email = mysqli_real_escape_string($conn, $data->email);
$content=  mysqli_real_escape_string($conn, $data->content);
$sql = "INSERT INTO feedback (uid,name,email,content) VALUES ('$uid','$name','$email','$content')";
header('Content-Type: application/json');
$result = mysqli_query($conn, $sql);
if ($result) {
  $response = array('status' => 'success', 'message' => 'Data inserted successfully.');
} else {
  $response = array('status' => 'error', 'message' => 'Data insertion failed: ' . mysqli_error($conn));
}    
echo json_encode($response);
}

// Send the response back to Angular

?>
