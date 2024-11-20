<?php
ob_start();
include("Head.php");
include('../Assets/Connection/Connection.php');

if(isset($_GET['edit']))
{
    $selg = "select * from tbl_games where game_id='".$_GET["edit"]."'";
    $rowg = $conn->query($selg);
    if($datag = $rowg->fetch_assoc())
    {
    ?>
    <form method="POST">
    <h4>Edit Minimum Age</h4>
    <input type="number" name="minage" id="min_age" value="<?php echo $datag['min_age'] ?>" >
    <input type="submit" value="Set" name="Set">
    </form>
    <?php
    if(isset($_POST['Set']))
    {
        $id = $_GET['edit'];
        $min = $_POST['minage'];

        $set = "UPDATE tbl_games set min_age='".$min."' where game_id='".$id."'";
        if($conn->query($set))
        { 
            header("location:GamesTotal.php");
        }
        
    }
    }
}

if (isset($_GET['sts'])) {
    $up = "update tbl_games set game_status = 1 where game_id = " . $_GET['sts'];
    if ($conn->query($up)) {
        ?>
        <script>
            alert("Suspended");
            window.location = "GamesTotal.php";
        </script>
        <?php
    }

}
if (isset($_GET['rej'])) {
    $up = "update tbl_games set game_status = 2 where game_id = " . $_GET['rej'];
    if ($conn->query($up)) {
        ?>
        <script>
            alert("Invoked");
            window.location = "GamesTotal.php";
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
    <title>All Rejected Games</title>
</head>
<body>
<?php
$get = "select * from tbl_games gs inner join tbl_dev d on gs.company_id=d.company_id inner join tbl_genre gr on gs.genre_id=gr.genre_id where gs.game_status = 2";
    $row = $conn->query($get);
    $i = 1;
    if($row->num_rows>0)
    {
    while ($data = $row->fetch_assoc()) {
    ?>
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">All Rejected Games</h6>
                            <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Logo</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Developers</th>
                                            <th scope="col">Genre</th>
                                            <th scope="col">Release date</th>
                                            <th scope="col">Platforms</th>
                                            <th scope="col">Min Age</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row"><?php echo $i ?></th>
                                            <td><img src="../Assets/Files/Developer/GameLogo/<?php echo $data['game_logo']?>"  class="img-fluid" style="max-width: 100px;">
                                            <td><?php echo $data['game_name']?></td>
                                            <td><?php echo $data['company_name']?></td>
                                            <td> <?php
                                                 $gg = "SELECT * FROM tbl_games WHERE game_id = ".$data['game_id'];
                                                    $gg1 = $conn->query($gg);
                                                        while ($gg2 = $gg1->fetch_assoc()) {
                                                            $gg3 = $gg2['genre_id'];
                                                            $comma = ",";
                                                            $print = explode($comma, $gg3);
                                                            foreach ($print as $value) {
                                                                $qry = "select * from tbl_genre where genre_id = ".$value;
                                                                $qry1 = $conn->query($qry);
                                                                $qry2 = $qry1->fetch_assoc();
                                                                echo $qry2['genre_name'] . "<br>";
                                                            }
                                                        }
                                                        ?></td>
                                            <td><?php echo $data['release_date']?></td>
                                            <td><?php
                                                    $kid = "SELECT * FROM tbl_games WHERE game_id = " .$data['game_id'];
                                                    $kid1 = $conn->query($gg);
                                                    while ($kid2 = $kid1->fetch_assoc()) {
                                                        $kid3 = $kid2['platform_id'];
                                                        $comma = ",";
                                                        $print = explode($comma, $kid3);
                                                        foreach ($print as $value) {
                                                            $qry = "select * from tbl_platform where platform_id = ".$value;
                                                            $qry1 = $conn->query($qry);
                                                            $qry2 = $qry1->fetch_assoc();
                                                            echo $qry2['platform_name'] . "<br>";
                                                        }
                                                    }
                                                    ?></td>
                                            <td><?php if($data['min_age'] !== "")
                                            { 
                                                echo $data["min_age"];
                                            ?> <br> <a href="GamesTotal.php?edit=<?php echo $data["game_id"] ?>">Edit</a> <?php
                                            }
                                            else
                                            {
                                                ?>  <a href="GamesTotal.php?edit=<?php echo $data["game_id"] ?>">Edit</a> <?php
                                            } ?>
                                            </td>
                                            <td>
                                            <?php if($data['game_status'] == "1")
                                            {
                                              ?> <a href="GamesTotal.php?rej=<?php echo $data["game_id"] ?>" >Suspend</a> <?php
                                            }
                                            else if($data["game_status"] == "2")
                                            {
                                                ?> <a href="GamesTotal.php?sts=<?php echo $data["game_id"] ?>" >Revoke</a> <?php
                                            }?>
                                            </td>
                                        </tr>
                                    </tbody>
                            </div>
                        </div>
                    </div>
        </table>
        <?php
        $i ++;
    }
}
else{
    echo "Nothing to see here";
}
        ?>
</body>
<?php
ob_end_flush();
  include('Foot.php');
  ?>
</html>