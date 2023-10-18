<!-- *************

***************-->



<?php
require_once('dbconfig.php');
global $con;
 

/*******************************
 * Registering new member.
 *******************************/

function signup()
{
	global $con;

	if (isset($_POST['signup'])) 
	{
		$id = $_POST['id'];
		$id = stripslashes($id);
		$name = $_POST['name'];
		$name = stripslashes($name);
		$select_course = $_POST["course"];
		$select_session = $_POST["session"];
		$select_university = $_POST["university"];
		$dob = $_POST['dob'];
		$dob = stripslashes($dob);
		$email = $_POST['email'];
		$email = stripslashes($email);
		$mobile = $_POST['mobile'];
		$mobile = stripslashes($mobile);
		$password = $_POST['password'];
		$password = md5(stripslashes($password));
		$cpassword = $_POST['cpassword'];
		$cpassword = md5(stripslashes($cpassword));		
		$select_role = $_POST["role"];
		$pic = 'imgs/user.png';
		$token= bin2hex(random_bytes(15));
		
		
		$idquery = "select * from userinfo where id='$id'";
		$emailquery = "select * from userinfo where email='$email'";
		$queryid = mysqli_query($con,$idquery);
		$queryemail = mysqli_query($con,$emailquery);
		$idcount = mysqli_num_rows($queryid);
		$emailcount = mysqli_num_rows($queryemail);
		if($idcount > 0)
		{
			echo '<div class="text-center alert bg-danger col-md-offset-4 col-md-4" role="alert"><span>ID already exists.</span></div>';
			echo '<script>setTimeout(function () { window.location.href = "signup.php";}, 1000);</script>';
		}
		else
		{
			if($emailcount >0)
			{
				echo '<div class="text-center alert bg-danger col-md-offset-4 col-md-4" role="alert"><span>Email already exists.</span></div>';
				echo '<script>setTimeout(function () { window.location.href = "signup.php";}, 1000);</script>';
			}
			else
			{
				$query = "INSERT into userinfo (id, name, course, session, university, dob,  email, mobile, password, role, pic, token, status) VALUES ('$id',  '$name',  '$select_course', '$select_session', '$select_university', '$dob',  '$email',  '$mobile', '$password', '$select_role', '$pic','$token','inactive')";
				$result = mysqli_query($con,$query);
				$rows = mysqli_affected_rows($con);
				if($rows == 1)
				{
					$subject="Activation of C-mate";
					$body="Hii, $name . Click here to activate your account http://localhost/dashboard/C-mate%20quarter/activate.php?token=$token";
					$headers = "From: your@gamil.com";
					if(mail($email,$subject,$body,$headers)){
						echo "Check your mail for activation of account $email ";
						header('location:index.php');

					}
					else{
						echo "Email sending failed...";
					}
				}
				else
				{
					echo '<div class="text-center alert alert-danger col-md-offset-4 col-md-4"><p><b>Error While Registering, Try Again</b></p></div>';
					echo '<script>setTimeout(function () { window.location.href = "signup.php";}, 1000);</script>';
				}
			}	
		}

	return false;
}}

/*******************************
 * function for login into panel.
 *******************************/

function login()
{
	global $con;
	if (isset($_POST['submit'])) 
	{
		$email = $_POST['email'];
		$email = stripslashes($email);
		$password = $_POST['password'];
		$password = md5(stripslashes($password));

		$query = "SELECT * from userinfo where email ='$email' AND password ='$password' AND status='active'";
		$result = mysqli_query($con,$query);
		$rows = mysqli_affected_rows($con);

		if($rows == 1)
		{
			while($row = mysqli_fetch_assoc($result))
			{
				$last_login = $row['currunt_login'];
				$name=$row['name'];
				$query = "UPDATE userinfo SET last_login='$last_login', currunt_login=NOW() WHERE email='$email'";
				mysqli_query($con,$query);
			}
			

			echo '<div class="text-center alert bg-success col-md-offset-4 col-md-4" role="alert"><span>Welcome back, <b>'.$name.'</b>!</span></div>';
			echo '<script>setTimeout(function () { window.location.href = "home.php";}, 1000);</script>';
			$_SESSION['email'] = $email;
		}
		else
		{
			echo '<div class="text-center alert bg-danger col-md-offset-4 col-md-4" role="alert"><span>Sorry Try Again!</span></div>';
			echo '<script>setTimeout(function () { window.location.href = "index.php";}, 1000);</script>';
		}	
	}

	return false;
}

/*******************************
 * forgot password function.
 *******************************/

function forgot()
{
	global $con;
	if(isset($_POST['change']))
	{
		$id = $_POST['id'];
		$id = stripslashes($id);
		$email = $_POST['email'];
		$email = stripslashes($email);
		$new_pwd = $_POST['new_pwd'];
		$new_pwd = md5(stripcslashes($new_pwd));
		$cnf_pwd = $_POST['cnf_pwd'];
		$cnf_pwd = md5(stripcslashes($cnf_pwd));

		$query = "SELECT * from userinfo where id='$id' AND email ='$email'";
		$result = mysqli_query($con,$query);
		$rows = mysqli_affected_rows($con);

		if($rows == 1)
		{
			if($new_pwd == $cnf_pwd)
			{				
				$query1 = "UPDATE userinfo SET password='$new_pwd' WHERE email='$email'";
				mysqli_query($con,$query1);
				$row = mysqli_affected_rows($con);
				if($row == 1)
				{
					echo '<div class="text-center alert bg-success col-md-offset-4 col-md-4"><span>Password changed successfully!</span></div>';
					echo '<script>setTimeout(function () { window.location.href = "index.php";}, 1000);</script>';
				}
				else
				{
					echo '<div class="text-center alert bg-danger col-md-offset-4 col-md-4"><span>Problem while updating password,try different password</span></div>';
					echo '<script>setTimeout(function () { window.location.href = "forgot_pwd.php";}, 1000);</script>';
				}
			}
			else
			{
				echo '<div class="text-center alert bg-danger col-md-offset-4 col-md-4"><span>New password and Confirm password must be same.</span></div>';
				echo '<script>setTimeout(function () { window.location.href = "forgot_pwd.php";}, 1000);</script>';
			}
		}
		else
		{
			echo '<div class="text-center alert bg-danger col-md-offset-4 col-md-4" role="alert"><span>Sorry Try Again!</span></div>';
			echo '<script>setTimeout(function () { window.location.href = "forgot_pwd.php";}, 1000);</script>';
		}		
	}
	
	return false;
}


/*******************************
 * to check for authorized user.
 *******************************/

function check_session()
{
	if( !isset($_SESSION["email"]) )
	{
    	header("location:index.php");
    	exit();
	}	
    return false;
}

/*******************************
 * load all data of the session user.
 *******************************/

function get_member_data($email)
{
	global $con,$row;
	$query = "SELECT * FROM userinfo WHERE email='$email'";
	$result = mysqli_query($con,$query);
	$rows = mysqli_affected_rows($con);
	
	if($rows == 1)
	{
		$row = mysqli_fetch_assoc($result);
	}
	else
		echo 'error while retriving data';
	return $row;
}

/*******************************
 * to load all required user data for user settings.
 *******************************/

