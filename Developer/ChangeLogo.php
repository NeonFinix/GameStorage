<?php
ob_start();
include("Head.php");
session_start();
include("session.php");
include('../Assets/Connection/Connection.php');

function validateImageDimensions($imagePath, $targetAspectRatio = 1)
{
    // Get image dimensions
    list($width, $height) = getimagesize($imagePath);

    // Check if the aspect ratio matches the target aspect ratio (e.g., 1:1)
    $aspectRatio = $width / $height;

    return abs($aspectRatio - $targetAspectRatio) < 0.01; // You can adjust the tolerance if needed
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Logo</title>
</head>

<body style="color: white;">
    <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
        <?php
        $show = "select * from tbl_games where tbl_games.game_id = '$_GET[edit]'";
        $row = $conn->query($show);
        $data = $row->fetch_assoc();
        ?>
        <div class="form-group row" style="align-items: center;">
            <label for="logo" class="col-sm-2 col-form-label" style="padding-left: 200px;">Logo</label>
            <div class="col-sm-10">
                <input type="file" class="form-control-file" name="logo" id="logo" />
                <br>Current Logo <br>
                <img src="../Assets/Files/Developer/GameLogo/<?php echo $data['game_logo'] ?>" alt="currentlogo"
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
    }
    if (validateImageDimensions($path, 1)) {
        move_uploaded_file($path, "../Assets/Files/Developer/GameLogo/" . $logo);

        $ch = "update tbl_games set game_logo ='" . $logo . "' where game_id = " . $_GET['edit'];
        $ch1 = $conn->query($ch);
        if ($ch1) {
            ?>
            <script>
                alert("Succesfully Updated");
                window.location = "MyGame.php?kid=<?php echo $data['game_id'] ?>";
            </script>
            <?php
        } else {
            ?>
            <script>
                alert("Something Went Wrong");
            </script>
            <?php
        }
    } else {
        ?>
        <script>
            alert("Image does not have a 1:1 aspect ratio");
        </script>
        <?php
    }
}
ob_end_flush();
include('Foot.php');
?>