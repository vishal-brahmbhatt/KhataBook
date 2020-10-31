<?php

//This is end-point of our UserMaster Insert API this API can be use for registration

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/dbclass.php'; // adding our db file

include_once '../entities/usermaster.php'; // class file

$dbclass = new DBClass();
$connection = $dbclass->getConnection();

$user = new UserMaster($connection);

$data = json_decode(file_get_contents("php://input")); // request data stored in $data

$user->emailid = $data->emailid;
$user->password = $data->password;


$Response = $user->login();


echo json_encode($Response);

?>
