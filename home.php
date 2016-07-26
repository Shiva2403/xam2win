<!--
Admin Home Page
	1.Add questions to the examination database
	2.Remove questions from the examination database
	3.Update questions in the examination database
	4.View questions in the examination database
	5.Add students to the examination
	6.Remove students from the examination
	7.View marks of the students
-->

<?php
	session_start();
	include('lib/configure.php');
	if(isset($_SESSION['login_type'])) 
	{
		if($_SESSION['login_type']!="admin") 
		{
			header("location: student_home.php");
		}
	}
	else 
	{
		header("location: index.php");
	}
	$min_qty=10;
?>

<!DOCTYPE html>
<html>
<head>
<link rel="icon" href="images/book.png" type="image/gif" sizes="16x16">
	<title><?php echo $_SESSION['login_type']; ?> Home Page</title>
<link href="css/admin_home.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="button_table">
<table width="250" border="0" cellspacing="4" cellpadding="0">
  <tbody>
    <tr>
      <td>Examination</td>
      <td>Student</td>
    </tr>
    <tr>
      <td><input type="button" class="button" value="Add Questions" onClick="location.href='features/add_ques.php'"></td>
      <td><input type="button" class="button" value="Add Student" onClick="location.href='features/add_student.php'"></td>
    </tr>
    <tr>
      <td><input type="button" class="button" value="Remove Questions" onClick="location.href='features/remove_ques.php'"></td>
      <td><input type="button" class="button" value="Remove Student" onClick="location.href='features/remove_student.php'"></td>
    </tr>
    <tr>
      <td><input type="button" class="button" value="View Questions" onClick="location.href='features/view_ques.php'"></td>
      <td><input type="button" class="button" value="View Marks" onClick="location.href='features/view_marks.php'"></td>
    </tr>
  </tbody>
</table>
</div>

<input type="button" class="logout" value="logout" onClick="location.href='lib/logout.php'">
</body>
</html>	