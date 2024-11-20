<?php
include('../Assets/Connection/Connection.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Login</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Favicon -->
  <link href="img/favicon.ico" rel="icon">

  <!-- Google Web Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap"
    rel="stylesheet">

  <!-- Icon Font Stylesheet -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Libraries Stylesheet -->
  <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

  <!-- Customized Bootstrap Stylesheet -->
  <link href="../Assets/Templates/Admin/css/bootstrap.min.css" rel="stylesheet">

  <!-- Template Stylesheet -->
  <link href="../Assets/Templates/Admin/css/style.css" rel="stylesheet">
</head>

<body>
  <div class="container-fluid position-relative d-flex p-0">

    <!-- Sign In Start -->
    <div class="container-fluid">
      <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
        <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
          <div class="bg-secondary rounded p-4 p-sm-5 my-4 mx-3">
            <div class="d-flex align-items-center justify-content-between mb-3">
              <!-- <a href="index.html" class=""> -->
                <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>GameStorage</h3>
              </a>
              <h3>Log In</h3>
            </div>
            <form method="POST">
            <div class="form-floating mb-3">
              <input type="text" name="user_name" class="form-control" required>
              <label for="floatingInput">E-mail</label>
            </div>
            <div class="form-floating mb-4">
              <input type="password" name="txt_pswd" class="form-control" required>
              <label for="floatingPassword">Password</label>
            </div>
            <!-- <div class="d-flex align-items-center justify-content-between mb-4">
             <a href="">Forgot Password</a>
            </div> -->
            <input type="submit" value="Submit" name="submit" class="btn btn-primary py-3 w-100 mb-4">
            <div align="center">
              <p>Don't Have an Account</p>
              <a href="UserRegistration.php">Register as User</a>
              <br>
              <a href="DeveloperRegistration.php">Register as Developer</a>
            </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- Sign In End -->
  </div>

  <!-- JavaScript Libraries -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="lib/chart/chart.min.js"></script>
  <script src="lib/easing/easing.min.js"></script>
  <script src="lib/waypoints/waypoints.min.js"></script>
  <script src="lib/owlcarousel/owl.carousel.min.js"></script>
  <script src="lib/tempusdominus/js/moment.min.js"></script>
  <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
  <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

  <!-- Template Javascript -->
  <script src="js/main.js"></script>
</body>
</html>
<?php
if (isset($_POST['submit']))
 {
  $u_name = $_POST['user_name'];
  $u_pswd = $_POST['txt_pswd'];
  $seldev = "select * from tbl_dev where company_email = '".$u_name."' and company_pswd = '" . $u_pswd . "' and status = 1";
  $resultdev = $conn->query($seldev);

  $selUser = "select * from tbl_user where user_email = '".$u_name."' and user_pswd = '" . $u_pswd . "'";
  $resultuser = $conn->query($selUser);

  $seladmin = "select * from tbl_admin where admin_email = '".$u_name."' and admin_password = '" . $u_pswd . "'";
  $resultadmin = $conn->query($seladmin);
  if ($resultdev->num_rows > 0) {
    $row = $resultdev->fetch_assoc();
    $_SESSION['did'] = $row['company_id'];
    header('location:../Developer/HomePage.php');
  } else if ($resultuser->num_rows > 0) {
    $row = $resultuser->fetch_assoc();
    $_SESSION['uid'] = $row['user_id'];
    header('location:../User/HomePage.php');
  } else if ($resultadmin->num_rows > 0) {
    $row = $resultadmin->fetch_assoc();
    $_SESSION['aid'] = $row['admin_id'];
    header('location:../Admin/HomePage.php');
  } else {
    ?>
        <script>
          alert("INCORRECT USERNAME OR PASSWORD!!");
          window.location = "Login.php";
        </script>
  <?php
  }
}
?>