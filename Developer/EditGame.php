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
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Edit Game</title>
    <!-- Add Bootstrap CSS link here -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- Add your custom styles if needed -->
    <style>
        body {
            background-color: #f8f9fa; /* Set a background color */
        }
    </style>
</head>

<body style="color: #f8f9fa;">
    <div class="container">
        <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
            <?php
            $show = "select * from tbl_games inner join tbl_dev on tbl_games.company_id = tbl_dev.company_id where tbl_games.game_id = '$_GET[edit]' and tbl_dev.company_id = " . $_SESSION['did'];
            $row = $conn->query($show);
            $data = $row->fetch_assoc();
            ?>
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="name" id="name" value="<?php echo $data['game_name'] ?>" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="descr" class="col-sm-2 col-form-label">Description</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="descr" id="descr" cols="45"
                        rows="5" required><?php echo $data['description'] ?></textarea>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-12 text-center">
                    <input type="submit" class="btn btn-primary" name="submit" id="submit" value="Submit" />
                    <input type="reset" class="btn btn-secondary" name="cancel" id="cancel" value="Cancel" />
                </div>
            </div>
        </form>
    </div>

    <!-- Add Bootstrap JS links here -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

<?php
if (isset($_POST['submit'])) {
   
    $name = $_POST['name'];
    $descr = $_POST['descr'];

    $up = "update tbl_games set game_name = '" . $name . "', description = '" . $descr . "' where game_id = " . $_GET['edit'];
    if ($conn->query($up)) {
?>
        <script>
            alert("Updated!!");
            window.location = "MyGame.php?kid=<?php echo $data['game_id'] ?>";
        </script>
<?php
    }
}
ob_end_flush();
include('Foot.php');
?>

</html>