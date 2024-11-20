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
    <title>WishList</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        .container {
            margin: 0 auto;
            /* background-color: #fff; */
            padding: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: left;
			color: crimson;
        }
        th {
            background-color: #333;
            color: #fff;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        a {
            text-decoration: none;
            color: #0074a2;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>WishList</h1>
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            $uid = $_SESSION['uid'];
            $ws = "SELECT * FROM tbl_games
                   INNER JOIN tbl_wishlist ON tbl_games.game_id = tbl_wishlist.game_id
                   INNER JOIN tbl_user ON tbl_wishlist.user_id = tbl_user.user_id
                   WHERE tbl_user.user_id = $uid";
            $row = $conn->query($ws);
            while ($data = $row->fetch_assoc()) {
                $i++;
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td>
                    <a href="ViewGame.php?kid=<?php echo $data['game_id']; ?>">
                        <img src="../Assets/Files/Developer/GameLogo/<?php echo $data['game_logo']; ?>" alt="Game Logo" width="150">
                        <?php echo $data['game_name']; ?>
                    </a>
                </td>
                <td>
                    <a href="WishList.php?did=<?php echo $data["game_id"]; ?>">Remove</a>
                </td>
            </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>
</body>
</html>

<?php
if (isset($_GET['did'])) {
    $gameId = $_GET['did'];
    $deleteQuery = "DELETE FROM tbl_wishlist WHERE game_id = $gameId AND user_id = $uid";
    if ($conn->query($deleteQuery)) {
        ?>
        <script>
            alert("Removed");
            window.location = "WishList.php";
        </script>
        <?php
    }
}
ob_end_flush();
include('Foot.php');
?>