function user_setting($user_id)
{
	global $con;
	$user_id = $user_id;
	$query = "SELECT * FROM userinfo where id='$user_id'";
	$result = mysqli_query($con,$query);
	$rows = mysqli_affected_rows($con);
	
	if($rows == 1)
	{
		$row = mysqli_fetch_assoc($result);
	}
	else
		echo 'error while retriving data';
	return $row;	
}

/*******************************
 * change password of user.
 *******************************/

function update_settings($id)
{
	global $con;

	$query = "SELECT * FROM userinfo where id='$id'";
		$result = mysqli_query($con,$query);
		$rows = mysqli_affected_rows($con);
	
		if($rows == 1)
		{
			while($row = mysqli_fetch_assoc($result))
			{
				$table_pwd = $row['password'];
			}
		}
		else
		{
			echo 'error while retriving password';
		}
		

	if (isset($_POST['update_settings'])) 
	{
		$old_pwd = $_POST['old_pwd'];
		$old_pwd = md5(stripslashes($old_pwd));
		$new_pwd = $_POST['new_pwd'];
		$new_pwd = md5(stripslashes($new_pwd));
		$cnf_pwd = $_POST['cnf_pwd'];
		$cnf_pwd = md5(stripslashes($cnf_pwd));

		if($new_pwd == $cnf_pwd)
		{
			if($old_pwd == $table_pwd)
			{
				if($new_pwd != $old_pwd)
				{
					$query = "UPDATE userinfo SET password='$new_pwd' WHERE id='$id'";
					mysqli_query($con,$query);
					$rows = mysqli_affected_rows($con);
					if($rows == 1)
					{
						echo '<div class="text-center alert bg-success col-md-offset-4 col-md-4"><span>Password changed successfully.</span></div>';
						echo '<script>setTimeout(function () { window.location.href = "home.php";}, 1000);</script>';
					}
					else
					{
						echo '<div class="text-center alert bg-danger col-md-offset-4 col-md-4"><span>Problem while updating password</span></div>';
						echo '<script>setTimeout(function () { window.location.href = "user_settings.php?user_id=<?php echo $id; ?>";}, 1000);</script>';
					}
				}
				else
				{
					echo '<div class="text-center alert bg-danger col-md-offset-4 col-md-4"><span>New password cannot be same as Old password</span></div>';
					echo '<script>setTimeout(function () { window.location.href = "user_settings.php?user_id=<?php echo $id; ?>";}, 1000);</script>';
				}
			}
			else
			{
				echo '<div class="text-center alert bg-danger col-md-offset-4 col-md-4"><span>check your old password and try again</span></div>';
				echo '<script>setTimeout(function () { window.location.href = "user_settings.php?user_id=<?php echo $id; ?>";}, 1000);</script>';
			}
			
		}
		else
		{
			echo '<div class="text-center alert bg-danger col-md-offset-4 col-md-4"><span>New password and Confirm Password does not match</span></div>';
			echo '<script>setTimeout(function () { window.location.href = "user_settings.php?user_id=<?php echo $id; ?>";}, 2000);</script>';
		}
		
	}

	return false;
}

/*******************************
 * calculate count of all members.
 *******************************/

function get_all_status()
{
	global $con;
	$query = "SELECT * FROM userinfo";
	$result = mysqli_query($con,$query);
	$rows = mysqli_affected_rows($con);
	return $rows;
}

/*******************************
 * calculate count of all blog_posts.
 *******************************/

function get_all_posts()
{
	global $con;
	$query = "SELECT * FROM blog_posts";
	$result = mysqli_query($con,$query);
	$rows = mysqli_affected_rows($con);
	return $rows;
}

/*******************************
 * calculate count of CORE members
 *******************************/

function get_vip_status()
{
	global $con;
	$query = "SELECT * FROM userinfo where role NOT LIKE 'Student'";
	$result = mysqli_query($con,$query);
	$rows = mysqli_affected_rows($con);
	return $rows;
}

/*******************************
 * calculate total sessions.
 *******************************/

function total_sessions()
{
	global $con;
	$query = "SELECT * FROM sessions";
	$result = mysqli_query($con,$query);
	$rows = mysqli_affected_rows($con);
	return $rows;
}

/*******************************
 * calculate complete sessions
 *******************************/

function completed_sessions()
{
	global $con;
	$query = "SELECT * FROM sessions";
	$result = mysqli_query($con,$query);
	$rows = mysqli_affected_rows($con);
	$completed_sessions = 0;
	if($rows == 0)
	{
		$completed_sessions = 0;
	}
	else
	{
		while($row = mysqli_fetch_assoc($result))
		{
			if(time() >= strtotime($row['session_date']))
			{
				$completed_sessions++;
			}
		}
	}
	return $completed_sessions;
}

/*******************************
 * retrive all member data in table format.
 *******************************/

function all_member_table($role)
{
	global $con;
	$role = $role;
	$query = "SELECT * FROM userinfo";
	$result = mysqli_query($con,$query);
	$rows = mysqli_affected_rows($con);
	?>
	<table class="table table-hover table-responsive">
			<tr class="alert-info">
				<th><h4>Id</h4></th>
				<th><h4>Name</h4></th>
				<th><h4>Session</h4></th>
				<th><h4>University</h4></th>
				<th><h4>Course</h4></th>
				<th><h4>DOB</h4></th>
				<th><h4>Email</h4></th>
				<th><h4>Mobile</h4></th>
				<th><h4>Role</h4></th>
				<th><h4>Action</h4></th>
			</tr>
	<?php
	while ($row = mysqli_fetch_assoc($result))
		{
			if(empty($row['course']))
			{
				$row['course'] = '-';
			}
			if($row['session']=='')
			{
				$row['session'] = '-';
			}
			if(empty($row['university']))
			{
				$row['university'] = '-';
			}
			if(empty($row['dob']))
			{
				$row['dob'] = '-';
			}
			echo '<tr>
				<td>'.$row['id'].'</td>
				<td>'.$row['name'].'</td>
				<td>'.$row['session'].'</td>
				<td>'.$row['university'].'</td>
				<td>'.$row['course'].'</td>
				<td>'.$row['dob'].'</td>
				<td>'.$row['email'].'</td>
				<td>'.$row['mobile'].'</td>
				<td>'.$row['role'].'</td>
				<td>';
				
				if($role == "Admin" || $role == "Technical")
				{
					echo '<a href="edit_member.php?id='.$row['id'].'">Edit</a> | <a href="delete_member.php?mem_id='.$row['id'].'">Remove</a>';
				}
				else
				{
					echo '-';
				}
			
			echo '</td></tr>';
		}
	echo '</table>';
	return false;
}

/*******************************
 * retrive search member data in table format.
 *******************************/

