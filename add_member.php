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

	if($role != 'Admin' && $role != 'Technical')
	{
		echo '<div class="text-center alert bg-warning col-md-offset-4 col-md-4"><p><b>Access Forbidden</b></p></div>';
		echo '<script>setTimeout(function () { window.location.href = "home.php";}, 1000);</script>';
		exit();
	}
?>
<script>
function verify()
{	
		var naam = document.getElementById("naam");
		//alert(name.value);
		var isalphabet=/^[a-zA-Z\s]*$/;
		var mobile = document.getElementById("mobile");
		//alert(mobile.value);
		var isten=/^\d{10}$/;
		var pass = document.getElementById("password").value;
		var cpass = document.getElementById("cpassword").value;
		//alert(password.value);
		var condition=/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9])(?=.{8,15})/;
		if (!naam.value.match(isalphabet)) 
		{  
			alert('Please use alphabets only in name.')
			return false;
		}
		else if (!mobile.value.match(isten))
		{
		alert('Please use 10 digit mobile number.')
		return false;
		}
		else
		{
			if(!password.value.match(condition)) 
			{  
			alert('Please use a strong password')
			return false;
			}
			else if(pass != cpass)
			{
				alert('Password and Confirm password doesnot match')
				return false;
			}
		}
	//else
	//{
		//var p=document.getElementById("password").value;
		//var cp=document.getElementById("cpassword").value;
		//if(p!=cp)
		//{
		//alert('Password and Confirm Password field does not match');
		//document.resetpassword.cpassword.focus();
		//return false;
		//}
	//}
	
}

	
</script>
			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="home.php"><i class="fa fa-home" aria-hidden="true"></i></a></li>
				<li><a href="manage_members.php">Members</a></li>
				<li class="active">Add New Member</li>
			</ol>
		</div><!--/.row-->

		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Add New Member</h1>
			</div>
		</div><!--/.row-->

		<div class="row">
			<div class="error">
				<?php add_member($role); ?>
			</div>
			<div class="col-lg-offset-2 col-lg-6">
				<form class="form-signin" method="post" action="" onsubmit="return verify()">
					<label for="name">ID</label>
					<input type="text" name="id" placeholder="Id" id="id" class="form-control" required><br>
					<label for="name">Name</label>
					<input type="text" name="name" placeholder="Name" id="naam" class="form-control" required><br>
					<?php
						echo '<label for="name">Course</label>
						<select class="form-control" name="course">
							<option value="">-</option>
		    				<option name="BBA" value="BBA">BBA</option>
						   	<option name="BCA" value="BCA">BCA</option>	
						  	<option name="BBM" value="BBM">BBM</option>
						   	<option name="BScIT" value="BScIT">BScIT</option>
						   	<option name="PGDM" value="PGDM">PGDM</option>
						   	<option name="BCOM" value="BCOM">BCOM</option>
		  				</select><br>';
						echo '<label for="name">University</label>
						<select class="form-control" name="university">
							<option value="">-</option>
		    				<option name="AKU" value="AKU">AKU</option>
						   	<option name="PPU" value="PPU">PPU</option>
		  				</select><br>';
						echo '<label for="name">Session <small>starts in</small></label>
						<select class="form-control" name="session">
							<option value="">-</option>
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
		  				</select><br>';
												
					 ?>
					<label for="name">DOB</label>
					<input type="date" name="dob" placeholder="dd-mm-yyyy" id="dob" class="form-control" required><br>
					<label for="name">Email</label>
					<input type="email" name="email" placeholder="Email" id="email" class="form-control" required><br>
					<label for="name">Mobile</label>
					<input type="tel" name="mobile" placeholder="mobile" id="mobile" class="form-control" required><br>
					<label for="name">Password</label>
					<input type="password" name="password" placeholder="password" id="password" class="form-control" required><br>
					<label for="name">Confirm Password</label>
					<input type="password" name="cpassword" placeholder="Confirm Password" id="cpassword" class="form-control" required><br>
					
					<?php if($role == 'Admin' || $role == 'Technical')
					{
						echo '<label for="name">Role</label>
						<select class="form-control" name="role" required>
							<option value="">-</option>
		    				<option name="Student" value="Student">Student</option>
						   	<option name="Teacher" value="Teacher">Teacher</option>
						  	<option name="Staff" value="Staff">Staff</option>
							<option name="Technical" value="Technical">Technical</option>
						   	<option name="Admin" value="Admin">Admin</option>
		  				</select><br>';
					} ?>
					<button class="btn btn-primary" name="add_member" type="submit" id="login">Add</button>&nbsp;&nbsp;
					<a href="manage_members.php" class="btn btn-default" id="login">Cancel</a>
				</form>
			</div>
		</div><!--/.row-->
		<script>
		$(document).ready(function()
		{
		     $("#dtBox").DateTimePicker();
		});
 	</script>
<link rel="stylesheet" type="text/css" href="css/DateTimePicker.min.css" />
<script type="text/javascript" src="js/DateTimePicker.min.js"></script>
<?php
	at_bottom();