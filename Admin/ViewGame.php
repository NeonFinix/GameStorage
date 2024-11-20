<?php
ob_start();
include("Head.php");
include('../Assets/Connection/Connection.php');
if (isset($_GET['sts'])) {
    $up = "update tbl_games set game_status = 2 where game_id = " . $_GET['sts'];
    if ($conn->query($up)) {
        ?>
        <script>
            alert("Suspended");
            window.location = "Search.php";
        </script>
        <?php
    }

}
if (isset($_GET['rej'])) {
    $up = "update tbl_games set game_status = 1 where game_id = " . $_GET['rej'];
    if ($conn->query($up)) {
        ?>
        <script>
            alert("Revoked");
            window.location = "Search.php";
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
    <title>View Game</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+WyOxFf5K7O8gjM8E2OQumFMyt2Wt+JvKV" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
        integrity="sha384-vpNcRldQFKkUQigP1A8GjrnEs06IT+AJ8qC3s/8WQpmkAA" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">

    <style>
        .swiper-pagination-bullet {
            opacity: 1;
            border: white solid 1px;
            background-color: black;
        }

        .swiper-pagination-bullet-active {
            background-color: white;
        }

        .swiper-container {
            width: 100%;
            margin: auto;

        }

        .swiper-slide img {
            width: 100%;
            height: auto;
        }
    </style>
</head>

<body>
    <form id="form1" name="form1" method="post" action="">
        <div class="container">
            <?php
            $ind = "select * from tbl_games gs inner join tbl_dev d on gs.company_id=d.company_id inner join tbl_genre gr on gs.genre_id=gr.genre_id where game_id=" . $_GET["kid"];
            $geti = $conn->query($ind);
            $data = $geti->fetch_assoc();
            ?>
            <input type="hidden" name="txt_gid" id="txt_gid" value="<?php echo $_GET["kid"]; ?>" />
            <div class="row mt-4">
                <div class="col-md-4">
                    <img src="../Assets/Files/Developer/GameLogo/<?php echo $data['game_logo'] ?>"
                        class="img-fluid user-logo" alt="Game Logo" style="max-width: 300px;">
                </div>
                <div class="col-md-8">
                    <table class="table table-bordered" style="color: white;">
                        <tbody>
                            <tr>
                                <th width="30%">Name</th>
                                <td>
                                    <?php echo $data['game_name'] ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Developers</th>
                                <td>
                                    <?php echo $data['company_name'] ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Game ID</th>
                                <td>
                                    <?php echo $data['game_id'] ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Genre</th>
                                <td>
                                    <?php
                                    $gg = "SELECT * FROM tbl_games WHERE game_id = " . $_GET['kid'];
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
                            </tr>
                            <tr>
                                <th>Description</th>
                                <td>
                                    <?php echo $data['description'] ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Release Date</th>
                                <td>
                                    <?php echo $data['release_date'] ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Platforms</th>
                                <td>
                                    <?php
                                    $kid = "SELECT * FROM tbl_games WHERE game_id = " . $_GET['kid'];
                                    $kid1 = $conn->query($gg);
                                    while ($kid2 = $kid1->fetch_assoc()) {
                                        $kid3 = $kid2['platform_id'];
                                        $comma = ",";
                                        $print = explode($comma, $kid3);
                                        foreach ($print as $value) {
                                            $qry = "select * from tbl_platform where platform_id = " . $value;
                                            $qry1 = $conn->query($qry);
                                            $qry2 = $qry1->fetch_assoc();
                                            echo $qry2['platform_name'] . "<br>";
                                        }
                                    }
                                    ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-md-6" style="padding-left: 12vmin;">
                    <p style="color:#F96;font-size:20px;">
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
                            $average_rating = round($total_user_rating / $total_review);
                        }

                        ?>
                    <p align="center" style="color:#F96;font-size:20px;display: contents">
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
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <?php if ($data['game_status'] == "1") {
                        ?> <a href="ViewGame.php?sts=<?php echo $data["game_id"] ?>"
                            style="padding-left: 70px">SUSPEND</a>
                        <?php
                    } else if ($data["game_status"] == "2") {
                        ?> <a href="ViewGame.php?rej=<?php echo $data["game_id"] ?>"
                                style="padding-left: 70px">REVOKE</a>
                        <?php
                    } ?>
                </div>
            </div>
            <br>
            <h3>Video</h3>
            <div class="row mt-4">
                <div class="col-md-12">
                    <div id="video-container">
                        <iframe width="560" height="315"
                            src="https://www.youtube.com/embed/<?php echo $data['trailer'] ?>" frameborder="0"
                            allowfullscreen></iframe>
                    </div>
                    <br>
                    <h3>Screenshots</h3>
                    <br>
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            <!-- Add your slides with images -->
                            <div class="swiper-slide" style="padding-left: 15%;"><img
                                    src="../Assets/Files/Developer/Screenshots/<?php echo $data['screenshot1'] ?>"
                                    alt="Screenshot 1" style="max-width: 800px;"></div>
                            <div class="swiper-slide" style="padding-left: 15%;"><img
                                    src="../Assets/Files/Developer/Screenshots/<?php echo $data['screenshot2'] ?>"
                                    alt="Screenshot 2" style="max-width: 800px;"></div>
                            <div class="swiper-slide" style="padding-left: 15%;"><img
                                    src="../Assets/Files/Developer/Screenshots/<?php echo $data['screenshot3'] ?>"
                                    alt="Screenshot 3" style="max-width: 800px;"></div>
                            <div class="swiper-slide" style="padding-left: 15%;"><img
                                    src="../Assets/Files/Developer/Screenshots/<?php echo $data['screenshot4'] ?>"
                                    alt="Screenshot 4" style="max-width: 800px;"></div>
                            <div class="swiper-slide" style="padding-left: 15%;"><img
                                    src="../Assets/Files/Developer/Screenshots/<?php echo $data['screenshot5'] ?>"
                                    alt="Screenshot 5" style="max-width: 800px;"></div>
                            <!-- Add more slides as needed -->
                        </div>
                        <!-- Add pagination and navigation if desired -->
                        <br>
                        <div class="swiper-pagination"></div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>

                    <br>
                </div>
            </div>
            <?php
            $bb = "SELECT * from tbl_events where game_id = " . $_GET["kid"];
            $bet = $conn->query($bb);
            if ($bet->num_rows > 0) {
                $hh = mysqli_fetch_assoc($bet);
                ?>
                <h3 style="color: white; font-family: system-ui;">EVENTS HAPPENING NOW!!</h3><br>
                <h4 style="color: white; font-family: monospace;">
                    <?php echo $hh['event_name']; ?>
                    </h5>
                    <br>
                    <h4>DESCRIPTION</h4>
                    <h6 style="font-family: monospace;">
                        <?php echo $hh['event_desc']; ?>
                        <br><br> End Date -
                        <?php echo $hh['end_date']; ?>
                    </h6>
                    <?php
            } else {
                ?>
                    <h3>NO EVENTS</h3>
                    <?php
            }
            ?>
        </div>

    </form>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"
        integrity="sha384-d54JMEzmL15o/3b5l+ZYT27xiSxFuKlVNxI5PnACq2QCPL2Qp5p5K0p+1ShS1bfh"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+WyOxFf5K7O8gjM8E2OQumFMyt2Wt+JvKV"
        crossorigin="anonymous"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper('.swiper-container', {
            // Optional: Add pagination and navigation
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    </script>

</body>

</html>
<?php
ob_end_flush();
include('Foot.php');
?>