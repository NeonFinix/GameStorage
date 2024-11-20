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
    <meta charset="UTF-8">
    <title>My Profile</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Include your custom CSS -->
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>

<body>
    <div class="container">
        <form id="form1" name="form1" method="post" action="">
            <?php
            $selqry = "SELECT * FROM tbl_user where user_id = " . $_SESSION['uid'];
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
                                                        <a class="dropdown-item" href="EditProfile.php">Edit Profile</a>
                                                        <a class="dropdown-item" href="Changepfp.php?edit=<?php echo $data['user_id']?>">Edit Profile Picture</a>
                                                        <a class="dropdown-item" href="ChangePassword.php">Change
                                                            Password</a>
                                                        <a class="dropdown-item" href="logout.php">Log out</a>
                                                    </div>
                                                </li>
                                    </nav>
                                </div>

                            </div>

                            <div class="col-md-4">
                                <img src="../Assets/Files/User/Logo/<?php echo $data['user_logo'] ?>"
                                    class="img-fluid user-logo" alt="User Logo" style="max-width: 300px;">
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <strong>Name:</strong>
                                    <?php echo $data['name'] ?>
                                </li>
                                <li class="list-group-item">
                                    <strong>Username:</strong>
                                    <?php echo $data['username'] ?>
                                </li>
                                <li class="list-group-item">
                                    <strong>Date of Birth:</strong>
                                    <?php echo $data['dob'] ?>
                                </li>
                                <li class="list-group-item">
                                    <strong>E-mail:</strong>
                                    <?php echo $data['user_email'] ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <?php
    $i = 0;
    $who = "user";
    $yy = "SELECT * FROM tbl_favourite
           INNER JOIN tbl_games ON tbl_favourite.game_id = tbl_games.game_id
           WHERE tbl_favourite.who = '$who' AND tbl_favourite.id = " . $_SESSION['uid'];
    $dd = $conn->query($yy);
    if ($dd->num_rows > 0) {
        ?>
        <br>
        <div class="container my-5">
            <div class="card bg-secondary rounded shadow p-4" style="background-color: #fg00ff!important;">
                <h5 class="mb-4 text-white">My Favorites</h5>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($qq = $dd->fetch_assoc()) {
                                $i++;
                                ?>
                                <tr>
                                    <th scope="row">
                                        <?php echo $i ?>
                                    </th>
                                    <td>
                                        <div class="media">
                                            <img src="../Assets/Files/Developer/GameLogo/<?php echo $qq['game_logo'] ?>"
                                                class="game-thumbnail mr-3" alt="Game Thumbnail" width="80">
                                            <div class="media-body">
                                                <h6 class="mt-0">
                                                    <a href="AgeCheck.php?kid=<?php echo $qq['game_id'] ?>" class="text-light">
                                                        <?php echo $qq['game_name'] ?>
                                                    </a>
                                                </h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="MyProfile.php?dlfv=<?php echo $qq['game_id'] ?>" class="btn btn-danger btn-sm">
                                            DELETE
                                        </a>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <?php
    } else {
        ?>
        <div class='mt-4' style="color:white;">
        <?php
        echo "You don't have any favorites";
        ?>
        </div>
        <?php
    }

    if (isset($_GET['dlfv'])) {
        $delete = "DELETE FROM tbl_favourite WHERE who = '$who' AND game_id = '" . $_GET['dlfv'] . "' AND id = " . $_SESSION['uid'];
        if ($conn->query($delete)) {
            ?>
            <script>
                alert("Deleted");
                window.location = "MyProfile.php";
            </script>
            <?php
        }
    }
    ?>

</body>

<!-- Include Bootstrap and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<?php
ob_end_flush();
include('Foot.php');
?>

</html>