<?php
session_start();
		//allows connection to database
require 'connect.php';
	$delete= $connect->prepare("delete from events
								where event_id=?");
	if(!$delete){
		echo json_encode(array("success" => false, "message" => "Query Prep Failed"));
		exit;
	}
	//bind parameters
	$delete->bind_param('i', $event_id);
		$event_id = (int) $_GET['Event'];
    	//execute query
		$delete->execute();
			
		//close query
		$delete->close();  
		echo json_encode(array("success" => true, "message" => "Event Deleted"));
			

		 header("Location: http://ec2-18-191-196-37.us-east-2.compute.amazonaws.com/~kaitlinaclark/calendar/index.php")
		?>