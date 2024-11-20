<?php
ob_start();
include("Head.php");
include('../Assets/Connection/Connection.php');
session_start();
?>


<!doctype html>
<html lang="zxx">

<head>
   <!-- Required meta tags -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <title>Viewblog</title>
   <link rel="icon" href="../Assets/Templates/Main/img/favicon.png">
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
   <style>
      h2 {
         color: whitesmoke !important;
      }

      h3 {
         color: white !important;
      }

      h4 {
         color: white !important;
      }
      h5{
         color: white !important;
      }

      p {
         color: white !important;
      }

      li {
         color: white !important;
      }
   </style>
</head>

<body>


   <!-- breadcrumb start-->

   <!--================Blog Area =================-->
   <section class="blog_area single-post-area section_padding">
      <div class="container">
         <div class="row">
            <div class="col-lg-12 posts-list">
               <?php
               $SelQuery = "select * from tbl_blog where blog_id = " . $_GET['bid'];
               $row = $conn->query($SelQuery);
               $data = $row->fetch_assoc();
               ?>
               <div class="single-post">
                  <div class="feature-img">
                     <?php $logo = "select * from tbl_blog inner join tbl_user where tbl_blog.user_id = tbl_user.user_id and tbl_blog.blog_id = " . $_GET['bid'];
                     $logo1 = $conn->query($logo);
                     $info = $logo1->fetch_assoc();
                     ?>
                     <img class="card-img rounded-0" src="../Assets/Files/User/Logo/<?php echo $info['user_logo'] ?>"
                        alt="user_logo" style="width: 400px;border-radius: 50%;">
                     <h4>Written By :
                        <?php echo $info['name'] ?></h4>
                        <h5>Uploaded at :<?php echo $info['date'] ?></h5>
                  </div>
                  <div class="blog_details">
                     <h2>
                        <?php
                        echo $data['title'];
                        ?>
                     </h2>
                     <?php
                     echo $data['content']
                        ?>

                  </div>
               </div>

            </div>

         </div>
      </div>
   </section>
   <!--================Blog Area end =================-->


   <?php
   ob_end_flush();
   include('Foot.php');
   ?>
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

</html>