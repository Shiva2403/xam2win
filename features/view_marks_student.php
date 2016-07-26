<?php
	include ('../lib/configure.php');
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
	<title>View Marks</title>
<link href="../css/record_tables.css" rel="stylesheet" type="text/css"> 
</head>
<body>
<div id="datatable3">
	<?php
	if (isset($_POST['submit'])) 
	{
		$sid=$_POST['Student_Id'];
		if($sid == "") 
		{
			echo '<script>alert("You must enter your Student ID.")</script>';
		}
		$query="SELECT mark FROM marks WHERE Student_Id='$sid';";
		$result=mysqli_query($conn,$query);
		if ($row=mysqli_fetch_array($result)) 
		{
			echo "Your Score : ";
			echo $row['mark'];
		}
	}
	?>
</div>
<input type="button" class="home" value="Home" onclick="location.href='../student_home.php'">
<input type="button" class="logout" value="logout" onclick="location.href='../lib/logout.php'">
<div id="view_mark_form">
<form action="" method="post">
	Student ID: <input name="Student_Id" type="text" class ="input_class_stud" autocomplete="on">
	<input type="submit" name="submit" value="Confirm">
</form>
</div>
</body>