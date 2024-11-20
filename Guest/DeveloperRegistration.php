<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../Assets/phpMail/src/Exception.php';
require '../Assets/phpMail/src/PHPMailer.php';
require '../Assets/phpMail/src/SMTP.php';
include('../Assets/Connection/Connection.php');
if (isset($_POST['txt_submit'])) {
  $dev_name = $_POST['comp_name'];
  if (!preg_match("/^[a-zA-Z0-9]*$/", $dev_name)) {
    ?>
    <script>
      alert("Only letters and numbers allowed in Username");
    </script>
    <?php
  } else {
    $de = "SELECT company_name FROM tbl_dev WHERE company_name = '$dev_name'";
    $de1 = $conn->query($de);
    if ($de1->num_rows > 0) {
      ?>
      <script>
        alert("Username already in use");
      </script>
      <?php
    } else {
      $de = "SELECT username FROM tbl_user WHERE username = '$dev_name'";
      $de1 = $conn->query($de);
      if ($de1->num_rows > 0) {
        ?>
        <script>
          alert("Username already in use");
        </script>
        <?php
      } else {
        $dev_email = $_POST['comp_email'];
        if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $dev_email)) {
          ?>
          <script>
            alert("Invalid Email-ID");
          </script>
          <?php
        } else {
          $dem = "SELECT company_email from tbl_dev where company_email = '$dev_email'";
          $dem1 = $conn->query($dem);
          if ($dem1->num_rows > 0) {
            ?>
            <script>
              alert("Email already in use");
            </script>
            <?php
          } else {
            $em = "SELECT user_email from tbl_user where user_email = '$dev_email'";
            $em1 = $conn->query($em);
            if ($em1->num_rows > 0) {
              ?>
              <script>
                alert("Email already in use");
              </script>
              <?php
            } else {
              $dev_addr = $_POST['comp_addr'];
              $dev_pswd = $_POST['comp_pswd'];
              if (strlen($dev_pswd) <= '8') {
                ?>
                <script>
                  alert("Your Password Must Contain At Least 8 Characters!");
                </script>
                <?php
              } else {
                $proof = $_FILES['comp_proof']['name'];
                $path = $_FILES['comp_proof']['tmp_name'];
                move_uploaded_file($path, "../Assets/FIles/Developer/Proof/" . $proof);

                $logo = $_FILES['comp_logo']['name'];
                $path = $_FILES['comp_logo']['tmp_name'];
                move_uploaded_file($path, "../Assets/Files/Developer/Logo/" . $logo);

                $insQry = "INSERT INTO tbl_dev(company_name,company_email,company_address,company_pswd,company_proof,company_logo) VALUES ('" . $dev_name . "','" . $dev_email . "','" . $dev_addr . "','" . $dev_pswd . "','" . $proof . "','" . $logo . "')";
                if ($conn->query($insQry)) {
                  ?>
                  <script>
                    alert("Accunt Created!!");
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

                  $mail->addAddress($_POST["comp_email"]);

                  $mail->isHTML(true);

                  $mail->Subject = 'Welcome!';
                  $mail->Body = "*Welcome to GameStorage*
                  Hello ,
                  Welcome to CodeCrafters, where lines of code become masterpieces! 🚀 We're thrilled to have you on board as a developer in our vibrant community of coding wizards. Get ready to unleash your creativity and transform your ideas into digital reality!
                  We believe that every line of code you write is a step towards innovation, and we can't wait to see what you'll bring to the CodeCrafters table!
If you have any questions, need assistance, or just want to share your latest coding triumph, our support team and fellow developers are here for you. Happy coding!
Code on,
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
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Developer Registration</title>
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
                <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>Register as a Developer</h3>
                <!-- <h3>Register as a User</h3> -->
            </div>
            <div class="form-floating mb-3">
              <input type="text" name="comp_name" class="form-control" id="floatingTextNAME" placeholder="name" required>
              <label for="floatingTextNAME">Name of the Company</label>
            </div>
            <div class="form-floating mb-3">
              <input type="email" name="comp_email" class="form-control" id="floatingInputE"
                placeholder="name@example.com" required>
              <label for="floatingInputE">Company E-mail</label>
            </div>
            <div class="form-floating mb-3">
              <input type="text" name="comp_addr" class="form-control" id="floatingTextaddr" placeholder="address" required>
              <label for="floatingTextaddr">Address of the Company</label>
            </div>
            <div class="form-floating mb-3">
              <input type="file" name="comp_logo" class="form-control" id="floatingIMAGE" accept="image/*" required>
              <label for="floatingIMAGE">Profile picture</label>
            </div>
            <div class="form-floating mb-3">
              <input type="file" name="comp_proof" class="form-control" id="floatingproof" accept="image/*" required>
              <label for="floatingproof">Proof of the Company</label>
            </div>
            <div class="form-floating mb-4">
              <input type="password" name="comp_pswd" class="form-control" id="floatingPassword" placeholder="Password"
                required>
              <label for="floatingPassword">Password</label>
            </div>
            <input type="submit" name="txt_submit" id="submit" value="Sign Up" class="btn btn-primary py-3 w-100 mb-4" />
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