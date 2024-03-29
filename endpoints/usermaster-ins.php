<?php
error_reporting(E_ALL & ~E_WARNING );
//This is end-point of our UserMaster Insert API this API can be use for registration

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/dbclass.php'; // adding our db file

include_once '../entities/usermaster.php'; // class file

$dbclass = new DBClass();
try {
	$connection = $dbclass->getConnection();


	$user = new UserMaster($connection);

	$data = json_decode(file_get_contents("php://input")); // request data stored in $data

	$user->name = $data->name;
	$user->shopname = $data->shopname;
	$user->emailid = $data->emailid;
	$user->address = $data->address;
	$user->gstno = $data->gstno;
	$user->password = $data->password;



	if($user->ins_usermaster())
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


} catch (Exception $e) {
	$Response->status="Fail";
	$Response->msg="Try after sometime";
	$Response->err=$e;
	echo json_encode($Response);
}

?>