function search_member_table($role,$sid)
{
	global $con;
	$role = $role;
	$sid = $sid;
	$query = "SELECT * FROM userinfo where id='$sid'";
	$result = mysqli_query($con,$query);
	$rows = mysqli_affected_rows($con);
	?>
	<table class="table table-hover table-responsive">
			<tr class="alert-info">
				<th><h4>Id</h4></th>
				<th><h4>Name</h4></th>
				<th><h4>Session</h4></th>
				<th><h4>University</h4></th>
				<th><h4>Course</h4></th>
				<th><h4>DOB</h4></th>
				<th><h4>Email</h4></th>
				<th><h4>Mobile</h4></th>
				<th><h4>Role</h4></th>
				<th><h4>Action</h4></th>
			</tr>
	<?php
	while ($row = mysqli_fetch_assoc($result))
		{
			if(empty($row['course']))
			{
				$row['course'] = '-';
			}
			if($row['session']=='')
			{
				$row['session'] = '-';
			}
			if(empty($row['university']))
			{
				$row['university'] = '-';
			}
			if(empty($row['dob']))
			{
				$row['dob'] = '-';
			}
			echo '<tr>
				<td>'.$row['id'].'</td>
				<td>'.$row['name'].'</td>
				<td>'.$row['session'].'</td>
				<td>'.$row['university'].'</td>
				<td>'.$row['course'].'</td>
				<td>'.$row['dob'].'</td>
				<td>'.$row['email'].'</td>
				<td>'.$row['mobile'].'</td>
				<td>'.$row['role'].'</td>
				<td>';
				
				if($role == "Admin" || $role == "Technical")
				{
					echo '<a href="edit_member.php?id='.$row['id'].'">Edit</a> | <a href="delete_member.php?mem_id='.$row['id'].'">Remove</a>';
				}
				else
				{
					echo '-';
				}
			
			echo '</td></tr>';
		}
	echo '</table>';
	return false;
}



/*******************************
 * retrive EDIT member data in table format.
 *******************************/

function edit_member_table($role)
{
	global $con;
	$role = $role;
	$query = "SELECT * FROM userinfo";
	$result = mysqli_query($con,$query);
	$rows = mysqli_affected_rows($con);
	?>
	<?php
	while ($row = mysqli_fetch_assoc($result))
		{
			if(empty($row['course']))
			{
				$row['course'] = '-';
			}
			if($row['session']=='')
			{
				$row['session'] = '-';
			}
			if(empty($row['university']))
			{
				$row['university'] = '-';
			}
			if(empty($row['dob']))
			{
				$row['dob'] = '-';
			}
			
				$mem_id=$row['id'];
		}
	return $mem_id;
}

/*******************************
 * Add new member.
 *******************************/

function add_member($role)
{
	global $con;
	$role = $role;

	if (isset($_POST['add_member'])) 
	{
		$id = $_POST['id'];
		$id = stripslashes($id);
		$name = $_POST['name'];
		$name = stripslashes($name);
		$select_course = $_POST["course"];
		$select_session = $_POST["session"];
		$select_university = $_POST["university"];
		$dob = $_POST['dob'];
		$dob = stripslashes($dob);
		$email = $_POST['email'];
		$email = stripslashes($email);
		$mobile = $_POST['mobile'];
		$mobile = stripslashes($mobile);
		$password = $_POST['password'];
		$password = md5(stripslashes($password));
		$cpassword = $_POST['cpassword'];
		$cpassword = md5(stripslashes($cpassword));	
		$pic = 'imgs/user.png';

		if($role == 'Admin' || $role == 'Technical')
		{
			$select_role = $_POST["role"];

		}
		else
		{
			$select_role = "-";
		}
		
		$idquery = "select * from userinfo where id='$id'";
		$emailquery = "select * from userinfo where email='$email'";
		$queryid = mysqli_query($con,$idquery);
		$queryemail = mysqli_query($con,$emailquery);
		$idcount = mysqli_num_rows($queryid);
		$emailcount = mysqli_num_rows($queryemail);
		if($idcount > 0)
		{
			echo '<div class="text-center alert bg-danger col-md-offset-4 col-md-4" role="alert"><span>ID already exists.</span></div>';
			echo '<script>setTimeout(function () { window.location.href = "add_member.php";}, 1000);</script>';
		}
		else
		{
			if($emailcount >0)
			{
				echo '<div class="text-center alert bg-danger col-md-offset-4 col-md-4" role="alert"><span>Email already exists.</span></div>';
				echo '<script>setTimeout(function () { window.location.href = "add_member.php";}, 1000);</script>';
			}
			else
			{
				$query = "INSERT into userinfo (id, name, course, session, university, dob,  email, mobile, password, role, pic) VALUES ('$id',  '$name',  '$select_course', '$select_session', '$select_university', '$dob',  '$email',  '$mobile', '$password', '$select_role', '$pic')";
				$result = mysqli_query($con,$query);
				$rows = mysqli_affected_rows($con);
				if($rows == 1)
				{
					echo '<div class="text-center alert alert-success col-md-offset-4 col-md-4"><p><b>Success! Member Added</b></p></div>';
					echo '<script>setTimeout(function () { window.location.href = "manage_members.php";}, 1000);</script>';
				}
				else
				{
					echo '<div class="text-center alert alert-danger col-md-offset-4 col-md-4"><p><b>Error while adding member, try again</b></p></div>';
					echo '<script>setTimeout(function () { window.location.href = "add_member.php";}, 1000);</script>';
				}
			}	
		}

	return false;
}}

/*******************************
 * edit member information.
 *******************************/

