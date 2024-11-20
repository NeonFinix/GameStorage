<?php
ob_start();
include("Head.php");
	include('../Assets/Connection/Connection.php');
	session_start();
  include("session.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Edit Event</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
<?php
$g = "select *from tbl_events where event_id = ".$_GET['edit'];
$gg = $conn->query($g);
$event = $gg->fetch_assoc();
?>
  <table border="1">
    <tr>
      <td>Name</td>
      <td><label for="name"></label>
      <input type="text" name="name" id="name" value="<?php echo $event['event_name']?> " required /></td>
    </tr>
    <tr>
      <td>Description</td>
      <td><label for="descr"></label>
      <textarea name="descr" id="descr" cols="45" rows="5" required><?php echo $event['event_desc']?></textarea></td>
    </tr>
    <tr>
      <td>End Date(YYYY-MM-DD)</td>
      <td><label for="end_date"></label>
      <input type="text" name="end_date" id="end_date" value="<?php echo $event['end_date']?>"required /></td>
    </tr>
    <tr>
      <td colspan="2"><div align="center">
        <input type="submit" name="submit" id="submit" value="Submit" />
        <input type="reset" name="cancel" id="cancel" value="Cancel" />
      </div></td>
    </tr>
  </table>
</form>
</body>
<?php
	if(isset($_POST['submit']))
		{
			$name = $_POST['name'];
			$desc = $_POST['descr'];
			$end = $_POST['end_date'];
			
			$up = "update tbl_events set event_name = '".$name."', event_desc = '".$desc."', end_date = '".$end."' where event_id = ".$_GET['edit'];
			if($conn->query($up))
			{
			?>
			<script>
            alert("Updated!!");
            window.location="MyGame.php?kid=<?php echo $event['game_id']?>";
            </script>
            <?php
			}
		}
  ob_end_flush();
  include('Foot.php');
  ?>
</html>