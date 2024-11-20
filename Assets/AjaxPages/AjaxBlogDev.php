<?php
include("../Connection/Connection.php");
session_start();
if(isset($_POST["blogData"]))
{
	$who = "dev";
	$blogData = $conn->real_escape_string($_POST['blogData']);
	if(empty($_POST['title']))
	{
		echo "Enter Title";
	} else {
	if(empty($blogData)){
		echo "Write Something";
	}
	else {
	$ins = "insert into tbl_blog(content,date,who,user_id,title)values('$blogData',now(),'$who','".$_SESSION['did']."','".$_POST['title']."')";

 if($conn->query($ins))
{
	echo "Your Blog has been Uploaded";
}
else
{
	echo "There was some error in uploading";
}
}
}
}
?>