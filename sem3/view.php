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
  $y=date('Y');
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
  if($dept==""||$sem==""||$sub=="")
  {
	    echo "<script>
	alert('ENTER ALL THE DETAILS!');
	window.location.href='index.html';
	</script>";
  }
  else
  {
  $sub_str=$dept.$sem.strtolower($sub);
  $dir_path = "year".$y.$dept.$sem.strtolower($sub);
  $con=mysqli_connect("localhost","root","","notes");
  $tbl="show tables;";
  $list=mysqli_query($con,$tbl);
  while($row=mysqli_fetch_array($list))
  {
	  if(strpos($row[0],$sub_str)!==false)
	  {
		  echo "<h3><b><u>".substr($row[0],-4).":</u></b></h3><br>";
		  if(is_dir($dir_path))
			{
    $files = scandir($dir_path);
	$db=mysqli_connect("localhost","root","","notes");
	$qry="select specification,file from ".$row[0];
	$result=mysqli_query($db,$qry);
	echo "<ul>";
	echo"<div class='container'><div class='table-responsive'><table class='table'>";
		while($row=mysqli_fetch_assoc($result))
	{

			$pdf="year".$y.$dept.$sem.$sub."/".$row['file'];
			echo "<tr><td>".strtoupper($row['specification'])."</td>";
			echo "<td><a href='$pdf' target='_blank'>".$row['file']."</a></td></tr>";
	}
            echo"</table></div></div>";
    }
	  }	  
  }
  }
  }
  catch(Exception $e)
  {
	  echo 'Message: ' .$e->getMessage();
  }
  finally
  {
	  mysqli_close($con);
  }
  ?>
  </body>
  </html>