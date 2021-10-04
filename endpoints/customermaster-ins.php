<?php
error_reporting(E_ALL & ~E_WARNING );
//This is end-point of our UserMaster Insert API this API can be use for registration

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/dbclass.php'; // adding our db file

include_once '../entities/customermaster.php'; // class file

// to get connection from database
$dbclass = new DBClass();
$connection = $dbclass->getConnection();


// new object of entity class
$user = new CustomerMaster($connection);

$data = json_decode(file_get_contents("php://input")); // request data stored in $data

$user->custname = $data->custname;
$user->mobile = $data->mobile;
$user->email = $data->email;
$user->userid = $data->userid;




if($user->ins_customermaster())
{
	$Response->status="Success";
	$Response->msg="Added done";
}
else
{
    $Response->status="Fail";
		$Response->msg="Try after sometime";
}

echo json_encode($Response);

?>
