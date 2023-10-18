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
	$key = $_GET['key'];
	$at_course = $_GET['course'];
	$at_university = $_GET['university'];
	$at_session = $_GET['session'];
	
	starter($id,$name,$role,$pic,$last_login,$total_members,$core_members,$total_sessions,$completed_sessions);
?>
	<div class="row">
			<ol class="breadcrumb">
				<li><a href="home.php"><i class="fa fa-home" aria-hidden="true"></i></a></li>
				<li><a href="attendance.php">Attendance</a></li>
				<li class="active">View Attendance</li>
			</ol>
		</div><!--/.row-->

	<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">
				<?php echo "Attendance for $at_course $at_university $at_session";?></h1>
			</div>
	</div><!--/.row-->

<?php
view_attendance($key,$at_course,$at_university,$at_session);
?>

<?php
	at_bottom();