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
    <title>MyProfile</title>
    <!-- Add Bootstrap CSS link here -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- Add your custom styles if needed -->
    <style>
        img {
            max-width: 100%;
            height: auto;
        }

        h2 {
            margin-bottom: 20px;
        }

        .game-container {
            margin-top: 20px;
        }

        .game-card {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="container" style="color: white; margin-top: 50px;">
        <div class="container">
            <form id="form1" name="form1" method="post" action="">
                <?php
                $selqry = "SELECT * FROM tbl_dev where company_id = " . $_SESSION['did'];
                $row = $conn->query($selqry);
                $data = $row->fetch_assoc();
                ?>
                <div class="row mt-4">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title"
                                    style="background-color: black;padding: 8px;     border-radius: 10px; display: flex ; justify-content: space-between ;height: 50px;">
                                    <h4>User Information</h4>
                                    <div>
                                        <nav class="navbar navbar-expand-lg navbar-light">

                                            <div class="collapse navbar-collapse main-menu-item"
                                                id="navbarSupportedContent">
                                                <ul class="navbar-nav">
                                                    <li class="nav-item dropdown">
                                                        <a class="nav-link dropdown-toggle" id="navbarDropdown"
                                                            role="button" data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false"
                                                            style="color: aliceblue; padding-left: 100px; padding-top: revert;">
                                                            <span><svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                                    height="20" fill="currentColor" class="bi bi-gear"
                                                                    viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z" />
                                                                    <path
                                                                        d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z" />
                                                                </svg></span>
                                                        </a>
                                                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                            <a class="dropdown-item" href="EditProfile.php">Edit
                                                                Profile</a>
                                                            <a class="dropdown-item" href="Changepfp.php?edit=<?php echo $data['company_id']?>">Edit
                                                                Profile Picture</a>
                                                            <a class="dropdown-item" href="ChangePassword.php">Change
                                                                Password</a>
                                                            <a class="dropdown-item" href="logout.php">Log out</a>
                                                        </div>
                                                    </li>
                                        </nav>
                                    </div>

                                </div>

                                <div class="col-md-4">
                                    <img src="../Assets/Files/Developer/Logo/<?php echo $data['company_logo'] ?>"
                                        class="img-fluid user-logo" alt="User Logo" style="max-width: 300px;">
                                </div>
                                <ul class="list-group list-group-flush" style="color: black;">
                                    <li class="list-group-item">
                                        <strong>Company Name: </strong>
                                        <?php echo $data['company_name'] ?>
                                    </li>
                                    <li class="list-group-item">
                                        <strong>E-mail: </strong>
                                        <?php echo $data['company_email'] ?>
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Date of joining: </strong>
                                        <?php echo $data['date_of_joining'] ?>
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Address: </strong>
                                        <?php echo $data['company_address'] ?>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <br><br><br>
        <?php
        $i = 0;
        $yy = "select * from tbl_dev inner join tbl_games on tbl_dev.company_id = tbl_games.company_id where tbl_dev.company_id = " . $_SESSION['did'];
        $dd = $conn->query($yy);

        if ($dd->num_rows > 0) {
            ?>
            <div class="game-container">
                <h2>MY GAMES</h2>
                <div class="row">
                    <?php
                    while ($qq = $dd->fetch_assoc()) {
                        $i++;
                        ?>
                        <div class="col-md-3 game-card">
                            <p align="center">
                                <a href="MyGame.php?kid=<?php echo $qq['game_id'] ?>"><img
                                        src="../Assets/Files/Developer/GameLogo/<?php echo $qq['game_logo'] ?>"
                                        class="img-fluid" alt="game_logo"></a>
                            </p>
                            <p class="text-center">
                                <?php echo $qq['game_name'] ?>
                            </p>
                            <p class="text-center"><a href="MyGame.php?dle=<?php echo $qq["game_id"] ?>">DELETE</a></p>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <?php
        } else {
            echo "<p>You don't have any games.</p>";
        }

        $i = 0;
        $who = "dev";
        $yy = "select * from tbl_favourite inner join tbl_games where tbl_favourite.who ='$who' and tbl_games.game_id = tbl_favourite.game_id and tbl_favourite.id = " . $_SESSION['did'];
        $dd = $conn->query($yy);

        if ($dd->num_rows > 0) {
            ?>
            <div class="game-container">
                <h2>My Favourites</h2>
                <div class="row">
                    <?php
                    while ($qq = $dd->fetch_assoc()) {
                        $i++;
                        ?>
                        <div class="col-md-3 game-card">
                            <p align="center">
                                <a href="ViewGame.php?kid=<?php echo $qq['game_id'] ?>"><img
                                        src="../Assets/Files/Developer/GameLogo/<?php echo $qq['game_logo'] ?>"
                                        class="img-fluid" alt="game_logo"></a>
                            </p>
                            <p class="text-center">
                                <?php echo $qq['game_name'] ?>
                            </p>
                            <p class="text-center"><a href="MyProfile.php?dlfv=<?php echo $qq["game_id"] ?>">DELETE</a></p>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <?php
        } else {
            echo "<p>You don't have any favourites.</p>";
        }
        ?>
    </div>

    <!-- Add Bootstrap JS links here -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

<?php
if (isset($_GET['dle'])) {
    $delete = "DELETE FROM tbl_games where game_id = " . $_GET['dle'];
    if ($conn->query($delete)) {
        ?>
        <script>
            alert("Deleted");
            window.location = "MyProfile.php";
        </script>
        <?php
    }
}

if (isset($_GET['dlfv'])) {
    $delete = "DELETE FROM tbl_favourite where who = '$who' and game_id = '" . $_GET['dlfv'] . "' and id = " . $_SESSION['did'];
    if ($conn->query($delete)) {
        ?>
        <script>
            alert("Deleted");
            window.location = "MyProfile.php";
        </script>
        <?php
    }
}
ob_end_flush();
include('Foot.php');
?>

</html>