<?php
	include ('../lib/configure.php');
	session_start();
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="icon" href="../images/book.png" type="image/gif" sizes="16x16"> 
	<title>Add Student Record</title>
<link href="../css/add_student.css" rel="stylesheet" type="text/css">
</head>

<body>
<?php
	if (isset($_POST['submit'])) 
	{
		$sid=$_POST['Student_Id'];
		if($sid == "") 
		{
			echo '<script>alert("You must enter a Student ID.");window.location.assign("./add_studdent.php");</script>';
		}
		else 
		{
			if($_POST['Name'] == "") 
			{	
				echo '<script>alert("You must enter a Student Name.");window.location.assign("./add_student.php");</script>';
			}
			else 
			{
				$sql="SELECT Name FROM student WHERE Student_Id = '$sid';";
				$query=mysqli_query($conn, $sql);
				if($query) 
				{
					$row=mysqli_fetch_array($query);
					$name=$row['Name'];
					if($name!=NULL && $_POST['Name']!= $name) 
					{
						echo '<script>alert("Student with same id and different name exists.");</script>';
					}
					else 
					{
						$sid=$_POST['Student_Id'];
						$name=$_POST['Name'];
						$sql="INSERT INTO student VALUES ('$sid', '$name');";
						$query=mysqli_query($conn,$sql);
						if(!$query) 
						{
							?>
							<script>alert("Student was not added!!");</script>
							<?php
						}
						else 
						{
							?>
							<script>alert("Student added success!!");</script>
							<?php
						}
					}
				}
				else 
				{
					echo '<script>alert("Student could not be added.");</script>';
				}
			}
		}
	}
?>	
	
<input type="button" class="home" value="Home" onClick="location.href='../home.php'">
<div id="add_student_form">
Add Student Details :-
<form action="" method="post">
	Student ID: <input name="Student_Id" type="text" class ="input_class_stud" autocomplete="on">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    Name: <input name="Name" type="text" class ="input_class_stud" autocomplete="on"><br>
    <input type="submit" name="submit" value="Confirm" >
</form>
</div>
<input type="button" class="logout" value="logout" onClick="location.href='../lib/logout.php'">
</body>
</html>