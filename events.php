<?php
session_start();
require 'connect.php';
//prepare query for events shared with current user
$query_events = $connect->prepare("select assoc_date, title, event_id from events where user_id=?");

//declare array for JSON output
$info = [];
$id = $_SESSION['user_id'];
//check query prep and return error
if(!$query_events){
	echo json_encode(array("success" => false, "message" => "Query Prep Failed"));
}
else{
	//identify success
	$info[] = array('success' => true);
	//bind parameters
	$query_events->bind_param('i', $id);

	//execute query and bind results
	$query_events->execute();
	
	$result = $query_events->get_result();
	//extract values from result
	while($row = $result->fetch_assoc()){
		$date = $row['assoc_date'];
		$date_format = split("-", $date, 3);
		//get day and month
		$day = (int) $date_format[2];
		$month = (int) $date_format[1];

		$title = $row['title'];
		$event_id = $row['event_id'];

		array_push($info, array("day" => $day, "month" => $month, "title" => $title, "event_id" => $event_id));

	}
	$query_events->close();
	echo json_encode($info);
}
?>
