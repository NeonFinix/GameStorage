<?php
ob_start();
include("Head.php");
include('../Assets/Connection/Connection.php');
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Age Check</title>
</head>
<body>
<?php
$ch = "select * from tbl_user where user_id = ".$_SESSION['uid'];
$ch1 = $conn->query($ch);
$ch2 = $ch1->fetch_assoc();
$ql = "select * from tbl_games where game_id = ".$_GET['kid'];
$ff = $conn->query($ql);
$rr = $ff->fetch_assoc();
if($rr['min_age'] >= $ch2['age'])
{
	?>
	<h3>THIS GAME CONTAINS CONTENT THAT IS UNRATED AND MAY NOT BE APPROPRIATE FOR ALL AGES!!</h3>
    <a href="ViewGame.php?kid=<?php echo $rr['game_id']?>&view='view'">Proceed
    <br />
    <a href="Search.php">Go Back to Search 
<?php	
}
else
{
	?>
    <script>
	window.location="ViewGame.php?kid=<?php echo $rr['game_id']?>&view='view'";
	</script>
    <?php
}
?>
</body>
<?php
  ob_end_flush();
  include('Foot.php');
  ?>
</html>