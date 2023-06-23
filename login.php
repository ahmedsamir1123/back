<?php
include "connection.php";


// session_start();

// Check if user is authenticated
// if (!isset($_SESSION['admin'])) {
//     http_response_code(401); // Unauthorized
//     die();
// }

// session_start();

// if (!isset($_SESSION['admin'])) {
//     $response = array('status' => 'error', 'message' => 'You must be logged in to access this page');
//     echo json_encode($response);
//     exit;
//   }
if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    $postdata = json_decode(file_get_contents("php://input"));

    $email =    mysqli_real_escape_string($conn,  $postdata->email);
    $password=  mysqli_real_escape_string($conn,  $postdata->password);
    $sql= "SELECT * FROM account WHERE email='$email' and password='$password'";

header('Content-Type: application/json');

$result = mysqli_query($conn, $sql);
$numRow=mysqli_num_rows($result);

if ($numRow>0) {
  $row = mysqli_fetch_assoc($result);
  $id = $row['id'];


$statue=$row['account_STATUS'];
if ($statue == 'Active') {
  $response['account_STATUS'] = 'Active';

  $userQuery = "SELECT * FROM users WHERE id = $id";
  $userResult = mysqli_query($conn, $userQuery);
  $userRows = mysqli_num_rows($userResult);

  $adminQuery = "SELECT * FROM admin WHERE id = $id";
  $adminResult = mysqli_query($conn, $adminQuery);
  $adminRows = mysqli_num_rows($adminResult);
  $clerkQuery = "SELECT * FROM clerk WHERE id = $id";
  $clerkResult = mysqli_query($conn, $clerkQuery);
  $clerkRows = mysqli_num_rows($clerkResult);
  if ($userRows > 0) {
    // User is logged in
    $response = array('status' => 'success', 'message' => 'You are logged in as a user.');
    $response['role'] = 'user';
    $response['row'] = $row;
$response['account_STATUS'] = 'Active';

} elseif ($adminRows > 0) {
    // Admin is logged in
    $response = array('status' => 'success', 'message' => 'You are logged in as an admin.');
    $response['role'] = 'admin';
    $response['row'] = $row;
$response['account_STATUS'] = 'Active';

}
elseif ($clerkRows > 0) {
  // Admin is logged in
  $response = array('status' => 'success', 'message' => 'You are logged in as an clerk.');
  $response['role'] = 'clerk';
  $response['row'] = $row;
$response['account_STATUS'] = 'Active';

}
// $response['account_STATUS'] = 'Active';

else {
  $response['role'] = 'unknown';

}
} 
elseif ($statue == 'ban') {
  // Account is banned
  $response = array('status' => 'error', 'message' => 'Your account has been banned.');
  $response['account_STATUS'] = 'ban';

}



} 
else {
        $response = array('status' => 'error', 'message' => 'Invalid email or password');
    }

// Send the response back to Angular
echo json_encode($response);
}





?>