function edit_member($role,$mem_id,$email,$semail)
{
	global $con;
	$role = $role;
	$mem_id = $mem_id;
	$email = $email;
	$semail = $semail;

	if (isset($_POST['edit_member']))
	{
		$edit_id = $_POST['id'];
		$edit_id = stripslashes($edit_id);
		$edit_name = $_POST['name'];
		$edit_name = stripslashes($edit_name);
		$edit_select_course = $_POST['course'];
		$edit_select_session = $_POST['session'];
		$edit_select_university = $_POST['university'];
		$edit_dob = $_POST['dob'];
		$edit_dob = stripslashes($edit_dob);
		$edit_email = $_POST['email'];
		$edit_email = stripslashes($edit_email);
		$edit_mobile = $_POST['mobile'];
		$edit_mobile = stripslashes($edit_mobile);
		
		if($role = 'Admin')
		{
			$edit_select_role = $_POST['role'];
		}
		else
		{
			$edit_select_role = "";
		}
		$query = "UPDATE userinfo SET id='$edit_id', name='$edit_name', course='$edit_select_course', session='$edit_select_session', university='$edit_select_university', dob='$edit_dob', email='$edit_email', mobile='$edit_mobile', role='$edit_select_role' WHERE id='$mem_id'";
		
		if(($mem_id == $edit_id) and ($email == $edit_email)) // ID & EMAIL not changed
		{
			$result = mysqli_query($con,$query);
			$rows = mysqli_affected_rows($con);
			if($rows == 1)
			{
				echo '<div class="text-center alert alert-success col-md-offset-4 col-md-4"><p><b>Success! info updated.</b></p></div>';
				echo '<script>setTimeout(function () { window.location.href = "manage_members.php";}, 1000);</script>';
			}
			else
			{
				echo '<div class="text-center alert alert-danger col-md-offset-4 col-md-4"><p><b>error while updating info, try again</b></p></div>';
				echo '<script>setTimeout(function () { window.location.href = "edit_member.php?id='.$mem_id.'";}, 1000);</script>';
			}
		}
		elseif($mem_id != $edit_id)  // ID changed
		{
			$idquery = "select * from userinfo where id='$edit_id'";
			$queryid = mysqli_query($con,$idquery);
			$idcount = mysqli_num_rows($queryid);
			if($idcount > 0) // ID exists
			{
				echo '<div class="text-center alert bg-danger col-md-offset-4 col-md-4" role="alert"><span>ID already exists.</span></div>';
				echo '<script>setTimeout(function () { window.location.href = "edit_member.php?id='.$mem_id.'";}, 1000);</script>';
			}
			else // NEW ID
			{
				if($email == $edit_email) // ID changed but email not changed
				{
					$result = mysqli_query($con,$query);
					$rows = mysqli_affected_rows($con);
					if($rows == 1)
					{
						echo '<div class="text-center alert alert-success col-md-offset-4 col-md-4"><p><b>Success! info updated.</b></p></div>';
						echo '<script>setTimeout(function () { window.location.href = "manage_members.php";}, 1000);</script>';						
					}
					else
					{
						echo '<div class="text-center alert alert-danger col-md-offset-4 col-md-4"><p><b>error while updating info, try again</b></p></div>';
						echo '<script>setTimeout(function () { window.location.href = "edit_member.php?id='.$mem_id.'";}, 1000);</script>';
					}
				}
				else   // ID & Email both changed
				{
					$emailquery = "select * from userinfo where email='$edit_email'";
					$queryemail = mysqli_query($con,$emailquery);
					$emailcount = mysqli_num_rows($queryemail);
					if($emailcount >0) // EMAIL exists
					{
						echo '<div class="text-center alert bg-danger col-md-offset-4 col-md-4" role="alert"><span>Email already exists.</span></div>';
						echo '<script>setTimeout(function () { window.location.href = "edit_member.php?id='.$mem_id.'";}, 1000);</script>';
					}
					else // new email & new id
					{
						$result = mysqli_query($con,$query);
						$rows = mysqli_affected_rows($con);
						if($rows == 1)
						{
							if($email == $semail)
							{
								echo '<div class="text-center alert alert-success col-md-offset-4 col-md-4"><p><b>Success! info updated,Kindly re-login.</b></p></div>';
								echo '<script>setTimeout(function () { window.location.href = "logout.php";}, 1000);</script>';
							}
							else
							{
								echo '<div class="text-center alert alert-success col-md-offset-4 col-md-4"><p><b>Success! info updated,642</b></p></div>';
								echo '<script>setTimeout(function () { window.location.href = "manage_members.php";}, 1000);</script>';
							}
						}
						else
						{
							echo '<div class="text-center alert alert-danger col-md-offset-4 col-md-4"><p><b>error while updating info, try again</b></p></div>';
							echo '<script>setTimeout(function () { window.location.href = "edit_member.php?id='.$mem_id.'";}, 1000);</script>';
						}
					}
				}
			}
		}
		else   // Email changed but id not changed
		{
			$emailquery = "select * from userinfo where email='$edit_email'";
			$queryemail = mysqli_query($con,$emailquery);
			$emailcount = mysqli_num_rows($queryemail);
			if($emailcount >0) // EMAIL exists
			{
				echo '<div class="text-center alert bg-danger col-md-offset-4 col-md-4" role="alert"><span>Email already exists.</span></div>';
				echo '<script>setTimeout(function () { window.location.href = "edit_member.php?id='.$mem_id.'";}, 1000);</script>';
			}
			else // new email but id not changed
			{
				$result = mysqli_query($con,$query);
				$rows = mysqli_affected_rows($con);
				if($rows == 1)
				{
					if($email==$semail)
					{
						echo '<div class="text-center alert alert-success col-md-offset-4 col-md-4"><p><b>Success! info updated,Kindly re-login.</b></p></div>';
						echo '<script>setTimeout(function () { window.location.href = "logout.php";}, 1000);</script>';
					}
					else
					{
						echo '<div class="text-center alert alert-success col-md-offset-4 col-md-4"><p><b>Success! info updated.</b></p></div>';
						echo '<script>setTimeout(function () { window.location.href = "manage_members.php";}, 1000);</script>';
					}
				}
				else
				{
					echo '<div class="text-center alert alert-danger col-md-offset-4 col-md-4"><p><b>error while updating info, try again</b></p></div>';
					echo '<script>setTimeout(function () { window.location.href = "edit_member.php?id='.$mem_id.'";}, 1000);</script>';
				}
			}
		}
	}
	return false;
}

/*******************************
 * edit personal information.
 *******************************/

function edit_personal($role,$id)
{
	global $con;
	$role = $role;
	$id = $id;

	if (isset($_POST['edit_member']))
	{
		$edit_name = $_POST['name'];
		$edit_name = stripslashes($edit_name);
		$edit_select_course = $_POST['course'];
		$edit_select_session = $_POST['session'];
		$edit_select_university = $_POST['university'];		
		$edit_dob = $_POST['dob'];
		$edit_dob = stripslashes($edit_dob);
		$edit_mobile = $_POST['mobile'];
		$edit_mobile = stripslashes($edit_mobile);
		
		$query = "UPDATE userinfo SET name='$edit_name', course='$edit_select_course', session='$edit_select_session', university='$edit_select_university', dob='$edit_dob', mobile='$edit_mobile'  WHERE id='$id'";
		$result = mysqli_query($con,$query);
		$rows = mysqli_affected_rows($con);
		if($rows == 1)
		{
			echo '<div class="text-center alert alert-success col-md-offset-4 col-md-4"><p><b>Success! info updated</b></p></div>';
			echo '<script>setTimeout(function () { window.location.href = "home.php";}, 1000);</script>';
		}
		else
		{
			echo '<div class="text-center alert alert-danger col-md-offset-4 col-md-4"><p><b>Error while updating info, try again</b></p></div>';
			echo '<script>setTimeout(function () { window.location.href = "edit_personal.php?id='.$id.'";}, 1000);</script>';
		}
	}

	return false;
}


/*******************************
 * delete member record.
 *******************************/

function delete_member($mem_id,$role)
{
	global $con;
	$mem_id = $mem_id;
	$role = $role;

	if(isset($_POST['yes']))
	{
		$query = "DELETE from userinfo where id='$mem_id'";
		$result = mysqli_query($con,$query);
		$rows = mysqli_affected_rows($con);
		echo mysqli_error($con);
		if($rows == 1)
		{
			echo '<div class="text-center alert alert-success col-md-offset-4 col-md-4"><p><b>Success! Member removed</b></p></div>';
			echo '<script>setTimeout(function () { window.location.href = "manage_members.php";}, 1000);</script>';
		}
		else
		{
			echo '<div class="text-center alert alert-danger col-md-offset-4 col-md-4"><p><b>error while removing member, try again</b></p></div>';
			echo '<script>setTimeout(function () { window.location.href = "manage_members.php";}, 1000);</script>';
		}
	}
	
	return false;
}

/*******************************
 * show all session and events.
 *******************************/

