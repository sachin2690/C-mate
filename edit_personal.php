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

		<div class="row">
			<ol class="breadcrumb">
				<li><a href="home.php"><i class="fa fa-home" aria-hidden="true"></i></a></li>
				<li class="active">Edit Personal Information</li>
			</ol>
		</div><!--/.row-->

		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Edit Personal Information</h1>
			</div>
		</div><!--/.row-->

	<?php
	$query = "SELECT * FROM userinfo where id='$id'";
	$result = mysqli_query($con,$query);
	$rows = mysqli_affected_rows($con);

	if($rows == 1)
	{
		while($member_data = mysqli_fetch_assoc($result))
		{
			$member_id = $member_data['id'];
			$member_name = $member_data['name'];
			$member_course = $member_data['course'];
			$member_session = $member_data['session'];
			$member_university = $member_data['university'];
			$member_dob = $member_data['dob'];
			//$member_email = $member_data['email'];
			$member_mobile = $member_data['mobile'];
			$member_role = $member_data['role'];
		}
	}
	else
	{
		echo 'error while retriving member information';
	}
?>



<script>
function verify()
{	
		var name = document.getElementById("name");
		//alert(name.value);
		var isalphabet=/^[a-zA-Z\s]*$/;
		if(!name.value.match(isalphabet)) 
		{  
			alert('Please use alphabets only in name.')
			return false;
		}
	
	
	else
	{
		var mobile = document.getElementById("mobile");
		//alert(mobile.value);
		var isten=/^\d{10}$/;
		if(!mobile.value.match(isten)) 
			{  
				alert('Please use 10 digit mobile number.')
				return false;
			}	
	}
	

	
}

	
</script>




	<div class="row">
		<div class="error">
			<?php edit_personal($role,$id,$email); ?>
		</div>
		<div class="col-lg-offset-2 col-lg-6">
			<form class="form-signin" method="post" action="" onsubmit="return verify()">
				<label for="name">ID</label>
				<input type="text" value="<?php echo $member_id;?>" name="id" placeholder="id" id="id" class="form-control" readonly><br>
				<label for="name">Name</label>
				<input type="text" value="<?php echo $member_name;?>" name="name" placeholder="Name" id="name" class="form-control" required><br>
				<?php
						echo '<label for="name">Course</label>
						<select class="form-control" name="course">
							<option name="'.$member_course.'" value="'.$member_course.'">'.$member_course.'</option>
		    				<option name="BBA" value="BBA">BBA</option>
						   	<option name="BCA" value="BCA">BCA</option>
						  	<option name="BBM" value="BBM">BBM</option>
						   	<option name="BScIT" value="BScIT">BScIT</option>
						   	<option name="PGDM" value="PGDM">PGDM</option>
						   	<option name="BCOM" value="BCOM">BCOM</option>
		  				</select><br>';
						echo '<label for="name">Session <small>starts in</small></label>
						<select class="form-control" name="session">
							<option name="'.$member_session.'" value="'.$member_session.'">'.$member_session.'</option>
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
						echo '<label for="name">University</label>
						<select class="form-control" name="university">
							<option name="'.$member_university.'" value="'.$member_university.'">'.$member_university.'</option>
		    				<option name="AKU" value="AKU">AKU</option>
						   	<option name="PPU" value="PPU">PPU</option>
		  				</select><br>';						
					 ?>
				<label for="name">DOB</label>
				<input type="date" value="<?php echo $member_dob;?>" name="dob" placeholder="dd-mm-yyyy" id="dob" class="form-control" ><br>
				<!--<label for="name">Email</label>
				<input type="email" value="<?php echo $member_email;?>" name="email" placeholder="Email" id="email" class="form-control" ><br>-->
				<label for="name">Mobile</label>
				<input type="tel" value="<?php echo $member_mobile;?>" name="mobile" placeholder="Mobile" id="mobile" class="form-control" required><br>
				<label for="name">Role <small>(only Admin/Technical can add/edit roles)</small></label>
				<input type="text" value="<?php echo $member_role;?>" class="form-control" readonly><br>
				
				<button class="btn btn-primary" name="edit_member" type="submit" id="login">Edit</button>&nbsp;&nbsp;
				<a href="home.php" class="btn btn-default" >Cancel</a>
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