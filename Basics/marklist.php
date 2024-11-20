<?php
$fn="";
$ln="";
$m1="";
$m2="";
$m3="";
$dept="";
$total_mark="";
$avg="";
if(isset($_POST['btn_save']))
{
	$fn=$_POST['txt_fn'];
	$ln=$_POST['txt_ln'];
	$dept=$_POST['txt_dept'];
	$m1=$_POST['mark1'];
	$m2=$_POST['mark2'];
	$m3=$_POST['mark3'];
	$total_mark=$m1+$m2+$m3;
	$avg=$total_mark/3;
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
  <table width="364" border="1">
    <tr>
      <td width="111">First Name</td>
      <td width="237"><label for="txt_fn"></label>
      <input type="text" name="txt_fn" id="txt_fn" /></td>
    </tr>
    <tr>
      <td>Last Name</td>
      <td><label for="txt_ln"></label>
      <input type="text" name="txt_ln" id="txt_ln" /></td>
    </tr>
    <tr>
      <td>Department</td>
      <td><label for="txt_dept"></label>
        <select name="txt_dept" id="txt_dept">
      <option value="BCA">BCA</option>
      <option value="B.COM">B.COM</option>
      <option value="BA">BA</option>
      <option value="BBA">BBA</option>
      </select>
      </td>
    </tr>
    <tr>
      <td>Mark 1</td>
      <td><label for="mark1"></label>
      <input type="text" name="mark1" id="mark1" /></td>
    </tr>
    <tr>
      <td>Mark 2</td>
      <td><label for="mark2"></label>
      <input type="text" name="mark2" id="mark2" /></td>
    </tr>
    <tr>
      <td>Mark 3</td>
      <td><label for="mark3"></label>
      <input type="text" name="mark3" id="mark3" /></td>
    </tr>
    <tr>
      <td colspan="2" align="center">
      <input type="submit" name="btn_save" id="btn_save" value="Submit" />
      <input type="reset" name="btn_cancel" id="btn_cancel" value="Cancel" /></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <table width="359" border="1">
    <tr>
      <td width="127">Name</td>
      <td width="216"><?php echo $fn.$ln ?></td>
    </tr>
    <tr>
      <td>Department</td>
      <td><?php echo $dept ?></td>
    </tr>
    <tr>
      <td>Mark1</td>
      <td><?php echo $m1 ?></td>
    </tr>
    <tr>
      <td>Mark2</td>
      <td><?php echo $m2 ?></td>
    </tr>
    <tr>
      <td>Mark3</td>
      <td><?php echo $m3 ?></td>
    </tr>
    <tr>
      <td>Total Mark</td>
      <td><?php echo $total_mark ?></td>
    </tr>
    <tr>
      <td>Avg</td>
      <td><?php echo $avg ?></td>
    </tr>
  </table>
  <p>&nbsp;</p>
</form>
</body>
</html>