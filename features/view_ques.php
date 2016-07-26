<?php
	include ('../lib/configure.php');
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
	<title>View Questions</title>
<link href="../css/record_tables.css" rel="stylesheet" type="text/css"> 
</head>
<body>
<input type="button" class="home" value="Home" onclick="location.href='../home.php'">
<input type="button" class="logout" value="logout" onclick="location.href='../lib/logout.php'">
<div id="table1">
View Questions:-	
</div>
<div id="datatable3">
	<table id="data" class="display">
		<tbody>
			<?php
				if (isset($_GET['q']) && $_GET['q']!=NULL)     //what is q 
				{
					$question=$_GET['q'];
					$query="SELECT * FROM questions WHERE Question='$question'";
					$result=mysqli_query($conn,$query);
				}
				else
				{
					$query="SELECT * FROM questions";
					$result=mysqli_query($conn,$query);
				}
				while($row=mysqli_fetch_array($result)) {
			?>
			<form action="" method="post">
				<tr>
					<td><?php echo $row['Question'];?></td>
				</tr>
				<tr>
					<td><?php echo $row['Opt1'];?></td>
					<td><?php echo $row['Opt2'];?></td>
				</tr>
				<tr>
					<td><?php echo $row['Opt3'];?></td>
					<td><?php echo $row['Opt4'];?></td>
				</tr>
				<tr>
					<td><?php echo $row['Answer'];?></td>
				</tr>
			</form>
			<?php } ?>
		</tbody>
	</table>
</div>
</body>
</html>