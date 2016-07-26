<!--
Error if same question is added which is currently present in the database.
-->

<?php
	include('../lib/configure.php');
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
<link rel="icon" href="../images/book.png" type="image/gif" sizes="16x16">
	<title>Add Questions</title>
<link href="../css/record_tables.css" rel="stylesheet" type="text/css">
</head>
<body>
<input type="button" class="home" value="Home" onclick="location.href='../home.php'">
<input type="button" class="logout" value="logout" onclick="location.href='../lib/logout.php'">
<div id="table1">
Add Questions:-	

<?php
	if(isset($_POST['insert'])) 
	{
		if(($_POST['Question']!='')and($_POST['Opt1']!='')and($_POST['Opt2']!='')and($_POST['Opt3']!='')and($_POST['Opt4']!='')and($_POST['Answer']!=''))
		{
			$sql="INSERT INTO temp_questions VALUES ('{$_POST['Question']}','{$_POST['Opt1']}','{$_POST['Opt2']}','{$_POST['Opt3']}','{$_POST['Opt4']}','{$_POST['Answer']}')";
			if($conn->query($sql)==TRUE) 
			{
				$_SESSION['item']++;
				$_SESSION['temp_stat']=1;
			}
			else
			{?>
				<script>alert("Same question exists")</script>
				<?php
			}
		}
		else
		{
			echo "<script>alert('Question, Opt1, Opt2, Opt3, Opt4, Answer fields are required')</script>";
		}
	}
?>

<?php
	if(isset($_POST['confirm'])) 
	{
			//populating exam table
			$flag=true;
			$sql="SELECT * FROM temp_questions";
			$result=mysqli_query($conn,$sql);
			while ($row=mysqli_fetch_array($result)) 
			{
				$question = $row['Question'];
				$opt1 = $row['Opt1'];
				$opt2 = $row['Opt2'];
				$opt3 = $row['Opt3'];
				$opt4 = $row['Opt4'];
				$answer = $row['Answer'];
				$sql="SELECT * FROM questions WHERE 'Question'='{$question}'";
				$res=mysqli_query($conn,$sql);
				$r=mysqli_fetch_array($res);
				if($r==false)
				{
					$Q="INSERT INTO Questions(Question,Opt1,Opt2,Opt3,Opt4,Answer) VALUES ('{$question}', '{$opt1}', '{$opt2}', '{$opt3}', '{$opt4}', '{$answer}');";
					mysqli_query($conn,$Q);
				}
				else
				{
					$flag=false;
					?>
					<script>alert("Same question exists")</script>
					<?php
				}	
			}
			//removing temporary questions
			mysqli_query($conn,"DELETE FROM temp_questions");
			if($flag)
			{
				?>
				<script>alert("<?php echo $_SESSION['item']; ?> questions added to questions database.")</script>
				<?php
			}
		/*else
		{?>
			<script>alert("Question already exists")</script>
			<?php
		}*/
		$_SESSION['item']=0;
		$_SESSION['temp_stat']=0;
	}
?>


<form action="" method="post">
	<input type="submit" name="confirm" value="Confirm" class="button" id="confirm">
</form>

<form action="" method="post">
	<table cellspacing="7">
		<tbody>
			<tr>
				<td>Question:<input type="text" name="Question" size="50"></td>
			</tr>
			<tr>
				<td>Opt1:<input type="text" name="Opt1" size="30"></td>
				<td>Opt2:<input type="text" name="Opt2" size="30"></td>
			</tr>
			<tr>
				<td>Opt3:<input type="text" name="Opt3" size="30"></td>
				<td>Opt4:<input type="text" name="Opt4" size="30"></td>
			</tr>
			<tr>
				<td>Answer:<input type="text" name="Answer" size="30"></td>
				<th><input type="submit" name="insert" id="insert" value="Insert" class="button"></th>
			</tr>
		</tbody>
	</table>
</form>
</div>


<div id="datatable1">
	<table id="data" class="display">
		<tbody>
			<?php
				if (isset($_POST['delete']))
				{
					mysqli_query($conn,"DELETE FROM temp_questions WHERE 'Question'='{$_POST['Question']}';");
					$_SESSION['item']--;	
				}
				$query="SELECT * FROM temp_questions";
				$result=mysqli_query($conn,$query);
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
					<td><input type="hidden" name="Answer" value="<?php echo $row['Answer'];?>"><?php echo $row['Answer'];?></td>
				</tr>
			</form>
			<?php } ?>
		</tbody>
	</table>
</div>
</body>
</html>