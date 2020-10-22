<?php
try
{
$dept="";
$sem="";
$sub="";
$spec="";
session_start();
$dept=$_SESSION['dept'];
$sem=$_SESSION['sem'];
$sub=$_SESSION['sub'];
$y=date('Y');
if(isset($_GET['pdf']))
{
$spec=$_GET['pdf'];
}
$table=$dept.$sem.$sub.$y;
$con=mysqli_connect("localhost","root","","notes");
$del="delete from ".$table." where file='".$spec."'";
$a=mysqli_query($con,$del);
if($a)
{  echo "<script>
	alert('DELETED!');
	window.location.href='aview.html';
	</script>";
}
else
{
	  echo "<script>
	alert('ERROR!');
	window.location.href='aview.html';
	</script>";
}
}
catch(Exception $e)
{
	echo "Message:".$e->getMessage();
}
finally
{
	mysqli_close($con);
}
?>