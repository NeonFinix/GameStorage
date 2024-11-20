<?php
ob_start();
include("Head.php");
include('../Assets/Connection/Connection.php');
session_start();
include("session.php");

if (isset($_POST['submit'])) {
    $id = $_POST['event'];
    $get = "select * from tbl_events where event_id = " . $id;
    $geti = $conn->query($get);
    if ($geti->num_rows <= 0) {
        ?>
        <script>
            alert("Select an event");
        </script>
        <?php
    } else {
        $ev = $geti->fetch_assoc();
        ?>
        <script>
            window.location = "EditEvent.php?edit=<?php echo $ev['event_id'] ?>";
        </script>
        <?php
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Edit Event</title>
    <!-- Add Bootstrap CSS link here -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- Add your custom styles if needed -->
    <style>
        body {
            background-color: #f8f9fa;
            /* Set a background color */
        }
    </style>
</head>

<body style="color: white;">
    <div class="container">
        <form id="form1" name="form1" method="post" action="">
            <div class="form-group row">
                <label for="game" class="col-sm-2 col-form-label">Game</label>
                <div class="col-sm-10">
                    <select class="form-control" name="game" id="game" onchange="getEvent(this.value)">
                        <option>---select---</option>
                        <?php
                        $show = "SELECT *FROM tbl_games where company_id = " . $_SESSION['did'];
                        $row = $conn->query($show);
                        while ($data = $row->fetch_assoc()) {
                            ?>
                            <option value="<?php echo $data["game_id"] ?>">
                                <?php echo $data["game_name"] ?>
                            </option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="event" class="col-sm-2 col-form-label">Event</label>
                <div class="col-sm-10">
                    <select class="form-control" name="event" id="event" required></select>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-10 offset-sm-2">
                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                    <button type="reset" class="btn btn-secondary" name="cancel">Cancel</button>
                </div>
            </div>
            <br><br><br><br>
        </form>
    </div>

    <!-- Add Bootstrap JS links here -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script src="../Assets/JQuery/jQuery.js"></script>
    <script>
        function getEvent(gid) {
            $.ajax({
                url: "../Assets/AjaxPages/AjaxEvents.php?gid=" + gid,
                success: function (html) {
                    $("#event").html(html);
                }
            });
        }
    </script>
</body>

<?php
ob_end_flush();
include('Foot.php');
?>

</html>