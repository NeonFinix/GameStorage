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
<title>Untitled Document</title>
</head>
<body>
<a href="AddEvents.php">Add Event</a>
<br />
<a href="EditEventGet.php">Edit Event</a>
<br />
<a href="DeleteEvent.php">Delete Event</a>
<br />
</body>
<?php
  ob_end_flush();
  include('Foot.php');
  ?>
</html>