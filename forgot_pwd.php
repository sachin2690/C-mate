<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>C-Mate</title>
<link rel='shortcut icon' href='favicon.ico' type='image/x-icon'/ >
<link href="css/pace-theme-corner-indicator.css" rel="stylesheet">
<script src="js/pace.min.js"></script>
<script>pace.start();</script>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link href="css/styles.css" rel="stylesheet">
<style>
*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Poppins', sans-serif;
}
html,body{
  display: grid;
  height: 100%;
  width: 100%;
  place-items: center;
  background: #f2f2f2;
  /* background: linear-gradient(-135deg, #c850c0, #4158d0); */
}
::selection{
  background: #4158d0;
  color: #fff;
}
.wrapper{
  width: 380px;
  background: #fff;
  border-radius: 15px;
  box-shadow: 0px 15px 20px rgba(0,0,0,0.1);
  margin-bottom:100px;
}
.wrapper .title{
  font-size: 35px;
  font-weight: 600;
  text-align: center;
  line-height: 100px;
  color: #fff;
  user-select: none;
  border-radius: 15px 15px 0 0;
  background: linear-gradient(-135deg, #c850c0, #4158d0);
}
.wrapper form{
  padding: 10px 30px 50px 30px;
}
.wrapper form .field{
  height: 50px;
  width: 100%;
  margin-top: 35px;
  position: relative;
}
.wrapper form .field input{
  height: 100%;
  width: 100%;
  outline: none;
  font-size: 17px;
  padding-left: 20px;
  border: 1px solid lightgrey;
  border-radius: 25px;
  transition: all 0.3s ease;
}
.wrapper form .field input:focus,
form .field input:valid{
  border-color: #4158d0;
}
.wrapper form .field label{
  position: absolute;
  top: 50%;
  left: 20px;
  color: #999999;
  font-weight: 400;
  font-size: 17px;
  pointer-events: none;
  transform: translateY(-50%);
  transition: all 0.3s ease;
}
form .field input:focus ~ label,
form .field input:valid ~ label{
  top: 0%;
  font-size: 16px;
  color: #4158d0;
  background: #fff;
  transform: translateY(-50%);
}
form .content{
  display: flex;
  width: 100%;
  height: 50px;
  font-size: 16px;
  align-items: center;
  justify-content: space-around;
}
form .content .checkbox{
  display: flex;
  align-items: right;
  justify-content: left;
}
form .content input{
  width: 15px;
  height: 15px;
  background: red;
}
form .content label{
  color: #262626;
  user-select: none;
  padding-left: 5px;
}
form .content .pass-link{
  color: "";
}
form .field input[type="submit"]{
  color: #fff;
  border: none;
  padding-left: 0;
  margin-top: -10px;
  font-size: 20px;
  font-weight: 500;
  cursor: pointer;
  background: linear-gradient(-135deg, #c850c0, #4158d0);
  transition: all 0.3s ease;
}
form .field input[type="submit"]:active{
  transform: scale(0.95);
}
form .signup-link{
  color: #262626;
  margin-top: 20px;
  text-align: center;
}
form .pass-link a,
form .signup-link a{
  color: #4158d0;
  text-decoration: none;
}
form .pass-link a:hover,
form .signup-link a:hover{
  text-decoration: underline;
}
#cl{
	height: 35px;
    width: 25%;
    margin-top:30px;
	background: transparant;
	outline:none;
	font-size 35px;
	border-radius:8px;
	border:1px solid black;
	padding-left:17px;
	padding-top:5px;


}
#cl:hover{
	background: linear-gradient(-135deg, #c850c0, #4158d0);
}

</style>
</head>
<?php
	session_start();
	require_once('funs.php');
?>
<body>
<div class="wrapper">
   <div class="title">C-Mate</div>
	<div class="error"><?php forgot(); ?></div>
		
			
				<div class="panel-heading">Forgot Password</div>
				

				<form class="form-signin" method="post" action="">
					<label for="name">ID</label>
					<input type="text" name="id" placeholder="Id" id="name" class="form-control" required><br>
					<label for="name">Email</label>
					<input type="mail" name="email" placeholder="Email" id="email" class="form-control" required><br>	
					<label for="name">New Password</label>
					<input type="password" name="new_pwd" placeholder="New Password" id="new_pwd" class="form-control" required><br>
					<label for="name">Confirm Password</label>
					<input type="password" name="cnf_pwd" placeholder="Confirm Password" id="cnf_pwd" class="form-control" required><br>
				
					<button class="btn btn-primary" name="change" type="submit" id="change">Change</button>&nbsp;&nbsp;
					<a href="index.php" class="btn btn-default" >Cancel</a>				
				</form>
			</div>
			
				</div>
			</div>

</body>
</html>
		
	