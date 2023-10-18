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
	
	starter($id,$name,$role,$pic,$last_login,$total_members,$core_members,$total_sessions,$completed_sessions);

	
?>
			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="home.php"><i class="fa fa-home" aria-hidden="true"></i></a></li>
				<li><a href="attendance.php">Attendance</a></li>
				<li class="active">Role Attendance</li>
			</ol>
		</div><!--/.row-->

		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Choose details for Attendance</h1>
			</div>
		</div><!--/.row-->

		<div class="row">
			<div class="error">
				<?php role_attendance($key,$work); ?>
			</div>
			<div class="col-lg-offset-2 col-lg-6">
				<div class="panel panel-primary">
					<div class="panel-heading">
						Choose details of students
					</div>
					<div class="panel-body">
						<form class="form-signin" method="post" action="">
							<?php
								global $con;
								$key = $key;
								
							?>
							<div>
								<label for="name">Course</label>
								<select class="form-control" name="course" required>
								<option value=''>-</option>
								<option name="BBA" value="BBA">BBA</option>
								<option name="BCA" value="BCA">BCA</option>
								<option name="BBM" value="BBM">BBM</option>
								<option name="BScIT" value="BScIT">BScIT</option>
								<option name="PGDM" value="PGDM">PGDM</option>
								<option name="BCOM" value="BCOM">BCOM</option>
								</select>
								<label for="name">University</label>
								<select class="form-control" name="university" required>
								<option value=''>-</option>
								<option name="AKU" value="AKU">AKU</option>
								<option name="PPU" value="PPU">PPU</option>
								</select>
								<label for="name">Session <small>starts in</small></label>
								<select class="form-control" name="session" required>
								<option value=''>-</option>
								<option name="2015" value="2015">2015</option>
								<option name="2016" value="2016">2016</option>
								<option name="2017" value="2017">2017</option>
								<option name="2018" value="2018">2018</option>
								<option name="2019" value="2019">2019</option>
								<option name="2020" value="2020">2020</option>
								<option name="2021" value="2021">2021</option>
								<option name="2022" value="2022">2022</option>
								<option name="2023" value="2023">2023</option>
								<option name="2024" value="2024">2024</option>
								<option name="2025" value="2025">2025</option>
								<option name="2026" value="2026">2026</option>
								<option name="2027" value="2027">2027</option>
								<option name="2028" value="2028">2028</option>
								<option name="2029" value="2029">2029</option>
								<option name="2030" value="2030">2030</option>
								</select>
							</div>
							
						</div>
						<div class="panel-footer">
							<button class="btn btn-primary pull-left" name="role_attendance" type="submit" id="login">Next</button>&nbsp;&nbsp;
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