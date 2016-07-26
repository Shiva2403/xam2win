<?php
	include ('../lib/configure.php');
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
	<title>Examination On Progress</title>
<link href="../css/record_tables.css" rel="stylesheet" type="text/css">
</head>
<body>
	<?php
	$flag=false;
	if (isset($_POST['submit'])) 
	{
		$sid=$_POST['Student_Id'];
		if($sid == "") 
		{
			echo '<script>alert("You must enter your Student ID.")</script>';
		}
		$sql="SELECT Name FROM student WHERE Student_Id = '$sid';";
		$query=mysqli_query($conn, $sql);
		if($query) 
		{
			$row=mysqli_fetch_array($query);
			$name=$row['Name'];
			$query="SELECT * FROM questions;";
			$result=mysqli_query($conn,$query);
			$_SESSION['mark']=0;
			while($row=mysqli_fetch_array($result)) 
			{
				$temp_id=$row['Q_Id']."q";
				if ($_POST[$temp_id] == $row['Answer']) 
				{
					$_SESSION['mark']++;
				}
				else
				{
					$_SESSION['mark']--;
				}
			}
			$sql="INSERT INTO marks VALUES ('{$sid}', '{$name}', '{$_SESSION['mark']}')";
			$query=mysqli_query($conn,$sql);
			if(!$query) 
			{
				?>
				<script>alert("Mark was not added!!");</script>
				<?php
			}
			else 
			{
				$flag=true;
				?>
				<script>alert("Congrats!! You have completed the test.");</script>
				<?php
			}
		}
		else 
		{
			echo '<script>alert("Mark could not be added.");</script>';
		}
	}
	if ($flag==true) 
	{
		header("location: ../student_home.php");
	}
	?>

	<input type="button" class="home" value="Home" onClick="location.href='../student_home.php'">
	<div id="datatable3">
	<table id="data" class="display">
		<tbody>
			<?php
			
				$query="SELECT * FROM questions;";
				$result=mysqli_query($conn,$query);
				while($row=mysqli_fetch_array($result)) 
				{
					?>
					<form action="" method="post">
					<tr>
						<td><?php echo $row['Question'];?></td>
					</tr>
					<tr>
						<td><input type="radio" name='<?php echo $row['Q_Id']."q";?>' value="<?php echo $row['Opt1'];?>"><?php echo $row['Opt1'];?></td>
						<td><input type="radio" name='<?php echo $row['Q_Id']."q";?>' value="<?php echo $row['Opt2'];?>"><?php echo $row['Opt2'];?></td>
					</tr>
					<tr>
						<td><input type="radio" name='<?php echo $row['Q_Id']."q";?>' value="<?php echo $row['Opt3'];?>"><?php echo $row['Opt3'];?></td>
						<td><input type="radio" name='<?php echo $row['Q_Id']."q";?>' value="<?php echo $row['Opt4'];?>"><?php echo $row['Opt4'];?></td>
					</tr>
					<?php 
				} 
				?>
		</tbody>
	</table>
	</div>
	<div id="view_id">
	Student ID: <input name="Student_Id" type="text" class ="input_class_stud" autocomplete="on">
	<input type="submit" name="submit" value="Confirm">
	</div>
	</form>

</body>
</html>