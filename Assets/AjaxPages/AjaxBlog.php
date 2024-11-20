<?php
include("../Connection/Connection.php");
session_start();
if(isset($_POST["blogData"]))
{
	$who = "user";
	$blogData = $conn->real_escape_string($_POST['blogData']);
	if(empty($_POST['title']))
	{
		echo "Enter Title";
	} else {
	if(empty($blogData)){
		echo "Write Something";
	}
	else {
	$ins = "insert into tbl_blog(content,date,who,user_id,title)values('$blogData',now(),'$who','".$_SESSION['uid']."','".$_POST['title']."')";

 if($conn->query($ins))
{
	?>
	<script>
		alert("Your Blog has been Uploaded");
		window.location("Homepage.php");
	</script>
	<?php
	
}
else
{
	echo "There was some error in uploading";
}
}
}
}
?>