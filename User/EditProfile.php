<?php
ob_start();
include("Head.php");
session_start();
include("session.php");
include('../Assets/Connection/Connection.php');

if (isset($_POST['submit'])) {
    $name = $_POST['txt_name'];
    $uname = $_POST['txt_uname'];
    $email = $_POST['txt_email'];
    $update = "update tbl_user set name='" . $name . "', username='" . $uname . "', user_email='" . $email . "' where  user_id=" . $_SESSION['uid'];
    if ($conn->query($update)) {
        ?>
        <script>
            alert("Updated!!");
            window.location = "HomePage.php";
        </script>
        <?php
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
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
        <?php
        $selqry = "SELECT * FROM tbl_user where user_id=" . $_SESSION['uid'];
        $row = $conn->query($selqry);
        $data = $row->fetch_assoc();
        $name = $data["name"];
        $uname = $data["username"];
        $email = $data["user_email"];
        ?>
        <form id="form1" name="form1" method="post" action="">
            <table class="table table-bordered"  style="color: white;">
                <tr>
                    <td>Name</td>
                    <td><input type="text" name="txt_name" id="txt_name" value="<?php echo $name ?>" class="form-control" /></td>
                </tr>
                <tr>
                    <td>Username</td>
                    <td><input type="text" name="txt_uname" id="txt_uname" value="<?php echo $uname ?>" class="form-control" /></td>
                </tr>
                <tr>
                    <td>E-mail</td>
                    <td><input type="text" name="txt_email" id="txt_email" value="<?php echo $email ?>" class="form-control" /></td>
                </tr>
                <tr>
                    <td colspan="2" class="text-center">
                        <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-primary" />
                        <input type="reset" name="cancel" id="cancel" value="Cancel" class="btn btn-secondary" />
                    </td>
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