<?php
	include ('../lib/configure.php');
	session_start();
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8"> 
	<title>Remove Student</title>
<link href="../css/record_tables.css" rel="stylesheet" type="text/css"> 

<script type="text/javascript">
$(function() {
	$("#selectall").change(function () {
		$(".case").prop('checked', $(this).prop("checked"));
	});
	$(".case").change(function() {
		if($(".case").length == $(".case:checked").length) {
			$("#selectall").prop('checked', 'checked');
		}
		else {
			$("#selectall").removeAttr("checked");
		}
	});
});
</script>

<script language="JavaScript" type="text/javascript">
$(document).ready(function(){
    $("#confiirm").click(function(e){
        if(!confirm('Are you sure you want to delete the selected records?')){
            e.preventDefault();
            return false;
        }
        return true;
    });
});
</script>
</head>

<body>
<input type="button" class="home" value="Home" onClick="location.href='../home.php'">
<input type="button" class="logout" value="logout" onClick="location.href='../lib/logout.php'">

<div id="table1">
Remove Student:-
</div>

<?php

	if(isset($_POST['confirm']) && isset($_POST['case'])) 
	{
		$count=0;
		if( !isset($_POST['case']) || !is_array($_POST['case']) ) 
		{
			?><script>alert("An error has occurred while processing your request");</script> 
			<?php
		}
		else 
		{
			$delete = $_POST['case'];
			$flag=true;
			foreach ($delete as $val) 
			{
				$student = explode("!+!", $val);
				$sql="DELETE FROM student WHERE Student_Id='{$student[0]}'";
				if ($conn->query($sql)==TRUE) {
					$count++;
					$flag = true;
				}
			}
			if ($flag) 
			{
				?><script>alert("The <?php echo $count ;?> records have been deleted successfully.");</script> <?php
			} 
			else 
			{
				?><script>alert("An error has occurred while processing your request.");</script> <?php
			}
		}
	}
?>

<form action="" method="post">
	<input type="submit" name="confirm" value="Confirm" class="button" id="confiirm">

<div id="datatable3">
<table id="data" class="display">
	<thead>
		<tr id="datatable2">		
			<th><input id="selectall" type="checkbox"></th>
			<th>Student ID</th>
			<th>Name</th>
		</tr>
	</thead>	
	<tbody>
	
		<?php
			$sql="SELECT * from student";
			$result = mysqli_query($conn, $sql);
			$cnt=0;
			while($row = mysqli_fetch_array($result)) 
			{
			$cnt++;
		?>
		<tr>
				<td><center><input type="checkbox" class="case" name="case[]" value="<?php echo $row['Student_Id']; ?>" ></center></td>  <!-- Concatenating id + dependent sice only one value is passed.  -->
				<td><center><?php echo $row['Student_Id'];?></center></td>
				<td><center><?php echo $row['Name'];?></center></td>
			</form>
		</tr>
		<?php } ?>
		
	</tbody>
</div>
</body>

</html>
