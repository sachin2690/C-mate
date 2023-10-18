<?php
	require_once('funs.php');
	session_start();
	check_session();
	$email = $_SESSION['email'];
	$row = array();
	$row = get_member_data($email);
	$id = $row['id'];
	$name = $row['name'];
	$role = $row['role'];
	$pic = $row['pic'];
	$last_login = $row['last_login'];
	$last_login = date('jS M Y H:i', strtotime($last_login));
	$total_members = get_all_status();
	$core_members = get_vip_status();
	$total_sessions = total_sessions();
	$completed_sessions = completed_sessions();
	
	starter($id,$name,$role,$pic,$last_login,$total_members,$core_members,$total_sessions,$completed_sessions);

?>
	  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Style sheet -->
    <link rel="stylesheet" href="team_details.css">

    <!-- Google Fonts -->
    
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

    <!-- FOnt Awesome -->
    
	<script src="https://use.fontawesome.com/c250a4b18e.js"></script>

    <title>Our Team page</title>

</head>
<body>
    <div class="container">
        <div class="section-title">
            <h1>Meet The Team</h1>
        </div>

        


			 <div class="column">
                <div class="team">
                    <div class="team-img">
                        <img src="img/sachin.jpg" alt="Team Image">
                    </div>
                    <div class="team-content">
                        <h2>Sachin Raj</h2>
                        <h3>INVENTER</h3>
                        <p>Id - 8747
</p>
                        <h4>sachinraja2690@gmail.com</h4>
                    </div>
                    <div class="team-social">
                        <a href="#" class="social-tw"> <i class="fa fa-twitter"></i></a>
                        <a href="#" class="social-fb"> <i class="fa fa-facebook-f"></i></a>
                        <a href="#" class="social-li"> <i class="fa fa-linkedin"></i></a>
                        <a href="#" class="social-in"> <i class="fa fa-instagram"></i></a>
                        <a href="#" class="social-yt"> <i class="fa fa-youtube"></i></a>
                    </div>
                </div>
            </div>

        </div>

    </div>

    
</body>
</html>
<?php
	at_bottom();