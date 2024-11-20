<?php 
include('../Assets/Connection/Connection.php');
ob_start();
include("Head.php");
if(isset($_POST['submit']))
{
	$platform = $_POST['platform'];
	$idg = $_POST['p_id'];
	if($idg!="")
	{
		$upQury = "UPDATE tbl_platform set platform_name='".$platform."' where platform_id='".$idg."'";
		if($conn->query($upQury))
		{
			?>
			<script>
            alert("Updated!!");
            window.location="platform.php";
            </script>
            <?php	
		}	
	}
	else
	{
		$insquery="INSERT INTO tbl_platform(platform_name) VALUES ('".$platform."')";
		if($conn->query($insquery))
		{
			echo "Inserted";
		}
	}
		
}
$pname="";
$pid="";
if(isset($_GET["edid"]))
{
	$selg = "select * from tbl_platform where platform_id='".$_GET["edid"]."'";
	$rowg = $conn->query($selg);
	$datag = $rowg->fetch_assoc();
	$pid = $datag["platform_id"];
	$pname = $datag["platform_name"];
	
}	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>platform</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="251" border="1">
    <tr>
      <td width="67">platform</td>
      <td width="168"><label for="platform"></label>
      <input type="text" name="platform" id="platform" value="<?php echo $pname ?>"/>
      <input type="hidden" name="p_id" value="<?php echo $pid ?>"></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="submit" id="submit" value="Submit" /></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <table width="364" border="1">
    <tr>
      <td width="62">Sl. No</td>
      <td width="195">platform</td>
      <td width="85">Action</td>
    </tr>
    <?php
	$i = 0;
    $SelQuery = "select * from tbl_platform";
	$row = $conn->query($SelQuery);
	while($data=$row->fetch_assoc())
	{
		$i++;
	?>
    <tr>
      <td height="67"><?php echo $i ?></td>
      <td><?php echo $data["platform_name"] ?></td>
      <td><p><a href="platform.php?edid=<?php echo $data["platform_id"] ?>">Edit</a></p></td>
    </tr>
    <?php
	}
	?>
  </table>
</form>
</body>
<?php
ob_end_flush();
include("Foot.php");
?>
</html>