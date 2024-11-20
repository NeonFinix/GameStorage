<?php
ob_start();
include("Head.php");
session_start();
include("session.php");
include('../Assets/Connection/Connection.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change pfp</title>
</head>

<body style="color: white;">
    <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
        <?php
        $show = "select * from tbl_user where user_id = '$_GET[edit]'";
        $row = $conn->query($show);
        $data = $row->fetch_assoc();
        ?>
        <div class="form-group row" style="align-items: center;">
            <label for="logo" class="col-sm-2 col-form-label" style="padding-left: 200px;">Logo</label>
            <div class="col-sm-10">
                <input type="file" class="form-control-file" name="logo" id="logo" />
                <br>Current Logo <br>
                <img src="../Assets/Files/User/Logo/<?php echo $data['user_logo'] ?>" alt="currentlogo"
                    class="img-fluid mt-2" width="200px" />
                    <br><br><br>
            <input type="submit" class="btn btn-primary" name="submit" id="submit" value="Submit" />
        </div>
        </div>
        <br><br><br><br><br><br>
</body>
</form>

</html>
<?php
if (isset($_POST['submit'])) {
    $logo = $_FILES['logo']['name'];
    $path = $_FILES['logo']['tmp_name'];
    if (empty($logo)) {
        ?>
        <script>
            alert("Select an Image");
        </script>
        <?php
    } else {
        move_uploaded_file($path, "../Assets/Files/User/Logo/" . $logo);
        
        $ch = "update tbl_user set user_logo ='" . $logo . "' where user_id = " . $_GET['edit'];

        $ch1 = $conn->query($ch);
        if($ch1)
        {
            ?>
            <script>
                alert("Succesfully Updated");
                window.location = "MyProfile.php";
            </script>
            <?php
        }
        else{
            ?>
            <script>
                alert("Something Went Wrong");
            </script>
            <?php
        }
    }
}
ob_end_flush();
include('Foot.php');
?>