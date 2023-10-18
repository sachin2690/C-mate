<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>C-Mate</title>
<link rel='shortcut icon' href='favicon.ico' type='image/x-icon'/ >
<link href="css/pace-theme-corner-indicator.css" rel="stylesheet">
<script src="js/pace.min.js"></script>
<!-- <script>pace.start();</script> -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link href="css/styles.css" rel="stylesheet">
<style>

@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');
*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Poppins',sans-serif;
}
body{
  height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 10px;
  background: #f2f2f2;
}
.container{
  max-width: 700px;
  width: 100%;
  height:90vh;
  background-color: #fff;
  padding: 25px 30px;
  border-radius: 5px;
  box-shadow: 0 5px 10px rgba(0,0,0,0.15);

}
.container .title{
  font-size: 25px;
  font-weight: 500;
  position: relative;
  top:10px;
}
.container .title::before{
  content: "";
  position: absolute;
  left: 0;
  bottom: 0;
  height: 3px;
  width: 30px;
  border-radius: 5px;
  background: linear-gradient(135deg, #71b7e6, #9b59b6);
}
.content form {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  margin: 20px 0 12px 0;
}
form .input-box{
  margin-bottom: 15px;
  margin-left:20px;
  width: 68%;
  
}
form .input-box span.details{
  display: block;
  font-weight: 500;
  margin-bottom:3px;
}
#de{
  display: block;
  font-weight: 500;
  margin-bottom:3px;
}
.input-box input{
  height:28px;
  width:60%;
  outline: none;
  font-size: 16px;
  border-radius:10px;
  padding-left: 15px;
  border: 1px solid #ccc;
  border-bottom-width: 2px;
  transition: all 0.3s ease;
}

.user-details .input-box input:focus,
.user-details .input-box input:valid{
  border-color: #9b59b6;
}
#gender-details{
  font-size: 15px;
  font-weight: 500;
  margin-left:10px;

 }

 form .button{
   height: 45px;
   margin: 35px 0
 }
 


#title2{
  font-size: 35px;
  font-weight: 600;
  text-align: center;
  line-height:70px;
  color: #fff;
  user-select: none;
  border-radius: 15px 15px 0 0;
  background: linear-gradient(-135deg, #c850c0, #4158d0);
}
.un{
   position: relative;
   weight:50px;
   margin-left:325px;
   margin-top:-405px;
}
.bu{
   margin-left:220px;
    position: fixed;
}
#sachin{
	margin-top:-25px;
	width:170%;
}

</style>

</head>
<?php
	session_start();
	require_once('funs.php');
?>
<body>
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
}

</script>

	
<div class="error"><?php signup(); ?></div>
	<div class="container">
		<div id="title2">C-Mate</div>
		<div class="title">Registration</div>
			<div class="content">
				<form class="" method="post" action="" onsubmit="return verify()">

				 <div class="input-box">
				    <span class="details">ID</span>
					<input type="text" name="id"  id="name" class="" required><br>
					
                 </div>
				    <div class="input-box">
					 <span class="details">Name</span>
					 <input type="text" name="name" placeholder="" id="naam" class="" required><br>
					 
                    </div>

					<div class="input-box">
					<span class="details">Email</span>
					 <input type="email" name="email" placeholder="" id="email" class="" required><br>
					
                    </div>
					<div class="input-box">
					<span class="details">Mobile</span>
					 <input type="tel" name="mobile" placeholder="" id="mobile" class="" required><br>
					 
                    </div> 

					<div class="input-box">
                    <span class="details">Password</span>
					<input type="password" name="password" placeholder="" id="password" class="" required><br>
					
                    </div>
					
					<div class="input-box" >
					 <span class="details">Confirm Password</span>
					 <input type="password" name="cpassword" placeholder="" id="cpassword" class="" required><br>
					 
                    </div>
					
                     </div>
					

				    <div class="un">
					 <?php
					
					    echo '<label for="name">Course</label>
					    <select class="form-control" name="course">
						<option value="">SELECT</option>
						<option name="BBA" value="BBA">BBA</option>
						   <option name="BCA" value="BCA">BCA</option>
						  <option name="BBM" value="BBM">BBM</option>
						   <option name="BScIT" value="BScIT">BScIT</option>
						   <option name="PGDM" value="PGDM">PGDM</option>
						   <option name="BCOM" value="BCOM">BCOM</option>
					     </select><br>';
						echo '<label for="name">University</label>
					   <select class="form-control" name="university">
						<option value="">SELECT</option>
						<option name="AKU" value="AKU">AKU</option>
						   <option name="PPU" value="PPU">PPU</option>
					   </select><br>';
					    echo '<label for="name">Session <small>starts in</small></label>
					    <select class="form-control" name="session">
						   <option value="">SELECT</option>
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
					
					  <?php
						echo '<label for="name">Role</label>
						<select class="form-control" name="role" required>
							<option value="">SELECT</option>
		    				<option name="Student" value="Student">Student</option>
						   	<option name="Teacher" value="Teacher">Teacher</option>
						  	<option name="Staff" value="Staff">Staff</option>	
		  				</select><br>';

						
					?>
					
					
					<div>
                    <label for="name">DOB</label>
					<input type="date" name="dob" placeholder="dd-mm-yyyy" id="dob" class="form-control" required>
                    </div>
					</div>
					<br>
					
					<div class= bu>

					<button class="btn btn-primary" name="signup" type="submit" id="signup">SignUp</button>&nbsp;
					<a href="index.php" class="btn btn-default" >Cancel</a>
					<div>
				</form>
			    
			
				
			</div>
    </div>
	
</body>
</html>