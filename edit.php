 <?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!--BOOTSTRAP CSS-->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" media="screen" href="index.css" />     
    
    <title>Edit Event</title>
    
    <!--JQuery-->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>    
    <!--Calendar JS-->
    <script type="text/javascript" src="http://classes.engineering.wustl.edu/cse330/content/calendar.min.js"></script>
    <script type="text/javascript" src="calendar.js"></script>
</head>

<body>
    <!--is someone logged in-->
        <?php
            //default= no files, login, sign up, home, sign in, no sign-out, no upload
            $login = "display:run-in;";
            $signup = "display:run-in;";
            $signout = "display:none;";
            $create_event = "display:none;";
            if(isset($_SESSION["username"])){
                //signed in= files, no login, no sign-up, home, no sign-in, sign-out, upload
                $login = "display:none;";
                $signup = "display:none;";
                $signout = "display:run-in;";
                $create_event = "display:run-in;";
            }
        ?>
        <!--NAVIGATION BAR -->
        <header>
            <nav class="navbar navbar-light bg-light navbar-expand-md">
                <!-- Brand and toggle get grouped for better mobile display -->
                <!-- Button that toggles the navbar on and off on small screens -->
                <button type="button" class="navbar-toggler collapsed" data-toggle="collapse"
                data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <!-- Hides information from screen readers --> <span class="sr-only"></span>
                    <!-- Draws 3 bars in navbar button when in small mode -->&#x2630;</button>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li class="active nav-item">
                            <a href="index.php" class="nav-link">Home <span class="sr-only">(current)</span></a></li>
                        <li class="nav-item">
                            <a style="<?php echo $login ?>" href="login.php" class="nav-link" id="login">
                                Login
                            </a>
                        </li>
                        <li class="nav-item">
                            <a style="<?php echo $create_event; ?>"href="create_event.php" class="nav-link" id="create">
                                Create Event
                            </a>
                        </li>
                        <li class="nav-item">
                            <a style="<?php echo $signout; ?>" href="signout.php" class="nav-link" id="out">
                                Sign Out
                            </a>
                        </li>
                        <li class="nav-item">
                            <a style="<?php echo $signup; ?>" href="signup.php" class="nav-link">
                                Sign Up
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
    <?php
        require 'connect.php';
		date_default_timezone_set('America/Chicago');
		$event_id = (int) $_GET['Event'];
		
        $url="http://ec2-34-219-74-52.us-west-2.compute.amazonaws.com/~kaitlinaclark/calendar/php-calendar/delete.php?Event=".$event_id;
        $delete_button=sprintf("
            <a href='%s' class='btn btn-primary'>Delete</a>
            ", $url);
        echo($delete_button);

		//insert story into MySQL db
		$query_edit_event = $connect->prepare("select events.title,
                                                        events.assoc_date,
                                                        events.assoc_time
														from events
														where event_id=?");
		if(!$query_edit_event){
			printf("Query Prep Failed: %s \n", $connect->error);
			exit;
		}
	
		//bind parameters to input values
		$query_edit_event->bind_param("i", $event_id);
		$query_edit_event->execute();
        $query_edit_event->bind_result($temp_title, $temp_date, $temp_time);

		while($query_edit_event->fetch()){
                   $title= $temp_title;
                   $date= $temp_date;
                   $time = $temp_time;
                }
		
		//close query
		$query_edit_event->close();   
	
    ?>
    <h1> Edit Event </h1>
	<form action="edit_operation.php" method="POST">
    <p>Event Title: <input type="text" value = "<?php echo $title;?>" name="event_title" required></p>
        Date: <input type="date" name="date" value= "<?php echo $date;?>">
        Time: <input type="time" name="time" value= "<?php echo $time;?>">
        <input type="hidden" name="event_id" value="<?php echo $event_id; ?>">
	<input type="submit" value="Submit">
	</form>
    </body>
    </html>
