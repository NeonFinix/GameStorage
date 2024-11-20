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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SearchGame</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card {
            margin-bottom: 20px;
            /* Add some margin to create space between cards */
            height: 100%;
            /* Ensure all cards have the same height */
        }
    </style>
</head>

<body>
    <div class="container">
        <form>
            <div class="text-center mt-4">
                <input type="text" class="form-control" id="txt_name" name="txt_name" value=""
                    placeholder="Search by name" onkeyup="searchGame(this.value, 0)"
                    style="background-color:black; color: white ;" />
                <select class="form-control mt-2" name="txt_select" id="txt_select"
                    onchange="searchGame(document.getElementById('txt_name').value, this.value)"
                    style="background-color:black; color: white ;">
                    <option value="0">-- Select Genre --</option>
                    <?php
                    $view = "SELECT * FROM tbl_genre";
                    $vis = $conn->query($view);
                    while($show = $vis->fetch_assoc()) {
                        ?>
                        <option value="<?php echo $show['genre_id'] ?>">
                            <?php echo $show['genre_name'] ?>
                        </option>
                        <?php
                    }
                    ?>
                </select>
            </div>
        </form>

        <div id="mydiv" class="mt-4">
            <div class="row">
                <?php
                $i = 0;
                $gel = "SELECT * FROM ((tbl_genre INNER JOIN tbl_games ON tbl_genre.genre_id = tbl_games.genre_id) INNER JOIN tbl_dev ON tbl_games.company_id = tbl_dev.company_id) where tbl_games.genre_id = tbl_genre.genre_id and tbl_games.game_status = 1";
                $gelect = $conn->query($gel);
                while($data = $gelect->fetch_assoc()) {
                    $i++;
                    ?>
                    <div class="col-md-3">
                        <div class="card h-100"> <!-- Add class "h-100" for card height -->
                            <a href="ViewGame.php?kid=<?php echo $data['game_id'] ?>"><img
                                    src="../Assets/Files/Developer/GameLogo/<?php echo $data['game_logo'] ?>"
                                    class="card-img-top" alt="<?php echo $data['game_name'] ?>"></a>
                            <div class="card-body" style="padding-top: 0px; padding-bottom: 0px;">
                                <?php


                                $average_rating = 0;
                                $total_review = 0;
                                $five_star_review = 0;
                                $four_star_review = 0;
                                $three_star_review = 0;
                                $two_star_review = 0;
                                $one_star_review = 0;
                                $total_user_rating = 0;
                                $review_content = array();

                                $query = "SELECT * FROM tbl_rating where game_id = '".$data["game_id"]."' ORDER BY rating_id DESC";

                                $result = $conn->query($query);

                                while($row = $result->fetch_assoc()) {


                                    if($row["rating_value"] == '5') {
                                        $five_star_review++;
                                    }

                                    if($row["rating_value"] == '4') {
                                        $four_star_review++;
                                    }

                                    if($row["rating_value"] == '3') {
                                        $three_star_review++;
                                    }

                                    if($row["rating_value"] == '2') {
                                        $two_star_review++;
                                    }

                                    if($row["rating_value"] == '1') {
                                        $one_star_review++;
                                    }

                                    $total_review++;

                                    $total_user_rating = $total_user_rating + $row["rating_value"];

                                }


                                if($total_review == 0 || $total_user_rating == 0) {
                                    $average_rating = 0;
                                } else {
                                    $average_rating = round($total_user_rating / $total_review);
                                }

                                ?>
                                <p align="center" style="color:#F96;font-size:20px">
                                    <?php
                                    if($average_rating == 5 || $average_rating == 4.5) {
                                        ?>
                                        <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                                        <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                                        <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                                        <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                                        <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                                        <?php
                                    }
                                    if($average_rating == 4 || $average_rating == 3.5) {
                                        ?>
                                        <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                                        <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                                        <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                                        <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                                        <i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
                                        <?php
                                    }
                                    if($average_rating == 3 || $average_rating == 2.5) {
                                        ?>
                                        <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                                        <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                                        <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                                        <i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
                                        <i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
                                        <?php
                                    }
                                    if($average_rating == 2 || $average_rating == 1.5) {
                                        ?>
                                        <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                                        <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                                        <i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
                                        <i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
                                        <i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
                                        <?php
                                    }
                                    if($average_rating == 1) {
                                        ?>
                                        <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                                        <i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
                                        <i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
                                        <i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
                                        <i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
                                        <?php
                                    }
                                    if($average_rating == 0) {
                                        ?>
                                        <i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
                                        <i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
                                        <i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
                                        <i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
                                        <i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
                                        <?php
                                    }
                                    ?>

                                </p>

                            </div>
                            <div class="card-footer">
                                <p class="text-center mb-0" style="color: #333">
                                    <a href="ViewGame.php?kid=<?php echo $data['game_id'] ?>">
                                        <?php echo $data['game_name'] ?></a>
                                </p>
                                <p class="text-center mb-0" style="color: #333">
                                    <?php echo $data['company_name'] ?>
                                </p>
                                <p class="text-center mb-0" style="color: #333">
                                    <?php echo $data['genre_name'] ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php
                    if($i == 4) {
                        echo "</div>";
                        echo "<br>";
                        $i = 0;
                        echo "<div class='row'>";
                    }
                }
                ?>
            </div>
        </div>
    </div>
</body>
<!-- Include Bootstrap and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    function searchGame(gid, cid) {
        $.ajax({
            url: "../Assets/AjaxPages/AjaxGame.php?gid=" + gid + "&cid=" + cid,
            success: function (html) {
                $("#mydiv").html(html);
            }
        });
    }
</script>
<?php
ob_end_flush();
include('Foot.php');
?>

</html>