<?php
	class BillMaster
	{
		private $connection;

		public $userid;
		public $customerid;
		public $billcode;
		public $totalamt;
		public $toatlpaidamt;
		public $dateofbill;
		public $dtldata;


		// This is constructor we have to pass connection of the database

		public function __construct($connection)
		{
        	$this->connection = $connection;
    	}


		//This function will perform insert operation for UserMaster table

		public function ins_billmaster()
		{

			$code_sql = "SELECT LPAD(count(*) + 1, 5, '0') as zipcode FROM billmaster";
			$result_code = mysqli_query($this->connection,$code_sql);
			$row_code = mysqli_fetch_array($result_code);
			$vb =  $row_code['zipcode'];

			$sql = "INSERT Into `billmaster` (`BillCode`,`TotalAmt`,`TotalPaidAmt`,`DateOfBill`,`CustomerID`,`UserID`) values('$vb','$this->totalamt','$this->totalpaidamt','$this->dateofbill','$this->customerid','$this->userid')";
			
			// echo $this->dtldata;
			// foreach ($this->dtldata as $item) {
			// 	# code...				
			// 	$inner_sql = "INSERT INTO `billdtl`(`BillID`, `ProdID`, `Qty`, `Rate`, `Isactive`) VALUES ('1','$item->prodid','$item->qty','$item->rate','true')";
			// 	echo $inner_sql;}

				if ($this->connection->query($sql) === TRUE)
				{
					 $last_id = mysqli_insert_id($this->connection);					 
					 foreach ($this->dtldata as $item) {
				# code...				
							$inner_sql = "INSERT INTO `billdtl`(`BillID`, `ProdID`, `Qty`, `Rate`, `Isactive`) VALUES ('$last_id','$item->prodid','$item->qty','$item->rate','true')";
							if($this->connection->query($inner_sql) === TRUE)
							{
								
							}
							else
							{
								echo "Error: " . $inner_sql . "<br>" . $this->connection->error;
							}
							
				}

				  	 return true;
				}
				else
				{
				   echo "Error: " . $sql . "<br>" . $this->connection->error; // uncomment this if you are getting errors
				  return false;
				}

			// return true;

		}

		public function billmaster_view()
		{

			    $sql = "SELECT BillId,concat(BillCode , ' - ',cm.CustName, ' - ',bm.TotalAmt ) as BillCode,TotalAmt FROM billmaster bm
						INNER join customermaster cm on cm.CustID = bm.CustomerID WHERE bm.UserID = '$this->userid'";			    
		      $result = mysqli_query($this->connection,$sql);



          $data = array();
		      if($result->num_rows > 0)
		      {
             // echo "in if";
              while($row1 = $result->fetch_assoc())
              {
                // echo "string";
								$datadict->billid=$row1["BillId"];
                $datadict->billcode=$row1["BillCode"];
  		      		$datadict->totalamt = $row1["TotalAmt"];

                array_push($data,$datadict);
								$datadict="";
              }
		      }
		      else
		      {
		         	$datadict->status="Fail";
		      		$datadict->userid = 0;
		      		$datadict->username = "NA";
              array_push($data,$datadict);
		      }

		      return $data;
		}

		public function billmaster_byid()
		{

			    $sql = "SELECT BillID,BillCode,ToatlAmt,ToatlPaidAmt,DateOfBill FROM billmaster WHERE BillID = '$this->billid'";
		      $result = mysqli_query($this->connection,$sql);



		      // If result matched email and password, table row must be 1 row

          $data = array();
		      if($result->num_rows > 0)
		      {
             // echo "in if";
              while($row1 = $result->fetch_assoc())
              {
                // echo "string";
								$datadict->billid=$row1["BillId"];
                $datadict->billcode=$row1["BillCode"];
  		      		$datadict->totalamt = $row1["ToatalAmt"];
								$datadict->totalpaidamt = $row1["ToatlPaidAmt"];
								$datadict->dateofbill = $row1["DateOfBill"];
                array_push($data,$datadict);
								$datadict="";
              }
							$status="Success";
							array_push($data);
		      }
		      else
		      {
		         	$datadict->status="Fail";
		      		$datadict->userid = 0;
		      		$datadict->username = "NA";
              array_push($data,$datadict);
							$status="Success";
		      }

		      return array($data,$status);
		}
		

		public function get_dashboard_data()
		{

			    $sql = "SELECT IFNULL(sum(TotalAmt),0) as totamt, IFNULL(sum(TotalPaidAmt),0) as totpamt from billmaster WHERE USerID = '$this->userid'";
		      $result = mysqli_query($this->connection,$sql);



		      // If result matched email and password, table row must be 1 row

          $data = array();
		      if($result->num_rows > 0)
		      {
             // echo "in if";
              while($row1 = $result->fetch_assoc())
              {
                // echo "string";
				$datadict->totamt=$row1["totamt"];
                $datadict->totpamt=$row1["totpamt"];
  		      		
                array_push($data,$datadict);
				$datadict="";
              }
							 $status="Success";
							array_push($data);
		      }
		      else
		      {
		         	$datadict->status="Fail";
		      		$datadict->userid = 0;
		      		$datadict->username = "NA";
              array_push($data,$datadict);
							$status="Success";
		      }

		      return array($data,$status);
		}
	}
?>
