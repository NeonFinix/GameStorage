<?php 
include('../Assets/Connection/Connection.php');
ob_start();
include("Head.php");

if(isset($_GET['rej']))
{
    $up = "update tbl_dev set status = 2 where company_id = ".$_GET['rej'];
    if($conn->query($up))
    {
        ?>
        <script>
            alert("Rejected");
            window.location="AcceptedDev.php";
        </script>
        <?php
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accepted Devs</title>
</head>
<body>
<table border="1" cellpadding="8" cellspacing="1">
        <tr>
            <td>Company Name</td>
            <td>Company Email</td>
            <td>Company Address</td>
            <td>Date of Joining</td>
            <td>Proof</td>
            <td>Logo</td>
            <td>Status</td>
        </tr>
        <?php
        $sel = "select * from tbl_dev where status = 1";
        $sele = $conn->query($sel);
        while ($row = $sele->fetch_assoc()) {
            ?>
        <tr>
            <td><?php echo $row['company_name'] ?></td>
            <td><?php echo $row['company_email'] ?></td>
            <td><?php echo $row['company_address'] ?></td>
            <td><?php echo $row['date_of_joining'] ?></td>
            <td><img src="../Assets/Files/Developer/Logo/<?php echo $row['company_logo']?>" alt="Proof" class="img-fluid" style="max-width: 200px;"></td>
            <td><img src="../Assets/Files/Developer/Proof/<?php echo $row['company_proof'] ?>" alt="Logo" class="img-fluid" style="max-width: 200px;"></td>
            <td><a href="AcceptedDev.php?rej=<?php echo $row["company_id"] ?>">Reject</a></td>
        </tr>
        <?php
        }
        ?>
    </table>
</body>
<?php
ob_end_flush();
include("Foot.php");
?>
</html>