function show_events($role)
{
	global $con;
	$query = "SELECT * FROM sessions ORDER by session_date ASC";
	$result = mysqli_query($con,$query);
	$rows = mysqli_affected_rows($con);

	if($rows == 0)
	{
		echo '<div class="text-center alert alert-info col-md-offset-4 col-md-4"><p><b>no events scheduled yet!</b></p></div>';
	}
	
	while($row = mysqli_fetch_assoc($result))
	{
		if(time() >= strtotime($row['session_date']))
		{
			$choose_css = "panel-red";
		}
		else
		{
			$choose_css = "panel-teal";
		}
		?>
			
		<div class="col-md-4">
			<div class="panel <?php echo $choose_css; ?>">
				<div class="panel-heading dark-overlay"><?php echo $row['session_name']; ?></div>
					<div class="panel-body">
						<p>
						<b>Date:</b> <small><?php echo date('jS M Y H:i', strtotime($row['session_date'])); ?></small><br>
						<?php echo $row['session_details']; ?>
						</p>
					</div>
					<?php
						if($role == 'Admin' || $role=="Technical")
		        		{
		        			echo '<div class="panel-footer"><a class="btn btn-primary btn-sm" href="edit_event.php?event_id='.$row['session_id'].'">Edit</a> <a class="btn btn-danger btn-sm pull-right" href="delete_event.php?event_id='.$row['session_id'].'">Delete</a></div>';
		        		}
					?>
			</div>
		</div>
	<?php
	}

	return false;
}

/*******************************
 * events in table format.
 *******************************/

function all_events_table($role)
{
	$role = $role;

	if($role == "Admin" || $role == "Technical")
	{
		global $con;
		$query = "SELECT * FROM sessions";
		$result = mysqli_query($con,$query);
		$rows = mysqli_affected_rows($con);
		if($rows == 0)
		{
			echo '<div class="col-md-offset-3 col-md-5 alert alert-warning text-center"><b>no event scheduled, schedule event first!</b></div>';
			exit();
		}
		?>
		<table class="table manage-member-panel table-hover table-responsive">
				<tr class="alert-info">
					<th><h4>Id</h4></th>
					<th><h4>Event Title</h4></th>
					<th><h4>Description</h4></th>
					<th><h4>Date</h4></th>
					<th><h4>Action</h4></th>
				</tr>
		<?php
		while ($row = mysqli_fetch_assoc($result))
			{
				echo '<tr>
					<td>'.$row['session_id'].'</td>
					<td>'.$row['session_name'].'</td>
					<td>'.$row['session_details'].'</td>
					<td>'.$row['session_date'].'</td>
					<td><a href="edit_event.php?event_id='.$row['session_id'].'">Edit</a>';
					echo ' | <a href="delete_event.php?event_id='.$row['session_id'].'">Remove</a></td></tr>';
			}
		echo '</table>';
		}
	return false;
}

/*******************************
 * add new event.
 *******************************/

function add_event()
{
	global $con;
	if (isset($_POST['add_event'])) 
	{
		$name = $_POST['name'];
		$name = stripslashes($name);
		$description = $_POST['description'];
		$description = stripslashes($description);
		$date = $_POST['date'];

		$query = "INSERT into sessions (session_name,  session_details, session_date) VALUES ('$name',  '$description', '$date')";
		$result = mysqli_query($con,$query);
		$rows = mysqli_affected_rows($con);
		if($rows == 1)
		{
			echo '<div class="text-center alert alert-success col-md-offset-4 col-md-4"><p><b>Success! event Added</b></p></div>';
			echo '<script>setTimeout(function () { window.location.href = "schedule.php";}, 1000);</script>';
		}
		else
		{
			echo '<div class="text-center alert alert-danger col-md-offset-4 col-md-4"><p><b>error while adding event, try again</b></p></div>';
			echo '<script>setTimeout(function () { window.location.href = "add_event.php";}, 1000);</script>';
		}
	}

	return false;
}

/*******************************
 * delete event.
 *******************************/

function delete_event($event_id,$role)
{
	global $con;
	$event_id = $event_id;
	$role = $role;

	if(isset($_POST['yes']))
	{
		$query = "DELETE from sessions where session_id='$event_id'";
		$result = mysqli_query($con,$query);
		$rows = mysqli_affected_rows($con);
		echo mysqli_error($con);
		if($rows == 1)
		{
			echo '<div class="text-center alert alert-success col-md-offset-4 col-md-4"><p><b>Success! Event removed</b></p></div>';
			echo '<script>setTimeout(function () { window.location.href = "schedule.php";}, 1000);</script>';
		}
		else
		{
			echo '<div class="text-center alert alert-danger col-md-offset-4 col-md-4"><p><b>error while removing session, try again</b></p></div>';
			echo '<script>setTimeout(function () { window.location.href = "schedule.php";}, 1000);</script>';
		}
	}
	
	return false;
}

/*******************************
 * edit event information.
 *******************************/

function edit_event($event_id,$role)
{
	global $con;
	$role = $role;
	$event_id = $event_id;

	if (isset($_POST['edit_event']))
	{
		$name = $_POST['name'];
		$name = stripslashes($name);
		$description = $_POST['description'];
		$description = stripslashes($description);
		$date = $_POST['date'];
		
		$query = "UPDATE sessions SET session_name='$name', session_details='$description', session_date='$date' WHERE session_id='$event_id'";
		$result = mysqli_query($con,$query);
		$rows = mysqli_affected_rows($con);
		if($rows == 1)
		{
			echo '<div class="text-center alert alert-success col-md-offset-4 col-md-4"><p><b>Success! info updated</b></p></div>';
			echo '<script>setTimeout(function () { window.location.href = "schedule.php";}, 1000);</script>';
		}
		else
		{
			echo '<div class="text-center alert alert-danger col-md-offset-4 col-md-4"><p><b>error while updating info, try again</b></p></div>';
			echo '<script>setTimeout(function () { window.location.href = "schedule.php";}, 1000);</script>';
		}
	}

	return false;
}

