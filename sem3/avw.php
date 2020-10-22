<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<style>
table{
	border-collapse:collapse;
}
table,th,td
{
	border:1px solid black;
}
</style>
<body>
<?php
try
{
$dept="";
$sem="";
$sub="";
$pwd="";
 if(isset($_POST['dept']))
  {
	  $dept=$_POST['dept'];
  }
  if(isset($_POST['sem']))
  {
	  $sem=$_POST['sem'];
  }
  if(isset($_POST['sub']))
  {
	  $sub=$_POST['sub'];
  }
  if(isset($_POST['pass']))
  {
	  $pwd=$_POST['pass'];
  }
  $y=date('Y');
$table=$dept.$sem.$sub.$y;
$dir_path = "year".$y.$dept.$sem.$sub;
  if($dept==""||$sub==""||$sem==""||$pwd=="")
  {
	  echo "<script>
	alert('ENTER ALL THE DETAILS!');
	window.location.href='aview.php';
	</script>";
  }
  else{
	  if($pwd=="info123")
	  {
if(is_dir($dir_path))
{
    $files = scandir($dir_path);
	$db=mysqli_connect("localhost","root","","notes");
	$qry="select specification,file from ".$table;
	$result=mysqli_query($db,$qry);
	echo "<ul>";
	echo"<div class='container'><div class='table-responsive'><table class='table'>";
	
	 
		while($row=mysqli_fetch_assoc($result))
	{

			$pdf="year".$y.$dept.$sem.$sub."/".$row['file'];
			echo "<tr><td>".strtoupper($row['specification'])."</td>";
			echo "<td><a href='$pdf' target='_blank'>".$row['file']."</a></td>";
			echo"<td><a href='del.php?pdf=".$row['file']."'><span class='glyphicon glyphicon-trash'></span> DELETE <a></td></tr>";	
	}
            echo"</table></div></div>";
    }
else
	{
	echo "<script>
	alert('ERROR!');
	window.location.href='aview.html';
	</script>";
	}
	  }
	  else{
	  echo "<script>
	alert('INCORRECT PASSSWORD!');
	window.location.href='aview.html';
	</script>";
	  }
  }
  session_start();
  $_SESSION['dept']=$dept;
  $_SESSION['sem']=$sem;
  $_SESSION['sub']=$sub;
	  
}
catch(Exception $e)
{
	echo "Message:".$e->getMessage();
}
finally
{
	mysqli_close($db);
}
?>
</body>
</html>