<?php
ob_start();
include("Head.php");
include('../Assets/Connection/Connection.php');
session_start();
if (isset($_GET['view'])) {
    $gg = "select * from tbl_games where game_id = " . $_GET['kid'];
    $gg1 = $conn->query($gg);
    $gg2 = $gg1->fetch_assoc();
    $updateView = $gg2['views'] + 1;
    $insert = "update tbl_games set views = $updateView where game_id = " . $_GET['kid'];
    $conn->query($insert);

    $insqry = "insert into tbl_count(user_id,game_id,view_date) values ('" . $_SESSION['uid'] . "','" . $_GET['kid'] . "',now())";
    if ($conn->query($insqry)) {
        ?>
        <script>
            window.location = "ViewGame.php?kid=<?php echo $_GET['kid'] ?>";
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
                                <td><a href="ShowProfile.php?dev=<?php echo $data['company_id'] ?>">
                                        <?php echo $data['company_name'] ?>
                                    </a></td>
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
                    <input type="submit" name="rate" id="rate" value="Rate This Game" class="btn btn-primary" />
                    <input type="submit" name="fav" value="Favorite" class="btn btn-success">
                    <input type="submit" name="wishlist" value="Wishlist" class="btn btn-info" />
                    <?php
                    $fav = "select count(game_id) as total from tbl_favourite where game_id = " . $data['game_id'];
                    $fav1 = $conn->query($fav);
                    $fav2 = $fav1->fetch_assoc()
                        ?>
                    <table style="color:#999;">
                        <tr>
                            <td> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-eye-fill" viewBox="0 0 16 16">
                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0" />
                                    <path
                                        d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7" />
                                </svg></td>
                            <td>
                                <?php echo $data['views'] ?>
                            </td>
                            <td>
                                &nbsp;
                                &nbsp;
                                &nbsp;
                            </td>
                            <?php $ch = "select * from tbl_favourite where game_id = '" . $data['game_id'] . "' and  who = 'user' and id = " . $_SESSION['uid'];
                            $ch1 = $conn->query($ch);
                            if ($ch1->num_rows > 0) {
                                $ch2 = $ch1->fetch_assoc(); ?>
                                <td><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red"
                                        class="bi bi-heart-fill" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314" />
                                    </svg></td>
                                <td>
                                    <?php echo $fav2['total'] ?>
                                </td>
                            <?php } else { ?>
                                <td><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-heart" viewBox="0 0 16 16">
                                        <path
                                            d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15" />
                                    </svg></td>
                                <td>
                                    <?php echo $fav2['total'] ?>
                                </td>
                            <?php } ?>
                        </tr>
                    </table>
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
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    </script>

</body>

</html>
<?php
if (isset($_POST['wishlist'])) {
    $go = "select * from tbl_wishlist where game_id = $data[game_id] and user_id = $_SESSION[uid]";
    $go1 = $conn->query($go);
    if ($go1->num_rows > 0) {
        $del = "delete from tbl_wishlist where game_id =$data[game_id] and user_id = $_SESSION[uid]";
        if ($delete = $conn->query($del)) {
            ?>
            <script>
                alert("Removed From Wishlist");
            </script>
            <?php
        }
    } else {
        $ins = "insert into tbl_wishlist (game_id,user_id) values ($data[game_id],$_SESSION[uid])";
        if ($inse = $conn->query($ins)) {
            ?>
            <script>
                alert("Added to Wishlist");
            </script>
            <?php
        }
    }
}
if (isset($_POST['rate'])) {
    ?>
    <script>
        window.location = "GameRating.php?gameid=<?php echo $data['game_id'] ?>";
    </script>
    <?php
}
if (isset($_POST['fav'])) {
    $who = "user";
    $go = "select * from tbl_favourite where who = '$who'and id = $_SESSION[uid] and game_id = $data[game_id]";
    $go1 = $conn->query($go);
    if ($go1->num_rows > 0) {
        $del = "delete from tbl_favourite where who = '$who' and id = $_SESSION[uid] and game_id =$data[game_id]";
        if ($delete = $conn->query($del)) {
            ?>
            <script>
                alert("Removed From Favourites");
                window.location="ViewGame.php?kid=<?php echo $data['game_id']?>";
            </script>
            <?php
        }
    } else {
        $ins = "insert into tbl_favourite(who,id,game_id) values ('$who',$_SESSION[uid],$data[game_id])";
        if ($inse = $conn->query($ins)) {
            ?>
            <script>
                alert("Added to Favourites");
                window.location="ViewGame.php?kid=<?php echo $data['game_id']?>";
            </script>
            <?php
        }
    }
}
ob_end_flush();
include('Foot.php');
?>