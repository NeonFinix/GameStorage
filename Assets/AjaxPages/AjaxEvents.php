<?php
include("../Connection/Connection.php");
	$selQry="select * from tbl_events where game_id=".$_GET['gid'];
	$result=$conn->query($selQry);
	while($row=$result->fetch_assoc())
	{
	?>
	<option value="<?php echo $row['event_id']  ?>"><?php echo $row['event_name']  ?></option>
	<?php
	}
?>