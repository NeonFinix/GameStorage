<?php
ob_start();
include("Head.php");
include('../Assets/Connection/Connection.php');
session_start();
include("session.php");

if (isset($_POST['btnsub'])) {
    $old = $_POST['txtcurr'];
    $new = $_POST['txtnew'];
    $renew = $_POST['txtcon'];

    $check = "select * from tbl_user where user_id=" . $_SESSION['uid'];
    $result = $conn->query($check);
    $row = $result->fetch_assoc();

    if (($row['user_pswd']) == ($_POST['txtcurr'])) {
        if ($new == $renew) {
            $update = "update tbl_user set user_pswd = '" . $renew . "' where user_id =" . $_SESSION['uid'];
            $conn->query($update);
?>
            <script>
                alert("Password Updated Successfully!!");
                window.location = "HomePage.php";
            </script>
        <?php
        } else {
        ?>
            <script>
                alert("New Password & Confirm Password don't match!!");
                window.location = "ChangePassword.php";
            </script>
        <?php
        }
    } else {
        ?>
        <script>
            alert("Error in Current Password!!");
            window.location = "ChangePassword.php";
        </script>
<?php
    }
}

include("Head.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <!-- Add Bootstrap CSS link here -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- Add your custom styles if needed -->
    <style>
        body {
            background-color: #f8f9fa; /* Set a background color */
        }


        table {
            width: 100%;
            max-width: 400px; /* Set max width for better responsiveness */
            margin: 0 auto;
        }

        input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }
    </style>
</head>

<body>
    <div class="container">
        <form id="form1" name="form1" method="post" action="">
            <table class="table table-bordered"  style="color: white;">
                <tr>
                    <td>Current Password</td>
                    <td><input type="password" name="txtcurr" id="txtcurr" class="form-control" required /></td>
                </tr>
                <tr>
                    <td>New Password</td>
                    <td><input type="password" name="txtnew" id="txtnew" class="form-control" required /></td>
                </tr>
                <tr>
                    <td>Confirm Password</td>
                    <td><input type="password" name="txtcon" id="txtcon" class="form-control" required /></td>
                </tr>
                <tr>
                    <td colspan="2" align="center"><input type="submit" name="btnsub" value="Submit" class="btn btn-primary" /></td>
                </tr>
            </table>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

<?php
ob_end_flush();
include('Foot.php');
?>

</html>