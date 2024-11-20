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

    $check = "select * from tbl_dev where company_id=" . $_SESSION['did'];
    $result = $conn->query($check);
    $row = $result->fetch_assoc();
    
    if (($row['company_pswd']) == ($_POST['txtcurr'])) {
        if ($new == $renew) {
            $update = "update tbl_dev set company_pswd = '" . $renew . "' where company_id =" . $_SESSION['did'];
            $conn->query($update);
?>
            <script>
                alert("Password Updated!!");
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
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Change Password</title>
    <!-- Add Bootstrap CSS link here -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- Add your custom styles if needed -->
    <style>
        body {
            background-color: #f8f9fa; /* Set a background color */
        }
    </style>
</head>

<body style="color:#f8f9fa;">
    <div class="container">
        <form id="form1" name="form1" method="post" action="">
            <div class="form-group row">
                <label for="txtcurr" class="col-sm-2 col-form-label">Current Password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" name="txtcurr" id="txtcurr" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="txtnew" class="col-sm-2 col-form-label">New Password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" name="txtnew" id="txtnew" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="txtcon" class="col-sm-2 col-form-label">Confirm Password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" name="txtcon" id="txtcon" required>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-12 text-center">
                    <input type="submit" class="btn btn-primary" name="btnsub" value="Submit">
                </div>
            </div>
        </form>
    </div>

    <!-- Add Bootstrap JS links here -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

<?php
ob_end_flush();
include('Foot.php');
?>

</html>