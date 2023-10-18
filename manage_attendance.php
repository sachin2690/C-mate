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
	$work = $_GET['work'];
	$at_course = $_GET['course'];
	$at_university = $_GET['university'];
	$at_session = $_GET['session'];
	
	starter($id,$name,$role,$pic,$last_login,$total_members,$core_members,$total_sessions,$completed_sessions);

	if($role != 'Admin' && $role != 'Teacher')
	{
		echo '<div class="text-center alert bg-warning col-md-offset-4 col-md-4"><p><b>Access Forbidden</b></p></div>';
		echo '<script>setTimeout(function () { window.location.href = "home.php";}, 1000);</script>';
		exit();
	}
?>
			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="home.php"><i class="fa fa-home" aria-hidden="true"></i></a></li>
				<li><a href="attendance.php">Attendance</a></li>
				<li class="active">Manage Attendance</li>
			</ol>
		</div><!--/.row-->

		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Fill Attendance for Session</h1>
			</div>
		</div><!--/.row-->

		<div class="row">
			<div class="error">
				<?php do_attendance($key,$at_course,$at_university,$at_session); ?>
			</div>
			<div class="col-lg-offset-2 col-lg-6">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<?php echo "Mark All Present Members of $at_course $at_university $at_session";?>
					</div>
					<div class="panel-body">
						<form class="form-signin" method="post" action="">
							<?php
								global $con;
								$key = $key;
								$at_role="Student";
								$query = "SELECT * FROM userinfo where  role='$at_role' AND university='$at_university' AND course='$at_course' AND session='$at_session'";
								$result = mysqli_query($con,$query);
								$rows = mysqli_affected_rows($con);
								if($rows>0)
								{
									echo '<table><tr><th></th><th>ID</th><th>Name</th><th>Course</th></tr>';
									while ($row = mysqli_fetch_assoc($result))
									{
										echo '<div class="checkbox">
										<tr><td><input type="checkbox" name="checkbx[]" value="'.$row['id'].'">&emsp;</td>
										<td>'.$row['id'].'&emsp;</td>
										<td>'.$row['name'].'&emsp;</td>
										<td>'.$row['course'].'&emsp;</td>
										</div>';
									}
								}
								else
								{
									echo '<div class="text-center alert bg-danger col-md-offset-4 col-md-4" role="alert"><span>No such data found.</span></div>';
									echo '<script>setTimeout(function () { window.location.href = "role_attendance.php?key='.$key.'&work='.$work.'";}, 1500);</script>';
								}
								
							?>
						</div>
						<div class="panel-footer">
							<button class="btn btn-primary pull-left" name="submit_attendance" type="submit" id="login">Save Attendance</button>&nbsp;&nbsp;
							<a href="attendance.php" class="btn btn-default" id="login">Cancel</a>
						</div>
						</div>
						</form>
					</div>
				</div>
			</div>
		</div><!--/.row-->
<?php
	at_bottom();