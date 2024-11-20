<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../Assets/phpMail/src/Exception.php';
require '../Assets/phpMail/src/PHPMailer.php';
require '../Assets/phpMail/src/SMTP.php';
include('../Assets/Connection/Connection.php');
ob_start();
include("Head.php");

if(isset($_GET['sts']))
{
    $id = $_GET['sts'];
    $ups = "update tbl_complaint set status = 1 where complaint_id ='".$id."' ";
    $conn->query($ups);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaint Management</title>
</head>

<body>
    <?php
    $com = "select * from tbl_complaint where status = 0 and type = 'complaint' order by date desc";
    $comp = $conn->query($com);
    if ($comp->num_rows > 0) {
        ?>
        <table border="2" cellpadding=10>
            <tr>
                <th>Who</th>
                <th>Name</th>
                <th>Subject</th>
                <th>Description</th>
                <th>Date</th>
            </tr>
            <?php
            while ($comp2 = $comp->fetch_assoc()) {
                ?>
                <tr>
                    <td>
                        <?php echo $comp2['who'] ?>
                    </td>
                    <?php
                    if ($comp2['who'] == "user") {
                        $us = "select * from tbl_user where user_id = " . $comp2['id'];
                        $use = $conn->query($us);
                        $user = $use->fetch_assoc();
                        ?>
                        <td>
                            <?php echo $user['name'] ?>
                        </td>
                        <?php
                    } else {
                        $de = "select * from tbl_dev where company_id = " . $comp2['id'];
                        $dev = $conn->query($de);
                        $deve = $dev->fetch_assoc();
                        ?>
                        <td>
                            <?php echo $deve['company_name'] ?>
                        </td>
                        <?php
                    }
                    ?>
                    <td>
                        <?php echo $comp2['subject'] ?>
                    </td>
                    <td>
                        <?php echo $comp2['description'] ?>
                    </td>
                    <td>
                        <?php echo $comp2['date'] ?>
                    </td>
                    <?php
                    if ($comp2['who'] == "user") {
                        ?>
                        <td><a href="Reply.php?reply=<?php echo $user['user_email'] ?>">Reply</a></td>
                        <?php
                    } else {
                        ?>
                        <td><a href="Reply.php?reply=<?php echo $deve['company_email'] ?>">Reply</a></td>
                        <?php
                    }
                    ?>
                    <td><a href="Complaint.php?sts=<?php echo $comp2['complaint_id']?>">Done</a></td>
                </tr>
            </table>
            <?php
            }
    } else
        echo "NO NEW COMPLAINTS";
    ?>
</body>
<?php
ob_end_flush();
include('Foot.php');
?>

</html>