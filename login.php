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
    
    <title>Login Page</title>
    
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
		<!-- Collect the nav links, forms, and other content for toggling -->                                                                                  <div class="collapse navbar-collapse justify-content-center" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
                        <li class="active nav-item">
                            <a href="index.php" class="nav-link">Home <span class="sr-only">(current)</span></a></li>
                        <li class="nav-item">
                            <a style="<?php echo $login ?>" href="login.php" class="nav-link" id="login">
                                Login
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



	<div class="card">
		<article class="card-body">
			<h4 class="card-title text-center mb-4 mt-1">Login</h4>
			<hr>
			<!--<p class="text-success text-center">Some message goes here</p>-->
			<form action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="POST">
				<div class="form-group">
					<div class="input-group">
						<div class="input-group-prepend">
		    					<span class="input-group-text"> <i class="fa fa-user"></i> </span>
		 				</div>
						<input name="username" class="form-control" placeholder="Username" type="text">
					</div> 
				</div>
				<div class="form-group">
					<div class="input-group">
						<div class="input-group-prepend">
		    					<span class="input-group-text"> <i class="fa fa-lock"></i> </span>
		 				</div>
	    					<input class="form-control" placeholder="******" type="password" name="psw" required>
					</div> 
				</div>
				<div class="form-group">
					<input type="submit" value="Submit" class="btn btn-primary btn-block">
				</div>
			</form>
		</article>
	</div>




	<?php
        require 'connect.php';//connect to MySQL db for calendar articles
       
        //check for username input
        if(isset($_POST['username'])){
            //check for password input
            if(isset($_POST['psw'])){
                //set username and password for login attempt
                $current_user= $_POST['username'];
                $psw = $_POST['psw'];

                //access user that is trying to login
                $query_user = $connect->prepare("select 
                                                user_id,
                                                pwd
                                                from users
                                                    where username=?");
                if(!$query_user){
                    printf("Query Prep Failed: %s \n", $connect->error);
                    exit;
                }
                $query_user->bind_param('s', $current_user);
            
                $query_user->execute();
                $query_user->bind_result($id, $psw_hash);
                $query_user->fetch();
                
                //verify that correct password is used
                if(password_verify($psw, $psw_hash)){
                    echo "LOGIN CONFIRMED!!";
                    //save variables for this users session
                    $_SESSION["username"] = $current_user;
                    $_SESSION["user_id"] = (int)$id;
                    $_SESSION["token"] = bin2hex(openssl_random_pseudo_bytes(32));
                    
                    //redirect to main page with user privileges
                    header("Location: http://ec2-34-219-74-52.us-west-2.compute.amazonaws.com/~kaitlinaclark/calendar/php-calendar/index.php");

                }
                else{
                    echo "ERROR: USER NOT FOUND";
                }
            }
        }
		
	?>
</body>

</html>
