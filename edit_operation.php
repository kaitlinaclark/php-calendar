 <?php
session_start();
		require 'connect.php';
		$event_id = $_POST["event_id"];
		if(isset($_POST["event_title"]) && isset($_POST["date"]) && isset($_POST["time"])){
                //insert story into MySQL db
                $query_edited_story = $connect->prepare("update events 
														set events.title=?,
                                                        events.assoc_date=?,
                                                        events.assoc_time=?
														where event_id=?");
                if(!$query_edited_story){
                    echo json_encode(array("success" => false, "message" => "Query Prep Failed"));
                    exit;
                }
            
                //bind parameters to input values
                $query_edited_story->bind_param("sssi", $title, $date, $time, $event_id);
					$title = $_POST["event_title"];
                    $date = $_POST["date"];
                    $time = $_POST["time"];
                //execute query
                $query_edited_story->execute();

                //close query
                $query_edited_story->close();
                echo json_encode(array("success" => true, "message" => "Event Edited"));

            //redirect to index page
            header("Location: http://ec2-18-191-196-37.us-east-2.compute.amazonaws.com/~kaitlinaclark/calendar/index.php");
        }		
?>