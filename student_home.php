<!--
	Student Home Page
-->

<?php
	include("lib/configure.php");
	session_start();
	if(isset($_SESSION['login_user']))
	{
		if($_SESSION['login_user']=="admin")
		{
			header("location: home.php");
		}
	}
	else
	{
		header("location: index.php");
	}

	$user=$_SESSION['login_user'];

	$sql="SELECT * FROM member WHERE username='$user'";
	$result=mysqli_query($conn,$sql);
	$row=mysqli_fetch_array($result);
	$name=$row["username"]
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
	<title>Student Home Page</title>
<link href="css/student_home.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="student_detail">
<input type="button" class="answer_questions" value="Answer Questions" onClick="location.href='features/answer.php'">
<input type="button" class="view_marks" value="View Marks" onClick="location.href='features/view_marks_student.php'">
</div>
<input type="button" class="logout" value="logout" onClick="location.href='lib/logout.php'">
</body>
</html>