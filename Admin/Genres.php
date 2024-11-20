<?php 
ob_start();
include("Head.php");
include('../Assets/Connection/Connection.php');
if(isset($_POST['submit']))
{
	$genre = $_POST['genre'];
	$idg = $_POST['g_id'];
	if($idg!="")
	{
		$upQury = "UPDATE tbl_genre set genre_name='".$genre."' where genre_id='".$idg."'";
		if($conn->query($upQury))
		{
			?>
			<script>
            alert("Updated!!");
            window.location="Genres.php";
            </script>
            <?php	
		}	
	}
	else
	{
		$insquery="INSERT INTO tbl_genre(genre_name) VALUES ('".$genre."')";
		if($conn->query($insquery))
		{
			echo "Inserted";
		}
	}
		
}
if(isset($_GET["if"]))
{
	$delete = "delete from tbl_genre where genre_id='".$_GET["if"]."'";
	if($conn->query($delete))
	{
		?>
        <script>
		alert("Deleted");
		window.location = "Genres.php";
		</script>
        <?php
	}
}
$gname="";
$gid="";
if(isset($_GET["edid"]))
{
	$selg = "select * from tbl_genre where genre_id='".$_GET["edid"]."'";
	$rowg = $conn->query($selg);
	$datag = $rowg->fetch_assoc();
	$gid = $datag["genre_id"];
	$gname = $datag["genre_name"];
	
}	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Genres</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="251" border="1">
    <tr>
      <td width="67">Genres</td>
      <td width="168"><label for="genre"></label>
      <input type="text" name="genre" id="genre" value="<?php echo $gname ?>"/>
      <input type="hidden" name="g_id" value="<?php echo $gid ?>"></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="submit" id="submit" value="Submit" /></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <table width="364" border="1">
    <tr>
      <td width="62">Sl. No</td>
      <td width="195">Genre</td>
      <td width="85">Action</td>
    </tr>
    <?php
	$i = 0;
    $SelQuery = "select * from tbl_genre";
	$row = $conn->query($SelQuery);
	while($data=$row->fetch_assoc())
	{
		$i++;
	?>
    <tr>
      <td height="67"><?php echo $i ?></td>
      <td><?php echo $data["genre_name"] ?></td>
      <td><p><a href="Genres.php?if=<?php echo $data["genre_id"] ?>">Delete</a></p>
      <p><a href="Genres.php?edid=<?php echo $data["genre_id"] ?>">Edit</a></p></td>
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