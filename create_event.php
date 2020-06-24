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
    
    <title>Create Event</title>
    
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
        <header class="row">
            <nav class="navbar navbar-light bg-light navbar-expand col-12">
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse justify-content-center" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li class="active nav-item">
                            <a href="index.php" class="nav-link">Home <span class="sr-only">(current)</span></a></li>
                        <li class="nav-item">
                            <a style="<?php echo $login ?>" href="login.php" class="nav-link" id="login">
                                Login
                            </a>
                        </li>
                        <li class="nav-item">
                            <a style="<?php echo $create; ?>"href="create_event.php" class="nav-link" id="create">
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
	<div class="row justify-content-center align-items-center">
		<form action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="POST">
    		<h4 class="card-title text-center mb-4 mt-1">Create New Event</h4>
		<div class="form-group">
			<label for="event_title" class="text-info">Event Title:</label>
			 <input class="form-control" type="text" name="event_title" required>
		</div>
		<div class="form-group">
			<label for="date" class="text-info">Date:</label>
        		<input class="form-control" type="date" name="date" >
			
			<label for="time" class="text-info">Time</label>
			<input class="form-control" type="time" name="time">
		</div>
		<input class="btn btn-primary btn-block" type="submit" value="Submit">
		</form>
	</div>
    <?php
        require 'connect.php';
        
        if(isset($_POST["event_title"]) && isset($_POST["date"])){
                //insert story into MySQL db
                $query_new_story = $connect->prepare("insert into events set
                                                                    user_id=?,
                                                                    title=?,
                                                                    assoc_date=?,
                                                                    assoc_time=?");
                if(!$query_new_story){
                    printf("Query Prep Failed: %s \n", $connect->error);
                    exit;
                }
            
                //bind parameters to input values
                $query_new_story->bind_param('isss', $user_id, $title, $date, $time);
                    $user_id = $_SESSION["user_id"];
                    $title = $_POST["event_title"];
                    $date = $_POST["date"];
                    $time = $_POST["time"];

                //execute query
                $query_new_story->execute();

                //close query
                $query_new_story->close();

            //redirect to index page
            header("Location: http://ec2-18-220-33-4.us-east-2.compute.amazonaws.com/calendar/index.php");
        }
	
	?>
    </body>
</html>
