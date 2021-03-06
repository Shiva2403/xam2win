<?php
	include ('../lib/configure.php');
	session_start();
	if(isset($_SESSION['login_type']))
	{
		if ($_SESSION['login_type']=="admin")
		{
			header("location: ../home.php");
		}
	}
	else 
	{
		header("location: ../index.php");
	}

	$user = $_SESSION['login_user'];
	$sql="SELECT * FROM users WHERE username='$user';";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_array($result);
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Update Admin Profile</title>
<link href="../css/update_profile.css" rel="stylesheet" type="text/css">

<script type="text/javascript">
	function validate(form)
	{
		
		if (form.username.value == "")
		{
			alert("Enter a username to save changes");
			form.username.focus();
			window.scrollByLines(-8);
			form.username.value = "";
			return false;
			
		}
		if (form.new_pw.value != form.retype.value)
		{
			alert("Passwords don't match");
			form.new_pw.focus();
			form.new_pw.value = "";
			form.retype.value="";
			return false;
		}
		if (form.pw.value == "")
		{
			alert("You must enter your current password to update changes");
			form.pw.focus();
			return false;
		} 

		return true;
	}
	
	<?php if(isset($_GET['q']))
	{
		?>
		alert("<?php echo $_GET['q'] ?>");
		<?php
	}
	?>
</script>

</head>

<body>
<input type="button" class="home" value="" onClick="location.href='../home.php'">
<input type="button" class="logout" value="logout" onClick="location.href='../lib/logout.php'">
<div id="table1">
	Update Profile
	<form action="update.php" method="post" name="fields" onsubmit="return validate(this);">
		<div class="input_area">
			<span>Name : </span><input name="name" type="text" class ="input_class_med" autocomplete="on" value="<?php echo $row['Name']; ?>" autofocus onfocus="var val=this.value; this.value=''; this.value= val;"> <br/>
			<span>Username : </span><input name="username" type="text" class ="input_class_med" autocomplete="on" value="<?php echo $row['UserName']; ?>"><br>
		</div>
		<p>Change Password</p>
		<div class="input_area">
			<span>New : </span><input name="new_pw" type="password" class ="input_class_med" autocomplete='off'><br/>
			<span>Retype :</span><input name="retype" type="password" class ="input_class_med"  autocomplete='off'><br>
		</div>
	
		<p>Change Security Questions</p>
		<div class="input_area">
			<span>Security Qn1 :</span><textarea name="sec_qn_1" cols="37" rows="13" onfocus="var val=this.value; this.value=''; this.value= val;"><?php echo $row['SecQn1']; ?></textarea><br>
			<span>Ans1 :</span><input name="ans1" type="password" class ="input_class_med" value="" autocomplete='off'><br>
			<span>Security Qn2 :</span><textarea name="sec_qn_2" cols="37" rows="13" onfocus="var val=this.value; this.value=''; this.value= val;"><?php echo $row['SecQn2']; ?></textarea><br/>
			<span>Ans2 :</span><input name="ans2" type="password" class ="input_class_med" value="" autocomplete='off'><br/><br/>

			<span style="color:skyblue">Enter Password to save changes <sup style="color:red">*</sup> </span>
			<br/>
			<input name="pw" type="password" class ="input_class_med" autocomplete='off'>
		</div>
		<input type="submit" name="submit" value="Save">
		<br/>
		<br/>
	</form>

</div>	

</body>
</html>