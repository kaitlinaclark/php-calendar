<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!--BOOTSTRAP CSS-->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" media="screen" href="index.css" />     
    
    <title>Calendar</title>
    
    <!--JQuery-->
    <!--Calendar JS-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
    <!--template for calendar: https://codepen.io/chrisdpratt/pen/OOybam/-->
        <div class="container-fluid">
            <header>
                <nav class="navbar navbar-light bg-light navbar-expand-md">
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <li class="active nav-item">
                                <a href="index.php" class="nav-link">Home <span class="sr-only">(current)</span></a></li>
                            <li style="<?php echo $login; ?>" class="nav-item">
                                <a href="login.php" class="nav-link" id="login">
                                        Login
                                </a>
                            </li>
                            <li style="<?php echo $create_event; ?>" class="nav-item">
                                <a href="create_event.php" class="nav-link" id="create">
                                        Create Event
                                </a>
                            </li>
                            <li style="<?php echo $signout; ?>" class="nav-item">
                                <a href="signout.php" class="nav-link" id="out">
                                        Sign Out
                                </a>
                            </li>
                            <li style="<?php echo $signup; ?>" class="nav-item">
                                <a href="signup.php" class="nav-link">
                                        Sign Up
                                </a>
                            </li>                      
                        </ul>
                    </div>
                </nav>
                <!-- Display Month and Year-->
                <button type="button" class="btn btn-default" id="prev">&lt;</button>

                <h4 class="display-4 mb-4 text-center" id="month_year"></h4>

                <button type="button" class="btn btn-default" id="next">&gt;</button>

                <div class="row d-none d-sm-flex p-1 bg-dark text-white">
                    <!-- Display Days of the Week-->
                    <h5 class="col-sm p-1 text-center">Sunday</h5>
                    <h5 class="col-sm p-1 text-center">Monday</h5>
                    <h5 class="col-sm p-1 text-center">Tuesday</h5>
                    <h5 class="col-sm p-1 text-center">Wednesday</h5>
                    <h5 class="col-sm p-1 text-center">Thursday</h5>
                    <h5 class="col-sm p-1 text-center">Friday</h5>
                    <h5 class="col-sm p-1 text-center">Saturday</h5>
                </div>
            </header>
                <div class="row border border-right-0 border-bottom-0">
                <!--Display 42 default boxes-->
                <!--box1-->
                    <!--Shaded gary bc not in month-->
                <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate d-none d-sm-inline-block bg-light text-muted" id="box1">
                    
                </div>
                <!--Box2-->
                <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate d-none d-sm-inline-block bg-light text-muted" id="box2">
                    
                </div>
                <!--Box3-->
                <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate" id="box3">
                    
                </div>
                <!--Box4-->
                <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate " id="box4">
                    
                </div> 
                <!--Box5-->
                <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate " id="box5">
                    
                </div> 
                <!--Box6-->
                <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate " id="box6">
                    
                </div>                 
                <!--Box7-->
                <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate " id="box7">
                    
                </div>  
                <div class="w-100"></div>               
                <!--Box8-->
                <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate " id="box8">
                    
                </div>                 
                <!--Box9-->
                <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate " id="box9">
                    
                </div>                 
                <!--Box10-->
                <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate " id="box10">
                    
                </div>                 
                <!--Box11-->
                <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate " id="box11">
                    
                </div>                 
                <!--Box12-->
                <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate " id="box12">
                   
                </div>                 
                <!--Box13-->
                <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate " id="box13">
                    
                </div>                 
                <!--Box14-->
                <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate " id="box14">
                    
                </div>  
                <div class="w-100"></div>               
                <!--Box15-->
                <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate " id="box15">
                   
                </div>                 
                <!--Box16-->
                <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate " id="box16">
                    
                </div>                 
                <!--Box17-->
                <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate " id="box17">
                    
                </div>                 
                <!--Box18-->
                <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate " id="box18">
                    
                </div>                 
                <!--Box19-->
                <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate " id="box19">
                    
                </div>                 
                <!--Box20-->
                <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate " id="box20">
                    
                </div>                 
                <!--Box21-->
                <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate " id="box21">
                    
                </div>     
                <div class="w-100"></div>            
                <!--Box22-->
                <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate " id="box22">
                    
                </div>                 
                <!--Box23-->
                <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate " id="box23">
                    
                </div>                 
                <!--Box24-->
                <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate " id="box24">
                   
                </div>                 
                <!--Box25-->
                <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate " id="box25">
                    
                </div>                 
                <!--Box26-->
                <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate " id="box26">
                    
                </div>                 
                <!--Box27-->
                <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate " id="box27">
                    
                </div>                 
                <!--Box28-->
                <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate " id="box28">
                    
                </div>     
                <div class="w-100"></div>            
                <!--Box29-->
                <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate " id="box29">
                    
                </div>                 
                <!--Box30-->
                <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate " id="box30">
                    
                </div>                 
                <!--Box31-->
                <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate " id="box31">
                    
                </div>                 
                <!--Box32-->
                <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate " id="box32">
                    
                </div>                 
                <!--Box33-->
                <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate " id="box33">
                    
                </div>                 
                <!--Box34-->
                <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate " id="box34">
                    
                </div>                 
                <!--Box35-->
                <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate " id="box35">
                   
                </div>  
                <div class="w-100"></div>      
                <!--Box36-->
                <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate " id="box36">
                    
                </div> 
                <!--Box37-->
                <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate " id="box37">
                   
                </div>   
                <!--Box38-->
                <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate " id="box38">
                    
                </div>        
                <!--Box39-->
                <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate " id="box39">
                    
                </div>
                <!--Box40-->
                <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate " id="box40">
                    
                </div>
                <!--Box41-->
                <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate " id="box41">
                    
                </div>
                <!--Box42-->
                <div class="day col-sm p-2 border border-left-0 border-top-0 text-truncate " id="box42">
                   
                </div>
        </div>
</body>
</html>
