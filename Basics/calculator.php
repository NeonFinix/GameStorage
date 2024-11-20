<?php
$result="";
if(isset($_POST['btn_add']))
{
	$fn=$_POST['txt_fn'];
	$sn=$_POST['txt_ln'];
	$result=$fn+$sn;
}
if(isset($_POST['btn_sub']))
{
	$fn=$_POST['txt_fn'];
	$sn=$_POST['txt_ln'];
	$result=$fn-$sn;
}
if(isset($_POST['btn_div']))
{
	$fn=$_POST['txt_fn'];
	$sn=$_POST['txt_ln'];
	$result=$fn/$sn;
}
if(isset($_POST['btn_mult']))
{
	$fn=$_POST['txt_fn'];
	$sn=$_POST['txt_ln'];
	$result=$fn*$sn;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="378" height="176" border="1">
    <tr>
      <td width="166" height="48"><p>First Number</p></td>
      <td width="196"><label for="txt_fn"></label>
      <input type="text" name="txt_fn" id="txt_fn" /></td>
    </tr>
    <tr>
      <td height="42">Second Number</td>
      <td><label for="txt_ln"></label>
      <input type="text" name="txt_ln" id="txt_ln" /></td>
    </tr>
    <tr>
      <td colspan="2">
      <input type="submit" name="btn_add" id="btn_add" value="ADD" />
	  <input type="submit" name="btn_sub" id="btn_sub" value="SUBSTRACT" />
      <input type="submit" name="btn_div" id="btn_div" value="DIVISION" />
      <input type="submit" name="btn_mult" id="btn_mult" value="MULTIPLICATION" />
      </td>
    </tr>
    <tr>
      <td height="41"  colspan="2"><?php echo $result ?></td>
    </tr>
  </table>
  <p>&nbsp;</p>
</form>
</body>
</html>