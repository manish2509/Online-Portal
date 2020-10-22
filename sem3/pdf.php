<?php
try
{
$sp="";
$pwd="";
$pdf="";
$dept="";
$sem="";
$sub="";
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
if(isset($_POST['sp']))
{
	$sp=$_POST['sp'];
}
if(isset($_POST['pass']))
{
	$pwd=$_POST['pass'];
}
if(isset($_POST['submit']))
{
 $pdf = $_FILES['pdf']['name'];
}
if($sp==""||$sub==""||$sem=="s"||$dept=="s"||$pwd=="")
{
	echo "<script>
	alert('ENTER ALL THE DETAILS!');
	window.location.href='upload.php';
	</script>";
}
else{
if($pwd=="info123")
{
$y=date("Y");
$table=$dept.$sem.$sub.$y;
$d=mysqli_connect("localhost","root","");
$db="create database if not exists notes";
mysqli_query($d,$db);
$con=mysqli_connect("localhost","root","","notes");
$tb="create table if not exists ".$table." (specification varchar(20),file varchar(100) primary key)";
mysqli_query($con,$tb);
$in="insert into ".$table." values('".$sp."','".$pdf."')";
mysqli_query($con,$in);
$folder="year".$y.$dept.$sem.$sub;
	if(!file_exists($folder))
	{	
    mkdir($folder);
	chdir($folder);
	}
	else{
	
		chdir("year".$y.$dept.$sem.$sub);
	}
$target="".basename($pdf);
$a=move_uploaded_file($_FILES['pdf']['tmp_name'],$target);
if($a)
{
session_start();
$_SESSION['dept']=$dept;
$_SESSION['sem']=$sem;
$_SESSION['sub']=$sub;
	echo "<script>
	alert('UPLOADED!');
	window.location.href='upload.html';
	</script>";
}
else{
	echo "<script>
	alert('ERROR!');
	window.location.href='upload.html;
	</script>";
}
}
else
{
	echo "<script>
	alert('INCORRECT PASSWORD!');
	window.location.href='upload.html';
	</script>";
}
}
}
catch(Exception $e)
{
	echo "Message:".$e->getMessage();
}
finally
{
	mysqli_close($d);
	mysqli_close($con);
}
 ?>