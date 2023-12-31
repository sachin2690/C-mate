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
	$event_id = $_GET['event_id'];
	$last_login = date('jS M Y H:i', strtotime($last_login));
	$total_members = get_all_status();
	$core_members = get_vip_status();
	$total_sessions = total_sessions();
	$completed_sessions = completed_sessions();

	starter($id,$name,$role,$pic,$last_login,$total_members,$core_members,$total_sessions,$completed_sessions);

	if($role != 'Admin' && $role != 'Technical')
	{
		echo '<div class="text-center alert bg-warning col-md-offset-4 col-md-4"><p><b>Access Forbidden</b></p></div>';
		echo '<script>setTimeout(function () { window.location.href = "home.php";}, 1000);</script>';
		exit();
	}
	?>

	<div class="row">
			<ol class="breadcrumb">
				<li><a href="home.php"><i class="fa fa-home" aria-hidden="true"></i></a></li>
				<li><a href="schedule.php">Schedule & Sessions</a></li>
				<li class="active">Delete Session</li>
			</ol>
		</div><!--/.row-->

		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Delete Session</h1>
			</div>
		</div><!--/.row-->

		<div class="row">
			<div class="error">
				<?php delete_event($event_id,$role); ?>
			</div>
			<div class="col-lg-offset-2 col-lg-6">
				<div class="panel panel-danger">
					<div class="panel-heading">
						Warning
					</div>
					<div class="panel-body">
						<form class="" method="post" action="">
							<label for="ask">Are you really want to remove this Session?</label>
							<br>
					<div class="panel-footer">
						<div class="pull-right">
							<button class="btn btn-danger" name="yes" type="submit" id="login">Yes</button>&nbsp;&nbsp;
							<a href="schedule.php" class="btn btn-default" id="login">No, go back!</a>
						</div>
					</div>
						</form>
					</div>
				</div>
			</div>
		</div><!--/.row-->
<?php
	at_bottom();