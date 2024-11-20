<?php
ob_start();
include("Head.php");
include('../Assets/Connection/Connection.php');
session_start();
include("session.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Delete Event</title>
    <!-- Add Bootstrap CSS link here -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- Add your custom styles if needed -->
    <style>
        body {
            background-color: #f8f9fa; /* Set a background color */
		    }

        .table th,
        .table td {
            text-align: center;
        }
    </style>
</head>

<body style="color: white;">
    <div class="container">
        <form id="form1" name="form1" method="post" action="">
            <div class="form-group row">
                <label for="txt_game" class="col-sm-2 col-form-label">Game</label>
                <div class="col-sm-4">
                    <select class="form-control" name="txt_game" id="txt_game">
                        <option>--select--</option>
                        <?php
                        $get = "SELECT * FROM tbl_games where company_id = " . $_SESSION['did'];
                        $getl = $conn->query($get);
                        while ($data = $getl->fetch_assoc()) {
                        ?>
                            <option value="<?php echo $data["game_id"] ?>"><?php echo $data["game_name"] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="col-sm-2">
                    <input type="submit" name="txt_submit" id="txt_submit" value="Submit" class="btn btn-primary" />
                </div>
            </div>
            <?php
            if (isset($_POST['txt_submit'])) {
                $gm = $_POST['txt_game'];
                $ee = "select * from tbl_games inner join tbl_events on tbl_events.game_id = tbl_games.game_id where tbl_games.game_id = '$gm'";
                $ll = $conn->query($ee);
                if ($ll->num_rows > 0) {
                    $sl = $ll->fetch_assoc();
            ?>
                    <table class="table table-bordered" style="color:white;">
                        <thead>
                            <tr>
                                <th colspan="2">Game</th>
                                <th width="170">Event</th>
                                <th width="83">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td width="205"><?php echo $sl['game_name'] ?></td>
                                <td width="150"><img src="../Assets/Files/Developer/GameLogo/<?php echo $sl['game_logo'] ?>" class="img-fluid" alt="Game Logo"></td>
                                <td><?php echo $sl['event_name'] ?></td>
                                <td><a href="DeleteEvent.php?vid=<?php echo $sl["game_id"] ?>" class="btn btn-danger">DELETE</a></td>
                            </tr>
                        </tbody>
                    </table>
                <?php
                } else {
                    echo "<br>";
                    echo "NO EVENTS AVAILABLE";
                }
            }
            ?>
            <br><br><br><br><br><br>
        </form>
    </div>

    <!-- Add Bootstrap JS links here -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <?php
    if (isset($_GET['vid'])) {
        $delete = "DELETE FROM tbl_events where game_id = $_GET[vid] and company_id = $_SESSION[did]";
        if ($conn->query($delete)) {
    ?>
            <script>
                alert("Removed");
                window.location = "DeleteEvent.php";
            </script>
    <?php
        }
    }
    ?>
    <?php
    ob_end_flush();
    include('Foot.php');
    ?>

</body>

</html>