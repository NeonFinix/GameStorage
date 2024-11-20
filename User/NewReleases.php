<?php
ob_start();
include("Head.php");
include('../Assets/Connection/Connection.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Games</title>
    <link rel="stylesheet" href="your-bootstrap-css-path/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">New Releases</h1>
        <div class="row">
            <?php 
            $new = "SELECT * FROM tbl_games ORDER BY release_date DESC";
            $newe = $conn->query($new);
            $i = 0;
            while ($newest = $newe->fetch_assoc()) {
                $i++;
            ?>
            <div class="col-md-3 mb-4">
                <div class="card">
                    <a href="ViewGame.php?kid=<?php echo $newest['game_id'] ?>">
                        <img src="../Assets/Files/Developer/GameLogo/<?php echo $newest['game_logo'] ?>" alt="Game Thumbnail" class="card-img-top img-fluid" style="max-width: 100%;">
                    </a>
                </div>
                <div class="card-body">
                        <h5 class="card-title"><?php echo $newest['game_name'] ?></h5>
                    </div>
            </div>
            <?php
                if ($i == 4) {
                    echo "</div><div class='row'>";
                    $i = 0; 
                }
            }
            ?>
        </div>
    </div>
</body>
</html>
