<?php
ob_start();
include("Head.php");
include('../Assets/Connection/Connection.php');
session_start();
include("session.php");
$select = "select *from tbl_user where user_id =" . $_SESSION['uid'];
$row = $conn->query($select);
$data = $row->fetch_assoc();

$birthDate = new DateTime($dob = $data['dob']);
$currdate = new DateTime();
$age = $currdate->diff($birthDate);
$agey = $age->y;
if ($agey > $data['age']) {
    $up = "update tbl_user set age = '$agey' where user_id = " . $_SESSION['uid'];
    $conn->query($up);
}
?>
<!doctype html>
<html lang="zxx">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>GameStorage</title>
    <link rel="icon" href="img/favicon.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../Assets/Templates/Main/css/bootstrap.min.css">
    <!-- animate CSS -->
    <link rel="stylesheet" href="../Assets/Templates/Main/css/animate.css">
    <!-- owl carousel CSS -->
    <link rel="stylesheet" href="../Assets/Templates/Main/css/owl.carousel.min.css">
    <!-- font awesome CSS -->
    <link rel="stylesheet" href="../Assets/Templates/Main/css/all.css">
    <!-- flaticon CSS -->
    <link rel="stylesheet" href="../Assets/Templates/Main/css/flaticon.css">
    <link rel="stylesheet" href="../Assets/Templates/Main/css/themify-icons.css">
    <!-- font awesome CSS -->
    <link rel="stylesheet" href="../Assets/Templates/Main/css/magnific-popup.css">
    <!-- swiper CSS -->
    <link rel="stylesheet" href="../Assets/Templates/Main/css/slick.css">
    <!-- style CSS -->
    <link rel="stylesheet" href="../Assets/Templates/Main/css/style.css">
</head>