/*******************************
 *  attendance
 *******************************/
 function attendance($session_id,$role)
{
	global $con;
	$session_id = $session_id;

	$query = "SELECT * from attendance where session_id='$session_id'";
	$result = mysqli_query($con,$query);
	$rows = mysqli_affected_rows($con);

	$key = str_rot13($session_id);
	$fill = 'fill';
	$view = 'view';

	if($role == "Admin" || $role == "Teacher")
	{
		echo '<br><div class="text-center"><a href="role_attendance.php?key='.$key.'&work='.$fill.'" class="btn btn-primary">Fill Attendance for this Session</a></div>';
		echo '<br><div class="text-center"><a href="role_attendance.php?key='.$key.'&work='.$view.'" class="btn btn-primary">View Attendance for this Session</a></div>';
	}
	else
	{
		echo '<br><div class="text-center"><a href="role_attendance.php?key='.$key.'&work='.$view.'" class="btn btn-primary">View Attendance for this Session</a></div>';
	}

	return false;
}
/********************
* view attendace *
********************/
function view_attendance($session_id,$at_course,$at_university,$at_session)
{
	global $con;
	$session_id = $session_id;

	$query = "SELECT * from attendance WHERE session_id='$session_id' AND session='$at_session' AND university='$at_university' AND course='$at_course'";
	$result = mysqli_query($con,$query);
	$rows = mysqli_affected_rows($con);

	$key = str_rot13($session_id);

	if($rows == 1)
	{
		

		?>
		<div class="row">
			<div class="col-md-5">
				<table class="table table-responsive">
				<tr class="success"><th>ID</th><th>Present Members Name</th></tr>
		<?php

		// Present Code from here
		while ($row = mysqli_fetch_assoc($result))
		{
			$string_ids = unserialize($row['id_array']);
			foreach($string_ids as $key => $value)
			{
			    $query = "SELECT * FROM userinfo where id='$value' AND role='Student' AND university='$at_university' AND course='$at_course' AND session='$at_session'";
				$result = mysqli_query($con,$query);
				$rows = mysqli_affected_rows($con);
				if($rows == 0)
				{
					echo '<tr class="success"><td>&emsp;&emsp;No&emsp;&emsp;one</td><td>is&emsp;&emsp; present!</td>';
				}
				while ($row = mysqli_fetch_assoc($result))
				{
					echo '<tr class="success"><td>'.$row['id'].'</td>
					<td>'.$row['name'].'</td></tr>';
				}
			}			
			?>
				</table><?php
				echo '<br><div class="text-center"><a href="attendance.php" class="btn btn-primary">Back</a></div>';
				?></div>
				<div class="col-md-5">
					<table class="table table-responsive">
						<tr class="danger"><th>ID</th><th>Absent Members Name</th></tr>
					
						<?php
						// Absent Code from here

						$query = "SELECT id FROM userinfo where role='Student' AND university='$at_university' AND course='$at_course' AND session='$at_session'";
						$result = mysqli_query($con,$query);
						$rows = mysqli_affected_rows($con);
						$all_id_array = array();
						while ($row = mysqli_fetch_assoc($result))
						{
							array_push($all_id_array, $row['id']);
						}

						$absent_array = array('0' => '');
						$absent_array = array_diff($all_id_array,$string_ids);
						foreach($absent_array as $key => $value)
						{
						  	$query = "SELECT * FROM userinfo where id='$value' AND role='Student' AND university='$at_university' AND course='$at_course' AND session='$at_session'";
							$result = mysqli_query($con,$query);
							$rows = mysqli_affected_rows($con);

							if($rows == 0)
							{
								echo '<tr class="danger"><td>everyone is present, nice guys!</td></tr>';
							}

							while ($row = mysqli_fetch_assoc($result))
							{
								echo '<tr class="danger"><td>'.$row['id'].'</td>
								<td>'.$row['name'].'</td></tr>';
							}
						}
						?>
					</table>
				</div>
			</div>
		<?php
		}
	}
	else
	{
		echo '<div class="text-center alert alert-info col-md-offset-4 col-md-4"><p><b>Attendance is not updated for this session, Please contanct your Teacher or Admin for attendance!</b></p></div>';
		echo '<script>setTimeout(function () { window.location.href = "attendance.php";}, 2000);</script>';
	}

	return false;
}

/*******************************
* select details for attendance
*******************************/
function role_attendance($key,$work)
{
	global $con;
	
	if(isset($_POST['role_attendance']))
	{
		$at_course=$_POST['course'];
		$at_university=$_POST['university'];
		$at_session=$_POST['session'];
		if($work == 'fill')
		{
			echo '<script>setTimeout(function () { window.location.href = "manage_attendance.php?key='.$key.'&work='.$work.'&course='.$at_course.'&university='.$at_university.'&session='.$at_session.'";}, 100);</script>';
		}
		else
		{
			echo '<script>setTimeout(function () { window.location.href = "view_attendance.php?key='.$key.'&work='.$work.'&course='.$at_course.'&university='.$at_university.'&session='.$at_session.'";}, 100);</script>';
		}
		
	}
	return false;
}


/*******************************
 * submit attendace in database.
 *******************************/

function do_attendance($key,$at_course,$at_university,$at_session)
{
	global $con;

	if(isset($_POST['submit_attendance']))
	{
		
		$query = "SELECT session_id FROM attendance WHERE session_id='$key' AND session='$at_session' AND university='$at_university' AND course='$at_course'";
		$result = mysqli_query($con,$query);
		$rows = mysqli_affected_rows($con);
		if($rows == 1)
		{
			echo '<div class="text-center alert alert-warning col-md-offset-4 col-md-4"><p><b>Attendance Already added!</b></p></div>';
			echo '<script>setTimeout(function () { window.location.href = "attendance.php";}, 1000);</script>';
			exit();
		}
		
		$string_ids = serialize($_POST['checkbx']);

		$query = "INSERT into attendance (session_id, session, university, course, id_array) VALUES ('$key', '$at_session', '$at_university', '$at_course', '$string_ids')";
		$result = mysqli_query($con,$query);
		echo mysqli_error($con);
		$rows = mysqli_affected_rows($con);

		if($rows == 1)
		{
			echo '<div class="text-center alert alert-success col-md-offset-4 col-md-4"><p><b>Success! Attendance updated!</b></p></div>';
			echo '<script>setTimeout(function () { window.location.href = "attendance.php";}, 1000);</script>';
		}
		else
		{
			echo '<div class="text-center alert alert-danger col-md-offset-4 col-md-4"><p><b>error while updating attendance, try again</b></p></div>';
			echo '<script>setTimeout(function () { window.location.href = "attendance.php";}, 1000);</script>';
		}

	}
	return false;
}

/*******************************
 * Display Notice board.
 *******************************/

function show_notice($role)
{
	global $con;
	$query = "SELECT * FROM notice ORDER by date DESC";
	$result = mysqli_query($con,$query);
	$rows = mysqli_affected_rows($con);

	if($rows == 0)
	{
		echo '<div class="text-center alert alert-info col-md-offset-4 col-md-4"><p><b>no notice posted yet!</b></p></div>';
		exit();
	}
	
	$select = 1;
	while($row = mysqli_fetch_assoc($result))
	{
		if($select%2 == 1)
		{
			$css = 'panel-teal';
		}
		else
		{
			$css = 'panel-orange';
		}
		?>

		<div class="col-md-4">
			<div class="panel <?php echo $css; ?>">
			<div class="panel-heading dark-overlay"><?php echo $row['title']; ?></div>
				<div class="panel-body">
					<p>
					<b>Date:</b> <small><?php echo date('jS M Y H:i', strtotime($row['date'])); ?></small><br>
					<?php echo $row['description']; ?>
					</p>
				</div>
				<?php
					if($role == 'Admin' || $role == 'Teacher' || $role == 'Teacher')
	        		{
	        			echo '<div class="panel-footer"><a class="btn btn-primary btn-sm" href="edit_notice.php?notice_id='.$row['notice_id'].'">Edit</a> <a class="btn btn-danger btn-sm pull-right" href="delete_notice.php?notice_id='.$row['notice_id'].'">Delete</a></div>';
	        		}
				?>
			</div>
		</div>
		<?php
		$select++;
	}

	return false;
}

/*******************************
 * Add new Notice.
 *******************************/

function add_notice()
{
	global $con;
	if (isset($_POST['add_notice'])) 
	{
		$name = $_POST['name'];
		$name = stripslashes($name);
		$description = $_POST['description'];
		$description = stripslashes($description);
		$date = $_POST['date'];

		$query = "INSERT into notice (title,  description, date) VALUES ('$name',  '$description', '$date')";
		$result = mysqli_query($con,$query);
		$rows = mysqli_affected_rows($con);
		if($rows == 1)
		{
			echo '<div class="text-center alert alert-success bg-success col-md-offset-4 col-md-4" role="alert" style="color: #fff;"></b>Success! Notice Added</b></div>';
			echo '<script>setTimeout(function () { window.location.href = "notice.php";}, 1000);</script>';
		}
		else
		{
			echo '<div class="text-center alert alert-success bg-success col-md-offset-4 col-md-4" role="alert" style="color: #fff;"><b>error while adding notice</b></div>';
			echo '<script>setTimeout(function () { window.location.href = "notice.php";}, 1000);</script>';
		}
	}

	return false;
}

