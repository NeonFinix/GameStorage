<?php
include('../Connection/Connection.php');
if($_GET['cid']==0)
{
$key = $_GET['gid'];
$i=0;
?>
<div class="container">
    <div id="mydiv" class="mt-4">
        <div class="row">
            <?php
            $i = 0;
            $gel = "SELECT * FROM ((tbl_genre INNER JOIN tbl_games ON tbl_genre.genre_id = tbl_games.genre_id) INNER JOIN tbl_dev ON tbl_games.company_id = tbl_dev.company_id) where tbl_games.game_name LIKE '%$key%' ";
            $gelect = $conn->query($gel);
            while ($data = $gelect->fetch_assoc()) {
                $i++;
                ?>
                <div class="col-md-3">
                    <div class="card h-100"> <!-- Add class "h-100" for card height -->
                        <a href="ViewGame.php?kid=<?php echo $data['game_id']?>"><img src="../Assets/Files/Developer/GameLogo/<?php echo $data['game_logo']?>"
                             class="card-img-top" alt="<?php echo $data['game_name'] ?>">
                        <div class="card-body">
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

                            $query = "SELECT * FROM tbl_rating where game_id = '" . $data["game_id"] . "' ORDER BY rating_id DESC";

                            $result = $conn->query($query);

                            while ($row = $result->fetch_assoc()) {


                                if ($row["rating_value"] == '5') {
                                    $five_star_review++;
                                }

                                if ($row["rating_value"] == '4') {
                                    $four_star_review++;
                                }

                                if ($row["rating_value"] == '3') {
                                    $three_star_review++;
                                }

                                if ($row["rating_value"] == '2') {
                                    $two_star_review++;
                                }

                                if ($row["rating_value"] == '1') {
                                    $one_star_review++;
                                }

                                $total_review++;

                                $total_user_rating = $total_user_rating + $row["rating_value"];

                            }


                            if ($total_review == 0 || $total_user_rating == 0) {
                                $average_rating = 0;
                            } else {
                                $average_rating = $total_user_rating / $total_review;
                            }

                            ?>
                            <p align="center" style="color:#F96;font-size:20px">
                                <?php
                                if ($average_rating == 5 || $average_rating == 4.5) {
                                    ?>
                                    <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                                    <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                                    <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                                    <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                                    <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                                    <?php
                                }
                                if ($average_rating == 4 || $average_rating == 3.5) {
                                    ?>
                                    <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                                    <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                                    <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                                    <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                                    <i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
                                    <?php
                                }
                                if ($average_rating == 3 || $average_rating == 2.5) {
                                    ?>
                                    <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                                    <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                                    <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                                    <i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
                                    <i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
                                    <?php
                                }
                                if ($average_rating == 2 || $average_rating == 1.5) {
                                    ?>
                                    <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                                    <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                                    <i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
                                    <i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
                                    <i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
                                    <?php
                                }
                                if ($average_rating == 1) {
                                    ?>
                                    <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                                    <i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
                                    <i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
                                    <i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
                                    <i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
                                    <?php
                                }
                                if ($average_rating == 0) {
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
                            <?php

                            $output = array(
                                'average_rating' => number_format($average_rating, 1),
                                'total_review' => $total_review,
                                'five_star_review' => $five_star_review,
                                'four_star_review' => $four_star_review,
                                'three_star_review' => $three_star_review,
                                'two_star_review' => $two_star_review,
                                'one_star_review' => $one_star_review,
                                'review_data' => $review_content
                            );
							?>
                        </div>
                        <div class="card-footer">
                            <p class="text-center mb-0" style="color: #333"><?php echo $data['game_name'] ?></p>
                            <p class="text-center mb-0" style="color: #333"><?php echo $data['company_name'] ?></p>
                            <p class="text-center mb-0" style="color: #333"><?php echo $data['genre_name'] ?></p>
                        </div>
                    </div>
                </div>
                <?php
                if ($i == 4) {
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
<?php
        }
else if($_GET['gid']==0)
{
$i=0;
?>
<div class="container">
    <div id="mydiv" class="mt-4">
        <div class="row">
            <?php
            $i = 0;
            $gel = "SELECT * FROM ((tbl_genre INNER JOIN tbl_games ON tbl_genre.genre_id = tbl_games.genre_id) INNER JOIN tbl_dev ON tbl_games.company_id = tbl_dev.company_id) where tbl_genre.genre_id = ".$GET['cid'];
            $gelect = $conn->query($gel);
            while ($data = $gelect->fetch_assoc()) {
                $i++;
                ?>
                <div class="col-md-3">
                    <div class="card h-100"> <!-- Add class "h-100" for card height -->
                        <a href="ViewGame.php?kid=<?php echo $data['game_id']?>"><img src="../Assets/Files/Developer/GameLogo/<?php echo $data['game_logo']?>"
                             class="card-img-top" alt="<?php echo $data['game_name'] ?>">
                        <div class="card-body">
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

                            $query = "SELECT * FROM tbl_rating where game_id = '" . $data["game_id"] . "' ORDER BY rating_id DESC";

                            $result = $conn->query($query);

                            while ($row = $result->fetch_assoc()) {


                                if ($row["rating_value"] == '5') {
                                    $five_star_review++;
                                }

                                if ($row["rating_value"] == '4') {
                                    $four_star_review++;
                                }

                                if ($row["rating_value"] == '3') {
                                    $three_star_review++;
                                }

                                if ($row["rating_value"] == '2') {
                                    $two_star_review++;
                                }

                                if ($row["rating_value"] == '1') {
                                    $one_star_review++;
                                }

                                $total_review++;

                                $total_user_rating = $total_user_rating + $row["rating_value"];

                            }


                            if ($total_review == 0 || $total_user_rating == 0) {
                                $average_rating = 0;
                            } else {
                                $average_rating = $total_user_rating / $total_review;
                            }

                            ?>
                            <p align="center" style="color:#F96;font-size:20px">
                                <?php
                                if ($average_rating == 5 || $average_rating == 4.5) {
                                    ?>
                                    <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                                    <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                                    <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                                    <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                                    <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                                    <?php
                                }
                                if ($average_rating == 4 || $average_rating == 3.5) {
                                    ?>
                                    <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                                    <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                                    <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                                    <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                                    <i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
                                    <?php
                                }
                                if ($average_rating == 3 || $average_rating == 2.5) {
                                    ?>
                                    <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                                    <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                                    <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                                    <i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
                                    <i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
                                    <?php
                                }
                                if ($average_rating == 2 || $average_rating == 1.5) {
                                    ?>
                                    <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                                    <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                                    <i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
                                    <i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
                                    <i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
                                    <?php
                                }
                                if ($average_rating == 1) {
                                    ?>
                                    <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                                    <i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
                                    <i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
                                    <i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
                                    <i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
                                    <?php
                                }
                                if ($average_rating == 0) {
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
                            <?php

                            $output = array(
                                'average_rating' => number_format($average_rating, 1),
                                'total_review' => $total_review,
                                'five_star_review' => $five_star_review,
                                'four_star_review' => $four_star_review,
                                'three_star_review' => $three_star_review,
                                'two_star_review' => $two_star_review,
                                'one_star_review' => $one_star_review,
                                'review_data' => $review_content
                            );
                            ?>
                        </div>
                        <div class="card-footer">
                            <p class="text-center mb-0" style="color: #333"><?php echo $data['game_name'] ?></p>
                            <p class="text-center mb-0" style="color: #333"><?php echo $data['company_name'] ?></p>
                            <p class="text-center mb-0" style="color: #333"><?php echo $data['genre_name'] ?></p>
                        </div>
                    </div>
                </div>
                <?php
                if ($i == 4) {
                    echo "</div>";
                    echo "<br>";
                    $i = 0;
                    echo "<div class='row'>";
                }
            }
            ?>
        </div>
    </div>
<?php
        }
else
{
$key = $_GET['gid'];
$i=0;
?>
<div class="container">
    <div id="mydiv" class="mt-4">
        <div class="row">
            <?php
            $i = 0;
            $gel = "SELECT * FROM ((tbl_genre INNER JOIN tbl_games ON tbl_genre.genre_id = tbl_games.genre_id) INNER JOIN tbl_dev ON tbl_games.company_id = tbl_dev.company_id) where tbl_games.game_name LIKE '%$key%' and tbl_genre.genre_id = ".$_GET['cid'];
            $gelect = $conn->query($gel);
            while ($data = $gelect->fetch_assoc()) {
                $i++;
                ?>
                <div class="col-md-3">
                    <div class="card h-100"> <!-- Add class "h-100" for card height -->
                        <a href="ViewGame.php?kid=<?php echo $data['game_id']?>"><img src="../Assets/Files/Developer/GameLogo/<?php echo $data['game_logo']?>"
                             class="card-img-top" alt="<?php echo $data['game_name'] ?>">
                        <div class="card-body">
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

                            $query = "SELECT * FROM tbl_rating where game_id = '" . $data["game_id"] . "' ORDER BY rating_id DESC";

                            $result = $conn->query($query);

                            while ($row = $result->fetch_assoc()) {


                                if ($row["rating_value"] == '5') {
                                    $five_star_review++;
                                }

                                if ($row["rating_value"] == '4') {
                                    $four_star_review++;
                                }

                                if ($row["rating_value"] == '3') {
                                    $three_star_review++;
                                }

                                if ($row["rating_value"] == '2') {
                                    $two_star_review++;
                                }

                                if ($row["rating_value"] == '1') {
                                    $one_star_review++;
                                }

                                $total_review++;

                                $total_user_rating = $total_user_rating + $row["rating_value"];

                            }


                            if ($total_review == 0 || $total_user_rating == 0) {
                                $average_rating = 0;
                            } else {
                                $average_rating = $total_user_rating / $total_review;
                            }

                            ?>
                            <p align="center" style="color:#F96;font-size:20px">
                                <?php
                                if ($average_rating == 5 || $average_rating == 4.5) {
                                    ?>
                                    <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                                    <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                                    <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                                    <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                                    <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                                    <?php
                                }
                                if ($average_rating == 4 || $average_rating == 3.5) {
                                    ?>
                                    <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                                    <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                                    <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                                    <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                                    <i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
                                    <?php
                                }
                                if ($average_rating == 3 || $average_rating == 2.5) {
                                    ?>
                                    <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                                    <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                                    <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                                    <i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
                                    <i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
                                    <?php
                                }
                                if ($average_rating == 2 || $average_rating == 1.5) {
                                    ?>
                                    <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                                    <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                                    <i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
                                    <i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
                                    <i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
                                    <?php
                                }
                                if ($average_rating == 1) {
                                    ?>
                                    <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                                    <i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
                                    <i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
                                    <i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
                                    <i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
                                    <?php
                                }
                                if ($average_rating == 0) {
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
                            <?php

                            $output = array(
                                'average_rating' => number_format($average_rating, 1),
                                'total_review' => $total_review,
                                'five_star_review' => $five_star_review,
                                'four_star_review' => $four_star_review,
                                'three_star_review' => $three_star_review,
                                'two_star_review' => $two_star_review,
                                'one_star_review' => $one_star_review,
                                'review_data' => $review_content
                            );
                            ?>
                        </div>
                        <div class="card-footer">
                            <p class="text-center mb-0" style="color: #333"><?php echo $data['game_name'] ?></p>
                            <p class="text-center mb-0" style="color: #333"><?php echo $data['company_name'] ?></p>
                            <p class="text-center mb-0" style="color: #333"><?php echo $data['genre_name'] ?></p>
                        </div>
                    </div>
                </div>
                <?php
                if ($i == 4) {
                    echo "</div>";
                    echo "<br>";
                    $i = 0;
                    echo "<div class='row'>";
                }
            }
            ?>
        </div>
    </div>
<?php
        }
    ?>