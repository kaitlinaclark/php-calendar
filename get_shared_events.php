<?php
session_start();
require 'connect.php';
//prepare query for events shared with current user
$query_shared_events = $connect->prepare("select assoc_date, 
                            				        title, 
                                                    events.event_id from events 
                                                        join shared_events on (events.user_id = shared_events.user)
                                                        where shareUsername=?");
//declare array for JSON output
$info = [];
//check query prep and return error
if(!$query_shared_events){
	echo json_encode(array("success" => false, "message" => "Query Prep Failed"));
}
else{
	//identify success
	$info[] = array('success' => true);
	//bind parameters
	$query_shared_events->bind_param('s', $username);
		$username = $_SESSION['username'];

	//execute query and bind results
	$query_shared_events->execute();
	$query_shared_events->bind_result($date, $title, $event_id);
	//extract values from result
	while($query_shared_events->fetch()){
		$date = split("-", $date, 3);
		//get day and month
		$day = (int) $date[2];
		$month = (int) $date[1];

		array_push($info, array("day" => $day, "month" => $month, "title" => $title, "event_id" => $event_id));
	}
	echo json_encode($info);
}
?>