/*******************************
 * delete notice.
 *******************************/

function delete_notice($notice_id,$role)
{
	global $con;
	$notice_id = $notice_id;
	$role = $role;

	if(isset($_POST['yes']))
	{
		$query = "DELETE from notice where notice_id='$notice_id'";
		$result = mysqli_query($con,$query);
		$rows = mysqli_affected_rows($con);
		echo mysqli_error($con);
		if($rows == 1)
		{
			echo '<div class="text-center alert alert-success col-md-offset-4 col-md-4"><p><b>Success! Notice removed</b></p></div>';
			echo '<script>setTimeout(function () { window.location.href = "notice.php";}, 1000);</script>';
		}
		else
		{
			echo '<div class="text-center alert alert-danger col-md-offset-4 col-md-4"><p><b>error while removing notice, try again</b></p></div>';
			echo '<script>setTimeout(function () { window.location.href = "notice.php";}, 1000);</script>';
		}
	}
	
	return false;
}

/*******************************
 * edit notice information.
 *******************************/

function edit_notice($notice_id,$role)
{
	global $con;
	$role = $role;

	if (isset($_POST['edit_notice']))
	{
		$name = $_POST['name'];
		$name = stripslashes($name);
		$description = $_POST['description'];
		$description = stripslashes($description);
		$date = $_POST['date'];
		
		$query = "UPDATE notice SET title='$name', description='$description', date='$date' WHERE notice_id='$notice_id'";
		$result = mysqli_query($con,$query);
		$rows = mysqli_affected_rows($con);
		if($rows == 1)
		{
			echo '<div class="text-center alert alert-success bg-success col-md-offset-4 col-md-4" role="alert" style="color: #fff;"></b>Success! Notice Edited</b></div>';
			echo '<script>setTimeout(function () { window.location.href = "notice.php";}, 1000);</script>';
		}
		else
		{
			echo '<div class="text-center alert alert-danger bg-danger col-md-offset-4 col-md-4" role="alert" style="color: #fff;"></b>error while editing notice</b></div>';
			echo '<script>setTimeout(function () { window.location.href = "notice.php";}, 1000);</script>';
		}
	}

	return false;
}

/*******************************
 * starter for every page.
 *******************************/

function starter($id,$name,$role,$pic,$last_login,$total_members,$core_members,$total_sessions,$completed_sessions)
{
	?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>C-Mate - Dashboard</title>
<link rel='shortcut icon' href='favicon.ico' type='image/x-icon'/ >
<link href="css/pace-theme-corner-indicator.css" rel="stylesheet">
<script src="js/pace.min.js"></script>
<script>pace.start();</script>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link href="css/styles.css" rel="stylesheet">
<script src="https://use.fontawesome.com/c250a4b18e.js"></script>
<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
</head>
<body>
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<b><a class="navbar-brand" href="home.php"><span>C-</span>Mate</a></b>
				<ul class="user-menu">
					<li class="dropdown pull-right">
						<a><img src="<?php echo $pic; ?>" class="img-responsive img-circle img-thumbnail" height="35px" width="35px"> <b id="mobhide"><?php echo $name; ?></b></a> <a class="dropdown-toggle" data-toggle="dropdown"><div class="btn btn-xs btn-info" id="mobhide"><?php echo $role; ?></div><span class="caret"></span></a>

						<ul class="dropdown-menu" role="menu">
							<li><a href="update_pic.php"><i class="fa fa-user" aria-hidden="true"></i> Change Profile Pic</a></li>
							<li><a href="edit_personal.php?user_id=<?php echo $id; ?>"><i class="fa fa-cog" aria-hidden="true"></i> Personal Information</a></li>
							<li><a href="user_settings.php?user_id=<?php echo $id; ?>"><i class="fa fa-cog" aria-hidden="true"></i> Change Password</a></li>
							<li><a href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a></li>
						</ul>
					</li>
				</ul>
			</div>			
		</div><!-- /.container-fluid -->
	</nav><br>
		<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<form role="search" action="search.php" method="post">
			<div class="form-group">
				<input type="text" name="term" class="form-control" placeholder="Search" required>
			</div>
		</form>
		<ul class="nav menu">
			<li><a href="home.php"><i class="fa fa-tachometer" aria-hidden="true"></i>
 <b>Dashboard</b></a></li>

			<li><a href="blog-home.php"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> <b>Blog</b></a></li>
			
			<li><a href="gallery.php"><i class="fa fa-picture-o" aria-hidden="true"></i> <b>Gallery</b></a></li>

			<li><a href="notice.php"><i class="fa fa-sticky-note-o" aria-hidden="true"></i> <b>Notice</b></a></li>

			<li><a href="attendance.php"><i class="fa fa-line-chart" aria-hidden="true"></i> <b>Attendance</b></a></li>

			<?php if($role == 'Admin' || $role == 'Technical'){
				echo '<li><a href="manage_members.php"><i class="fa fa-users" aria-hidden="true"></i> <b>Members</b></a></li>';
			} ?>
			
			<li><a href="schedule.php"><i class="fa fa-calendar" aria-hidden="true"></i> <b>Sessions</b></a></li>

			<li role="presentation" class="divider"></li>
			<li><a style="color: #000;"><i class="fa fa-clock-o" aria-hidden="true"></i> <b>last login</b><br><?php echo $last_login; ?></a></li>
			<li role="presentation" class="divider"></li>
		</ul>
		<div class="text-center" style="margin-top: 50px; color: #000;"><b>Made By <a href="team_details.php" >Best of Best</a> Team</b></div>
	</div><!--/.sidebar-->
	
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
	<?php
	return false;
}