<body>
    <div class="body_bg">
        <!-- banner part start-->
        <section class="banner_part">
            <div class="container">
                <div class="row align-items-center justify-content-between">
                    <div class="col-lg-6 col-md-8">
                        <div class="banner_text">
                            <div class="banner_text_iner">
                                <h1>GameStorage</h1>
                                <p>Welcome to our expansive game database, where the world of gaming unfolds at your
                                    fingertips! Dive into a vast collection of games spanning various genres, platforms,
                                    and eras. Our platform offers a comprehensive repository of titles, providing
                                    enthusiasts and newcomers alike with a one-stop destination for discovering,
                                    exploring, and staying informed about the latest and greatest in the gaming
                                    universe. From classic gems to cutting-edge releases, our database is a treasure
                                    trove of information, featuring detailed game profiles, reviews, and
                                    community-driven discussions. Whether you're seeking nostalgic favorites or the
                                    hottest releases, our game database is your go-to resource for all things gaming.
                                    Join us in celebrating the diverse and dynamic world of games, and let the adventure
                                    begin!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- banner part start-->



        <!-- about_us part start-->
        <section class="about_us section_padding">
            <div class="container">
                <div class="row align-items-center justify-content-between">
                    <div class="col-md-5 col-lg-6 col-xl-6">
                        <?php
                        $tre = "SELECT *
                            FROM tbl_trending
                            INNER JOIN tbl_games ON tbl_games.game_id = tbl_trending.game_id";
                        $trend = $conn->query($tre);
                        $trending = $trend->fetch_assoc();
                        ?>
                        <div class="learning_img">
                            <img src="../Assets/Files/Developer/GameLogo/<?php echo $trending['game_logo'] ?>" alt="">
                        </div>
                    </div>
                    <div class="col-md-7 col-lg-6 col-xl-5">
                        <div class="about_us_text">
                            <h2>Trending Right Now</h2>
                            <br>
                            <h3>
                                <?php echo $trending['game_name'] ?>
                            </h3>
                            <p>
                                <?php echo $trending['description'] ?>
                            </p>
                            <a class="btn_1" href="AgeCheck.php?kid=<?php echo $trending['game_id'] ?>">View More</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- about_us part end-->

        <!--::about_us part start::-->
        <section class="live_stareams padding_bottom">
            <div class="container-fluid">
                <div class="row align-items-center justify-content-between">
                    <div class="col-md-2 offset-lg-2 offset-sm-1">
                        <div class="live_stareams_text">
                            <h2>New Releases</h2>
                            <a class="btn_1" href="NewReleases.php">View More</a>
                        </div>
                    </div>
                    <div class="col-md-7 offset-sm-1">
                        <div class="live_stareams_slide owl-carousel">
                            <div class="live_stareams_slide_img">
                                <?php
                                $ll = "select * from tbl_games  where game_status = 1 order by release_date desc limit 10";
                                $ll1 = $conn->query($ll);
                                while ($ll2 = $ll1->fetch_assoc()) {
                                    ?>
                                    <img src="../Assets/Files/Developer/GameLogo/<?php echo $ll2['game_logo'] ?>" alt="">
                                </div>
                                <div class="live_stareams_slide_img">
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--::about_us part end::-->



        <!-- gallery_part part start-->
        <section class="gallery_part section_padding">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-5">
                        <div class="section_tittle text-center">
                            <h2>Wallpaper Gallery</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="gallery_part_item">
                            <div class="grid">
                                <div class="grid-sizer"></div>
                                <?php
                                $wall = "select * from tbl_wallpaper order by date desc limit 8";
                                $wall1 = $conn->query($wall);
                                $i = 0;
                                while ($wall2 = $wall1->fetch_assoc()) {
                                    $n = rand(0, 2);
                                    ?>
                                    <a href="../Assets/Wallpaper/<?php echo $wall2['w_name'] ?>"
                                        class="grid-item bg_img img-gal grid-item--height-<?php echo $n ?>"
                                        style="background-image: url('../Assets/Wallpaper/<?php echo $wall2['w_name'] ?>')">
                                        <div class="single_gallery_item">
                                            <div class="single_gallery_item_iner">
                                                <div class="gallery_item_text">
                                                    <i class="ti-zoom-in"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- gallery_part part end-->

        <!-- use sasu part end-->
        <!-- <section class="upcomming_war">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="section_tittle text-center">
                            <h2>Upcoming Releases</h2>
                        </div>
                    </div>
                </div>
                <div class="upcomming_war_iner">
                    <div class="row justify-content-center align-items-center h-100">
                        <div class="col-10 col-sm-5 col-lg-3">
                            <div class="upcomming_war_counter text-center">
                                <h2>Dark Dragon</h2>
                                <div id="timer" class="d-flex justify-content-between">
                                    <div id="days"></div>
                                    <div id="hours"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> -->
        <!-- use sasu part end-->

        <!-- jquery plugins here-->
        <script src="../Assets/Templates/Main/js/jquery-1.12.1.min.js"></script>
        <!-- popper js -->
        <script src="../Assets/Templates/Main/js/popper.min.js"></script>
        <!-- bootstrap js -->
        <script src="../Assets/Templates/Main/js/bootstrap.min.js"></script>
        <!-- easing js -->
        <script src="../Assets/Templates/Main/js/jquery.magnific-popup.js"></script>
        <!-- swiper js -->
        <script src="../Assets/Templates/Main/js/swiper.min.js"></script>
        <!-- swiper js -->
        <script src="../Assets/Templates/Main/js/masonry.pkgd.js"></script>
        <!-- particles js -->
        <script src="../Assets/Templates/Main/js/owl.carousel.min.js"></script>
        <script src="../Assets/Templates/Main/js/jquery.nice-select.min.js"></script>
        <!-- slick js -->
        <script src="../Assets/Templates/Main/js/slick.min.js"></script>
        <script src="../Assets/Templates/Main/js/jquery.counterup.min.js"></script>
        <script src="../Assets/Templates/Main/js/waypoints.min.js"></script>
        <script src="../Assets/Templates/Main/js/contact.js"></script>
        <script src="../Assets/Templates/Main/js/jquery.ajaxchimp.min.js"></script>
        <script src="../Assets/Templates/Main/js/jquery.form.js"></script>
        <script src="../Assets/Templates/Main/js/jquery.validate.min.js"></script>
        <script src="../Assets/Templates/Main/js/mail-script.js"></script>
        <!-- custom js -->
        <script src="../Assets/Templates/Main/js/custom.js"></script>
</body>
<?php

ob_end_flush();
include('Foot.php');
?>

</html>