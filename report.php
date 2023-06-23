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



// Get the data from Angular

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    $data = json_decode(file_get_contents("php://input"));

// Insert the data into the users table
$uid = mysqli_real_escape_string($conn, $data->uid); // Assuming the UID property name is 'uid'
$title = mysqli_real_escape_string($conn, $data->title);
$description=  mysqli_real_escape_string($conn, $data->description);
$sql = "INSERT INTO report (uid,title,description) VALUES ( '$uid','$title','$description')";
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