function at_bottom()
{
	?>
	</div>	<!--/.main-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="css/DateTimePicker.min.css" />
<script type="text/javascript" src="js/DateTimePicker.min.js"></script>
<!-- include summernote css/js-->
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.css" rel="stylesheet">
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.js"></script>
	<script>
		$(document).ready(function()
		{
		    $("#dtBox").DateTimePicker();
			$('.menu').on("click",".menu",function(e){ 
  			e.preventDefault(); // cancel click
  			var page = $(this).attr('href');   
  			$('.menu').load(page);
			});
			$('#content').summernote({
    			height: 350,
   			 });
		});
	</script>
	<script>
		
		!function ($) {
		    $(document).on("click","ul.nav li.parent > a > span.icon", function(){          
		        $(this).find('em:first').toggleClass("glyphicon-minus");      
		    }); 
		    $(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
		}(window.jQuery);

		$(window).on('resize', function () {
		  if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
		})
		$(window).on('resize', function () {
		  if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
		})
	</script>
</body>
</html>
	<?php
	return false;
}

/**********************************************************************************
*****************************   Blog functions    *********************************
**********************************************************************************/

function show_posts($role,$session_name)
{
	global $con;
	$query = "SELECT * FROM blog_posts ORDER BY id DESC";
	$result = mysqli_query($con,$query);

	if(mysqli_num_rows($result) > 0)
	{
		$select = 1;
		while($row = mysqli_fetch_assoc($result))
		{
			if($select%2 == 1)
			{
				$css = 'panel-primary';
			}
			else
			{
				$css = 'panel-info';
			}
		?>
		<div class="col-lg-5">
			<div class="panel <?php echo $css; ?>">
			<div class="panel-heading">
			<?php echo $row['postTitle']; ?>
			</div>
			<div class="panel-body">
			<p>Posted by <b><?php echo $row['auther']; ?></b> on <b><?php echo date('jS M Y H:i:s', strtotime($row['post_date'])); ?></b> in 
			<a href="viewbycat.php?cat=<?php echo $row['catinfo']; ?>"><?php echo $row['catinfo']; ?></a>
				<br><br>
			    <p><?php echo $row['description']; ?></p>
			    </div>               
			    <div class="panel-footer">
			    <?php
			    	if($session_name == $row['auther'] || $role == 'Admin' || $role == 'Technical')
			    	{?>
			    		<a class="btn btn-warning" href="edit-post.php?id=<?php echo $row['id']; ?>&title=<?php echo $row['postTitle']; ?>">Edit</a>
			    		<a class="btn btn-danger" href="delete-post.php?id=<?php echo $row['id']; ?>&title=<?php echo $row['postTitle']; ?>">Delete</a> 
			    	<?php }
			   	?>
			    <a class="btn btn-primary" href="viewpost.php?id=<?php echo $row['id']; ?>&title=<?php echo $row['postTitle']; ?>">Read More</a>      
			    </div></div></div>
			    <?php
			    $select++;
		} // Post list while closed.		

	} // Post list if closed.
	else
	{
		echo '<div class="alert bg-warning text-center col-md-offset-4 col-md-4 col-sm-12"><span><h4>no posts found, visit after sometime!</h4></span></div>';
	}
	return false;
}

function new_post()
{
	global $con;

	$auther = $_SESSION['email'];

	if(isset($_POST['publish'])) 
	{

		$postTitle = $_POST['postTitle'];
		$postTitle = stripslashes($postTitle);
		$postTitle = mysqli_real_escape_string($con,$postTitle);

		$description = $_POST['description'];
		$description = stripslashes($description);
		$description = mysqli_real_escape_string($con,$description);

		$content = $_POST['content'];
		$content = stripslashes($content);
		$content = mysqli_real_escape_string($con,$content);

		$catvalue = $_POST['cats'];
		$catvalue = stripslashes($catvalue);

		$query = "INSERT INTO blog_posts (id, postTitle, description, content, post_date, auther, catinfo) VALUES (NULL, '$postTitle', '$description', '$content', NOW(), '$auther','$catvalue')";
		mysqli_query($con,$query);
		
		$rows = mysqli_affected_rows($con);

		if($rows == 1)
		{
			echo '<div class="text-center alert bg-success col-md-offset-4 col-md-4" role="alert"><span>Success! Post Published</span></div>';
			echo '<script>setTimeout(function () { window.location.href = "blog-home.php";}, 1000);</script>';
		}
		else
		{
			echo '<div class="text-center alert bg-danger col-md-offset-4 col-md-4" role="alert"><span>Sorry, error while publishing post, try again</span></div>';	
			echo '<script>setTimeout(function () { window.location.href = "blog-home.php";}, 1000);</script>';
		}

	}

	return false;
}

function edit_post($post_id)
{
	global $con;
	if (isset($_POST['update'])) 
	{
		$postTitle = $_POST['postTitle'];
		$postTitle = stripslashes($postTitle);
		$postTitle = mysqli_real_escape_string($con,$postTitle);

		$description = $_POST['description'];
		$description = stripslashes($description);
		$description = mysqli_real_escape_string($con,$description);

		$content = $_POST['content'];
		$content = stripslashes($content);
		$content = mysqli_real_escape_string($con,$content);

		$catvalue = $_POST['cats'];
		$catvalue = stripslashes($catvalue);

		$query = "UPDATE blog_posts SET postTitle='$postTitle',description='$description',content='$content',post_date=NOW() ,catinfo='$catvalue' WHERE id='$post_id'";

		mysqli_query($con,$query);

		$rows = mysqli_affected_rows($con);

			if($rows == 1)
			{
				echo '<div class="text-center alert bg-success col-md-offset-4 col-md-4" role="alert"><span>Success! Post Updated</span></div>';
				echo '<script>setTimeout(function () { window.location.href = "blog-home.php";}, 1000);</script>';
			}
			else
			{
				echo '<div class="text-center alert bg-danger col-md-offset-4 col-md-4" role="alert"><span>Error, post updating failed, try again</span></div>';
				echo '<script>setTimeout(function () { window.location.href = "blog-home.php";}, 1000);</script>';
				
			}
	}
	return false;
}

function delete_post($post_id)
{
	global $con;

	if(isset($_POST['yes']))
	{
		$query = "DELETE FROM blog_posts WHERE id='$post_id'";
		mysqli_query($con,$query);
		$rows = mysqli_affected_rows($con);
		if($rows == 1)
		{
			echo '<div class="text-center alert bg-success col-md-offset-4 col-md-4" role="alert"><span>Success! Post Deleted</span></div>';
				echo '<script>setTimeout(function () { window.location.href = "blog-home.php";}, 1000);</script>';
		}
		else
		{
			echo '<div class="text-center alert bg-danger col-md-offset-4 col-md-4" role="alert"><span>Error, post updating failed, try again</span></div>';
			echo '<script>setTimeout(function () { window.location.href = "blog-home.php";}, 1000);</script>';
		}
	}
	return false;
}

function show_home_posts()
{
	global $con;

	$query = "SELECT * FROM blog_posts ORDER BY id DESC LIMIT 0,5";
	$result = mysqli_query($con,$query);

	if(mysqli_num_rows($result) > 0)
	{
		$select = 1;
		while($row = mysqli_fetch_assoc($result))
		{
			if($select%2 == 1)
			{
				$css = 'panel-teal';
			}
			else
			{
				$css = 'panel-orange';
			}
			?>

			<div class="col-lg-4">
				<div class="panel <?php echo $css; ?>">
				<div class="panel-body">
				<a href="viewpost.php?id=<?php echo $row['id']; ?>&title=<?php echo $row['postTitle']; ?>" style="color: #fff;">
				<h3 style="color: #fff;"><?php echo $row['postTitle']; ?></h3>
				<a href="viewpost.php?id=<?php echo $row['id']; ?>&title=<?php echo $row['postTitle']; ?>" style="color: #fff;">
				<p>Posted by <b><?php echo $row['auther']; ?></b> on <b><?php echo date('jS M Y H:i:s', strtotime($row['post_date'])); ?></b> in 
				<b><a style="color: #fff;" href="viewbycat.php?cat=<?php echo $row['catinfo']; ?>"><?php echo $row['catinfo']; ?></a></b></p>
			    
			    <p><a style="color: #fff;" href="viewbycat.php?cat=<?php echo $row['catinfo']; ?>"><?php echo $row['description']; ?></a></p>
			    </a>
			    </a>
			    </div>               
			    </div>
			</div>
			    <?php
			    $select++;
		} // Post list while closed.		

	} // Post list if closed.
	else
	{
		echo '<div class="alert bg-warning text-center col-md-offset-4 col-md-4 col-sm-12"><span><h4>no posts found, visit after sometime!</h4></span></div>';
	}

	return false;
}