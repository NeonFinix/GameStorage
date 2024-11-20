<?php
ob_start();
include("Head.php");
include('../Assets/Connection/Connection.php');
session_start();
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Developer Profile</title>
    <!-- Add Bootstrap CSS link here -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- Add your custom styles if needed -->
    <style>
        body {
            background-color: #f8f9fa; /* Set a background color */
            color: #f8f9fa;
        }
    </style>
</head>

<body>
    <div class="container">
        <form id="form1" name="form1" method="post" action="">
            <?php
            $selqry = "select * FROM tbl_dev where company_id=" . $_GET['dev'];
            $row = $conn->query($selqry);
            $data = $row->fetch_assoc();
            ?>
            <div class="row">
                <div class="col-md-12 text-center">
                    <img src="../Assets/Files/Developer/Logo/<?php echo $data['company_logo'] ?>" class="img-fluid"
                        alt="Company Logo" width="300px">
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="companyName">Company Name</label>
                        <input type="text" class="form-control" id="companyName" value="<?php echo $data['company_name'] ?>"
                            readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="companyEmail">E-mail</label>
                        <input type="text" class="form-control" id="companyEmail"
                            value="<?php echo $data['company_email'] ?>" readonly>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="companyAddress">Address</label>
                <input type="text" class="form-control" id="companyAddress"
                    value="<?php echo $data['company_address'] ?>" readonly>
            </div>
            <br>
        </form>
    </div>
    <?php
        $data = "select * from tbl_games where company_id = ". $_GET['dev'];
        $dd =  $conn->query($data);
        ?>
            <div class="game-container">
                <h3 style="padding-right: 30px;">GAMES</h3>
                <div class="row">
                    <?php
                    while ($qq = $dd->fetch_assoc()) {
                    ?>
                        <div class="col-md-3 game-card">
                            <p align="center">
                            <a href="AgeCheck.php?kid=<?php echo $qq['game_id']?>"><img src="../Assets/Files/Developer/GameLogo/<?php echo $qq['game_logo'] ?>" class="img-fluid" width="200px" alt="game_logo"></a>
                            </p>
                            <p class="text-center"><?php echo $qq['game_name'] ?></p>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <?php
        $who = "dev";
        $yy = "select * from tbl_favourite inner join tbl_games where tbl_favourite.who ='$who' and tbl_games.game_id = tbl_favourite.game_id and tbl_favourite.id = " . $_GET['dev'];
        $dd = $conn->query($yy);

        if ($dd->num_rows > 0) {
            ?>
            <div class="game-container">
                <h3>Favourites</h3>
                <div class="row">
                    <?php
                    while ($qq = $dd->fetch_assoc()) {
                        ?>
                        <div class="col-md-3 game-card">
                            <p align="center">
                                <a href="AgeCheck.php?kid=<?php echo $qq['game_id'] ?>"><img
                                        src="../Assets/Files/Developer/GameLogo/<?php echo $qq['game_logo'] ?>"
                                        class="img-fluid" alt="game_logo" width="200px"></a>
                            </p>
                            <p class="text-center">
                                <?php echo $qq['game_name'] ?>
                            </p>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <?php
        } else {
            echo "<p>They don't have any favourites.</p>";
        }
        ?>
    <!-- Add Bootstrap JS links here -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

<?php
ob_end_flush();
include('Foot.php');
?>

</html>