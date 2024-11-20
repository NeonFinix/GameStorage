<?php
ob_start();
include('../Assets/Connection/Connection.php');
session_start();
include('session.php');
$pfp0 = "select * from tbl_admin where admin_id = " . $_SESSION['aid'];
$pfp1 = $conn->query($pfp0);
$pfp = $pfp1->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>GameStorage | Admin</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="Asset/adminLogo/<?php echo $pfp['logo'] ?>" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="../Assets/Templates/Admin/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="../Assets/Templates/Admin/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../Assets/Templates/Admin/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../Assets/Templates/Admin/css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner"
            class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-secondary navbar-dark">
                <a href="HomePage.php" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>GameStorage</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle"
                            src="http://localhost/GameStorage/Project/Admin/Assets/adminLogo/<?php echo $pfp['logo'] ?>"
                            alt="pfp" style="width: 40px; height: 40px;">
                        <div
                            class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1">
                        </div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0">
                            <?php echo $pfp['admin_name'] ?>
                        </h6>
                        <span>Admin</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="HomePage.php" class="nav-item nav-link "><i
                            class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                    <a href="search.php" class="nav-item nav-link "><i class="fa fa-tachometer-alt me-2"></i>Search
                        Game</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                                class="fa fa-laptop me-2"></i>Verfication(Dev)</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="AcceptedDev.php" class="dropdown-item">Verified Developers</a>
                            <a href="Verification.php" class="dropdown-item">Pending</a>
                            <a href="RejectedDev.php" class="dropdown-item">Rejected Developers</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                                class="fa fa-laptop me-2"></i>Verfication(Game)</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="AcceptedGame.php" class="dropdown-item">Verified Games</a>
                            <a href="gameverify.php" class="dropdown-item">Pending</a>
                            <a href="RejectedGame.php" class="dropdown-item">Rejected Games</a>
                        </div>
                    </div>
                    <a href="GamesTotal.php" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2"></i>All
                        Games</a>
                    <a href="Wallpaper.php" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>Wallpapers</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                                class="far fa-file-alt me-2"></i>Report</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="GenreTotal.php" class="dropdown-item">Total Genres</a>
                            <a href="ViewPie.php" class="dropdown-item">Top 10 Games</a>
                            <a href="ViewCount.php" class="dropdown-item">Views</a>
                        </div>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                                    class="far fa-file-alt me-2"></i>Update Table</a>
                            <div class="dropdown-menu bg-transparent border-0">
                                <a href="Genres.php" class="dropdown-item">Update Genre</a>
                                <a href="platform.php" class="dropdown-item">Update Platforms</a>
                            </div>
                        </div>
                        <a href="Complaint.php" class="nav-item nav-link"><i
                                class="fa fa-tachometer-alt me-2"></i>Complaints</a>
                        <a href="Feedback.php" class="nav-item nav-link"><i
                                class="fa fa-tachometer-alt me-2"></i>Feedbacks</a>
                    </div>
            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
                <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-user-edit"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <!-- <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-envelope me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex">Message</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="../Assets/Templates/Admin/img/user.jpg" alt=""
                                        style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="../Assets/Templates/Admin/img/user.jpg" alt=""
                                        style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="../Assets/Templates/Admin/img/user.jpg" alt=""
                                        style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item text-center">See all message</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-bell me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex">Notificatin</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">Profile updated</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">New user added</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">Password changed</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item text-center">See all notifications</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="../Assets/Templates/Admin/img/user.jpg" alt=""
                                style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex">John Doe</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">My Profile</a>
                            <a href="#" class="dropdown-item">Settings</a>
                            <a href="#" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div> -->
            </nav>
            <!-- Navbar End -->


            <!-- Sale & Revenue Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-line fa-3x text-primary"></i>
                            <div class="ms-3">
                                <?php $us = "select count(*) as total from tbl_user";
                                $us1 = $conn->query($us);
                                $us2 = $us1->fetch_assoc() ?>
                                <p class="mb-2">Total Users</p>
                                <h6 class="mb-0">
                                    <?php echo $us2['total'] ?>
                                </h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-bar fa-3x text-primary"></i>
                            <div class="ms-3">
                                <?php $ga = "select count(*) as total from tbl_games";
                                $ga1 = $conn->query($ga);
                                $ga2 = $ga1->fetch_assoc() ?>
                                <p class="mb-2">Total Games</p>
                                <h6 class="mb-0">
                                    <?php echo $ga2['total'] ?>
                                </h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-area fa-3x text-primary"></i>
                            <div class="ms-3">
                                <?php $dev = "select count(*) as total from tbl_dev";
                                $dev1 = $conn->query($dev);
                                $dev2 = $dev1->fetch_assoc();
                                ?>
                                <p class="mb-2">Today Developers</p>
                                <h6 class="mb-0">
                                    <?php echo $dev2['total'] ?>
                                </h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-pie fa-3x text-primary"></i>
                            <div class="ms-3">
                                <?php $blog = "select count(*) as total from tbl_blog";
                                $blog1 = $conn->query($blog);
                                $blog2 = $blog1->fetch_assoc();
                                ?>
                                <p class="mb-2">Total blogs</p>
                                <h6 class="mb-0">
                                    <?php echo $blog2['total'] ?>
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sale & Revenue End -->

            <!-- Recent Sales Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Pending Developers Verifications</h6>
                        <a href="Verification.php">Show All</a>
                    </div>
                    <div class="table-responsive">
                        <?php
                        $sel = "select * from tbl_dev where status = 0";
                        $sele = $conn->query($sel);
                        if ($sele->num_rows > 0) {
                            ?>
                            <table class="table text-start align-middle table-bordered table-hover mb-0">
                                <thead>
                                    <tr class="text-white">
                                        <th scope="col">Company name</th>
                                        <th scope="col">Company Email</th>
                                        <th scope="col">Company Address</th>
                                        <th scope="col">Date of Joining</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sel = "select * from tbl_dev where status = 0 order by date_of_joining desc limit 10";
                                    $sele = $conn->query($sel);
                                    while ($row = $sele->fetch_assoc()) {
                                        ?>
                                        <tr>
                                            <td>
                                                <?php echo $row['company_name'] ?>
                                            </td>
                                            <td>
                                                <?php echo $row['company_email'] ?>
                                            </td>
                                            <td>
                                                <?php echo $row['company_address'] ?>
                                            </td>
                                            <td>
                                                <?php echo $row['date_of_joining'] ?>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <?php
                        } else {
                            echo "Nothings Here";
                        }
                        ?>
                    <br><br><br>
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Pending Game Verifications</h6>
                        <a href="gameverify.php">Show All</a>
                    </div>
                    <div class="table-responsive">
                        <?php
                        $sel = "select * from tbl_games inner join tbl_dev on tbl_games.company_id = tbl_dev.company_id where game_status = 0";
                        $sele = $conn->query($sel);
                        if ($sele->num_rows > 0) {
                            ?>
                            <table class="table text-start align-middle table-bordered table-hover mb-0">
                                <thead>
                                    <tr class="text-white">
                                        <th scope="col">Game Name</th>
                                        <th scope="col">Company Name</th>
                                        <th scope="col">Genre</th>
                                        <th scope="col">Minimum Age</th>
                                        <th scope="col">Release Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sel = "select * from tbl_games where game_status = 0 order by date_of_joining desc limit 10";
                                    $sele = $conn->query($sel);
                                    while ($row = $sele->fetch_assoc()) {
                                        ?>
                                        <tr>
                                            <td>
                                                <?php echo $row['game_name'] ?>
                                            </td>
                                            <td>
                                                <?php echo $row['company_name'] ?>
                                            </td>
                                            <td>
                                                <?php
                                                $gg = "SELECT * FROM tbl_games WHERE game_id = " . $data['game_id'];
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
                                            <td>
                                                <?php echo $row['min_age'] ?>
                                            </td>
                                            <td>
                                                <?php echo $row['release_date'] ?>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <?php
                        } else {
                            echo "Nothings Here";
                        }
                        ?>
                </div>
                <!-- Recent Sales End -->


                <!-- Widgets Start -->
                <!-- <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-md-6 col-xl-4">
                        <div class="h-100 bg-secondary rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <h6 class="mb-0">Complaints</h6>
                                <a href="">Show All</a>
                            </div>
                            <div class="d-flex align-items-center border-bottom py-3">
                                <img class="rounded-circle flex-shrink-0" src="../Assets/Templates/Admin/img/user.jpg"
                                    alt="" style="width: 40px; height: 40px;">
                                <div class="w-100 ms-3">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-0">Jhon Doe</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                    <span>Short message goes here...</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-xl-4">
                        <div class="h-100 bg-secondary rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="mb-0">Calender</h6>
                                <a href="">Show All</a>
                            </div>
                            <div id="calender"></div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-xl-4">
                        <div class="h-100 bg-secondary rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="mb-0">To Do List</h6>
                                <a href="">Show All</a>
                            </div>
                            <div class="d-flex mb-2">
                                <input class="form-control bg-dark border-0" type="text" placeholder="Enter task">
                                <button type="button" class="btn btn-primary ms-2">Add</button>
                            </div>
                            <div class="d-flex align-items-center border-bottom py-2">
                                <input class="form-check-input m-0" type="checkbox">
                                <div class="w-100 ms-3">
                                    <div class="d-flex w-100 align-items-center justify-content-between">
                                        <span>Short task goes here...</span>
                                        <button class="btn btn-sm"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center border-bottom py-2">
                                <input class="form-check-input m-0" type="checkbox">
                                <div class="w-100 ms-3">
                                    <div class="d-flex w-100 align-items-center justify-content-between">
                                        <span>Short task goes here...</span>
                                        <button class="btn btn-sm"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center border-bottom py-2">
                                <input class="form-check-input m-0" type="checkbox" checked>
                                <div class="w-100 ms-3">
                                    <div class="d-flex w-100 align-items-center justify-content-between">
                                        <span><del>Short task goes here...</del></span>
                                        <button class="btn btn-sm text-primary"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center border-bottom py-2">
                                <input class="form-check-input m-0" type="checkbox">
                                <div class="w-100 ms-3">
                                    <div class="d-flex w-100 align-items-center justify-content-between">
                                        <span>Short task goes here...</span>
                                        <button class="btn btn-sm"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center pt-2">
                                <input class="form-check-input m-0" type="checkbox">
                                <div class="w-100 ms-3">
                                    <div class="d-flex w-100 align-items-center justify-content-between">
                                        <span>Short task goes here...</span>
                                        <button class="btn btn-sm"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
                <!-- Widgets End -->


                <!-- Footer Start -->
                <div class="container-fluid pt-4 px-4">
                    <div class="bg-secondary rounded-top p-4">
                        <div class="row">
                            <div class="col-12 col-sm-6 text-center text-sm-start">
                                &copy; <a href="#">GameStorage</a>, All Right Reserved.
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Footer End -->
            </div>
            <!-- Content End -->


            <!-- Back to Top -->
            <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
        </div>

        <!-- JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="../Assets/Templates/Admin/lib/chart/chart.min.js"></script>
        <script src="../Assets/Templates/Admin/lib/easing/easing.min.js"></script>
        <script src="../Assets/Templates/Admin/lib/waypoints/waypoints.min.js"></script>
        <script src="../Assets/Templates/Admin/lib/owlcarousel/owl.carousel.min.js"></script>
        <script src="../Assets/Templates/Admin/lib/tempusdominus/js/moment.min.js"></script>
        <script src="../Assets/Templates/Admin/lib/tempusdominus/js/moment-timezone.min.js"></script>
        <script src="../Assets/Templates/Admin/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

        <!-- Template Javascript -->
        <script src="../Assets/Templates/Admin/js/main.js"></script>
</body>

</html>