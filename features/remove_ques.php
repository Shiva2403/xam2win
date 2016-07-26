<?php
	include ('../lib/configure.php');
	session_start();
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="icon" href="../images/book.png" type="image/gif" sizes="16x16"> 
	<title>Remove Questions</title>
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
Delete Record:-
</div>

<?php

	if(isset($_POST['confirm']) && isset($_POST['case'])) {
		$count=0;
		if( !isset($_POST['case']) || !is_array($_POST['case']) ) {
		?><script>alert("An error has occurred while processing your request");</script> 
		<?php
		}
		else {
		$delete = $_POST['case'];
		$flag=true;
		foreach ($delete as $val) {
			$question = explode("!+!", $val);
			$sql= "DELETE FROM questions WHERE Question='{$question[0]}'";
			$result=mysqli_query($conn, $sql);
			if($result) {
					$sql= "DELETE FROM questions WHERE Question='{$question[0]}'";
					$result=mysqli_query($conn, $sql);
			}
			else {$flag=false;break;}
			$count++;
		}
		if ($flag) {
			?><script>alert("The <?php echo $count ;?> records have been deleted successfully.");</script> <?php
		} else {
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
			<th>Question</th>
			<th>Opt1</th>
			<th>Opt2</th>
			<th>Opt3</th>
			<th>Opt4</th>
			<th>Answer</th>
		</tr>
	</thead>	
	<tbody>
	
		<?php
			$result = mysqli_query($conn, "SELECT * from questions");
			$cnt=0;
			while($row = mysqli_fetch_array($result)) {
			$cnt++;
		?>
		<tr>
				<td><center><input type="checkbox" class="case" name="case[]" value="<?php echo $row['Question']; ?>" ></center></td>  <!-- Concatenating id + dependent sice only one value is passed.  -->
				<td><center><?php echo $row['Question'];?></center></td>
				<td><center><?php echo $row['Opt1'];?></center></td>
				<td><center><?php echo $row['Opt2'];?></center></td>
				<td><center><?php echo $row['Opt3'];?></center></td>
				<td><center><?php echo $row['Opt4'];?></center></td>
				<td><center><?php echo $row['Answer'];?></center></td>
			</form>
		</tr>
		<?php } ?>
		
	</tbody>
</div>
</body>

</html>
