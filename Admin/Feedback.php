<?php
include('../Assets/Connection/Connection.php');
ob_start();
include("Head.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback</title>
</head>

<body>
    <?php
    $get = "SELECT * FROM tbl_complaint WHERE type = 'feedback' ORDER BY date DESC";
    $gets = $conn->query($get);
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
        while ($geto = $gets->fetch_assoc()) {
            ?>
            <tr>
                <td>
                    <?php echo $geto['who'] ?>
                </td>
                <?php
                if ($geto['who'] == "user") {
                    $us = "SELECT * FROM tbl_user WHERE user_id = " . $geto['id'];
                    $use = $conn->query($us);
                    $user = $use->fetch_assoc();
                    ?>
                    <td>
                        <?php echo $user['name'] ?>
                    </td>
                    <?php
                } else {
                    $de = "SELECT * FROM tbl_dev WHERE company_id = " . $geto['id'];
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
                    <?php echo $geto['subject'] ?>
                </td>
                <td>
                    <?php echo $geto['description'] ?>
                </td>
                <td>
                    <?php echo $geto['date'] ?>
                </td>
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