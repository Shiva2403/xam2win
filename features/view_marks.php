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
<input type="button" class="home" value="Home" onclick="location.href='../home.php'">
<input type="button" class="logout" value="logout" onclick="location.href='../lib/logout.php'">
<div id="table1">
View Marks:-	
</div>
<div id="datatable3">
	<table id="data" class="display">
		<tbody>
			<?php
				$query="SELECT * FROM marks;";
				$result=mysqli_query($conn,$query);
				while($row=mysqli_fetch_array($result)) {
			?>
			<form action="" method="post">
				<tr>
					<td><?php echo $row['Student_Id'];?></td>
					<td><?php echo $row['Name'];?></td>
					<td><?php echo $row['mark'];?></td>
				</tr>
			</form>
			<?php } ?>
		</tbody>
	</table>
</div>
</body>
</html>