<?php
  use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../Assets/phpMail/src/Exception.php';
require '../Assets/phpMail/src/PHPMailer.php';
require '../Assets/phpMail/src/SMTP.php';
include('../Assets/Connection/Connection.php');
if (isset($_POST['submit'])) {

  $name = $_POST['txt_name'];
  if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
    ?>
    <script>
      alert("Only letters and white space allowed in Name");
    </script>
    <?php
  } else {
    $u_name = $_POST['txt_username'];
    if (!preg_match("/^[a-zA-Z0-9]*$/", $u_name)) {
      ?>
      <script>
        alert("Only letters and numbers allowed in Username");
      </script>
      <?php
    } else {
      $de = "SELECT company_name FROM tbl_dev WHERE company_name = '$u_name'";
      $de1 = $conn->query($de);
      if ($de1->num_rows > 0) {
        ?>
        <script>
          alert("Username already in use");
        </script>
        <?php
      } else {
        $sc = "SELECT username FROM tbl_user WHERE username = '$u_name'";
        $sc1 = $conn->query($sc);
        if ($sc1->num_rows > 0) {
          ?>
          <script>
            alert("Username already in use");
          </script>
          <?php
        } else {
          $u_email = $_POST['user_email'];
          if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $u_email)) {
            ?>
            <script>
              alert("Invalid Email-ID");
            </script>
            <?php
          } else {
            $dem = "SELECT company_email from tbl_dev where company_email = '$u_email'";
            $dem1 = $conn->query($dem);
            if ($dem1->num_rows > 0) {
              ?>
              <script>
                alert("Email already in use");
              </script>
              <?php
            } else {
              $em = "SELECT user_email from tbl_user where user_email = '$u_email'";
              $em1 = $conn->query($em);
              if ($em1->num_rows > 0) {
                ?>
                <script>
                  alert("Email already in use");
                </script>
                <?php
              } else {
                $u_pswd = $_POST['user_pswd'];
                if (strlen($u_pswd) <= '8') {
                  ?>
                  <script>
                    alert("Your Password Must Contain At Least 8 Characters!");
                  </script>
                  <?php
                } else {
                  $logo = $_FILES['user_logo']['name'];
                  $path = $_FILES['user_logo']['tmp_name'];
                  move_uploaded_file($path, "../Assets/Files/User/Logo/" . $logo);

                  $dob = $_POST['txt_dob'];

                  $birthDate = new DateTime($dob);
                  $currdate = new DateTime();
                  $age = $currdate->diff($birthDate);
                  $agey = $age->y;

                  $insert = "INSERT INTO tbl_user(name,username,dob,age,user_email,user_pswd,user_logo) VALUES ('" . $name . "','" . $u_name . "','" . $dob . "','" . $agey . "','" . $u_email . "','" . $u_pswd . "','" . $logo . "')";
                  if ($conn->query($insert)) {
                    ?>
                    <script>
                      alert("Account Created");
                      window.location = "Login.php";
                    </script>
                    <?php
                    $mail = new PHPMailer(true);

                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'gamestoragesfaq@gmail.com'; // Your gmail
                    $mail->Password = 'kfzkpgtrqunxhnjt'; // Your gmail app password
                    $mail->SMTPSecure = 'ssl';
                    $mail->Port = 465;

                    $mail->setFrom('gamestoragesfaq@gmail.com'); // Your gmail

                    $mail->addAddress($_POST["user_email"]);

                    $mail->isHTML(true);

                    $mail->Subject = 'Welcome!';
                    $mail->Body = "*Welcome to GameStorage*
                          Hello there fellow gamer,

Welcome to the ultimate gamer's haven – GameStorage! 🎮 We're stoked to have you join our epic community of gaming enthusiasts. Get ready to embark on a journey where pixels come to life, and victories are celebrated like never before!

Here's your key to unlocking a world of gaming wonders:

🕹️ Player One, Ready: Dive into our extensive game database, where you can explore titles from every era and genre imaginable. Your next gaming obsession is just a click away.

👥 Party Up: Connect with fellow gamers who share your passion. Whether you're into RPGs, FPS, or MOBAs, there's a squad waiting to team up and conquer virtual worlds with you.

🏆 Achievement Unlocked: Earn badges and level up as you contribute to the community. Bragging rights are just a few missions away!

📚 Game Library: Create and organize your game library like a pro. Track your progress, rate your favorites, and showcase your gaming prowess.

📣 Stay in the Loop: Don't miss out on the latest gaming news, updates, and exclusive content. Our newsletters are your VIP pass to all things GameStorage.

Remember, this isn't just a website – it's a sanctuary for gamers, by gamers. So, buckle up, and let the gaming adventures begin!

If you have any questions or need assistance, our support team is just a message away. Happy gaming!

Game on,
The GameStorage Team 🚀";
                    if ($mail->send()) {
                      echo "Sended";
                    } else {
                      echo "Failed";
                    }
                  }
                  header('location:Login.php');
                }
              }
            }
          }
        }
      }
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>User Registration</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">


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
    <!-- Sign Up Start -->
    <div class="container-fluid">
      <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
        <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
          <div class="bg-secondary rounded p-4 p-sm-5 my-4 mx-3">
            <div class="d-flex align-items-center justify-content-between mb-3">
              <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
                <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>Register as a User</h3>
                <!-- <h3>Register as a User</h3> -->
            </div>
            <div class="form-floating mb-3">
              <input type="text" name="txt_name" class="form-control" id="floatingTextNAME" placeholder="name" required>
              <label for="floatingTextNAME">Name</label>
            </div>
            <div class="form-floating mb-3">
              <input type="text" name="txt_username" class="form-control" id="floatingTextUNAME" placeholder="username"
                required>
              <label for="floatingTextUNAME">Username</label>
            </div>
            <div class="form-floating mb-3">
              <input type="email" name="user_email" class="form-control" id="floatingInputE"
                placeholder="name@example.com" required>
              <label for="floatingInputE">Email address</label>
            </div>
            <div class="form-floating mb-3">
              <input type="file" name="user_logo" class="form-control" id="floatingIMAGE" accept="image/*" required>
              <label for="floatingIMAGE">Profile picture</label>
            </div>
            <div class="form-floating mb-3">
              <input type="date" name="txt_dob" class="form-control" id="floatingDOB" placeholder="YYYY-MM-DD" required>
              <label for="floatingDOB">Date of Birth</label>
            </div>
            <div class="form-floating mb-4">
              <input type="password" name="user_pswd" class="form-control" id="floatingPassword" placeholder="Password"
                required>
              <label for="floatingPassword">Password</label>
            </div>
            <input type="submit" name="submit" id="submit" value="Sign Up" class="btn btn-primary py-3 w-100 mb-4" />
            <p class="text-center mb-0">Already have an Account? <a href="Login.php">Sign In</a></p>
          </div>
          </form>
        </div>
      </div>
    </div>
    <!-- Sign Up End -->
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