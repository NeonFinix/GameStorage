<?php
include('../Assets/Connection/Connection.php');
ob_start();
include("Head.php");
if (isset($_GET['tre'])) {
    $t1 = "delete from tbl_trending where trending_id = " . $_GET['tre'];
    if ($t2 = $conn->query($t1)) {
        ?>
        <script>
            alert("Removed");
            window.location = "trending.php";
        </script>
        <?php
    }
}

if(isset($_POST['submit']))
{
    $id = $_POST["gameid"];
    $upp = "INSERT INTO `tbl_trending`(`game_id`) VALUES ('$id')";
    if($conn->query($upp)){
        ?>
        <script>
            alert("Added");
            window.location = "trending.php";
        </script>
        <?php
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trending</title>
</head>

<body>
    Make sure theres only one game here
    <?php $ss = "select * from tbl_trending";
    $ss1 = $conn->query($ss);
    if ($ss1->num_rows > 0) { ?>
        <table border="2" cellpadding=5>
            <tr>
                <td>Game</td>
                <td>Genre</td>
                <td>Action</td>
            </tr>
            <?php
            while ($ss2 = $ss1->fetch_assoc()) {
                $ga = "select * from tbl_games inner join tbl_trending where tbl_games.game_id = tbl_trending.game_id";
                $ga1 = $conn->query($ga);
                $ga2 = $ga1->fetch_assoc();
                ?>
                <tr>
                    <td>
                        <?php echo $ga2['game_name'] ?>
                    </td>
                    <td>
                        <?php
                        $gg = "SELECT * FROM tbl_games WHERE game_id = " . $ga2['game_id'];
                        $gg1 = $conn->query($gg);
                        while ($gg2 = $gg1->fetch_assoc()) {
                            $gg3 = $gg2['genre_id'];
                            $comma = ",";
                            $print = explode($comma, $gg3);
                            foreach ($print as $value) {
                                $qry = "select * from tbl_genre where genre_id = " . $value;
                                $qry1 = $conn->query($qry);
                                $qry2 = $qry1->fetch_assoc();
                                echo $qry2['genre_name'] . "<br>";
                            }
                        }
                        ?>
                    </td>
                    <td><a href="trending.php?tre=<?php echo $ga2['trending_id'] ?>">Delete</a></td>
                </tr>
                <?php
            }
            ?>
        </table>
        <?php
    } else {
        echo "<br>";
        echo "<br>";
        echo "Enter the Game ID ";
        ?>
        <form action="" method="POST">
        <input type="text" name="gameid" id="">
        <input type="submit" name="submit" value="SET">
        </form>
        <?php
    }
    ?>
</body>
<?php
ob_end_flush();
include("Foot.php");
?>

</html>