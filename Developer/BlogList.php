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
    <title>Blog List</title>
</head>

<body>
    <!-- breadcrumb start-->
    <section class="breadcrumb breadcrumb_bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb_iner text-center">
                        <div class="breadcrumb_iner_item">
                            <h2>blog</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb start-->

    <!--================Blog Area =================-->
    <section class="blog_area section_padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 mb-5 mb-lg-0">
                    <div class="blog_left_sidebar">
                        <?php
                        $SelQuery = "select * from tbl_blog order by date desc";
                        $row = $conn->query($SelQuery);
                        while ($data = $row->fetch_assoc()) {
                            ?>
                            <article class="blog_item">
                                <div class="blog_item_img">
                                    <?php $logo = "select * from tbl_blog inner join tbl_user where tbl_blog.user_id = tbl_user.user_id and tbl_blog.blog_id = " . $data['blog_id'];
                                    $logo1 = $conn->query($logo);
                                    $info = $logo1->fetch_assoc();
                                    ?>
                                    <img class="card-img rounded-0"
                                        src="../Assets/Files/User/Logo/<?php echo $info['user_logo'] ?>" alt="user_logo"
                                        style="width: 400px;border-radius: 50%;">
                                    <?php
                                    $date = new DateTime($data['date']);
                                    $formatted_month = $date->format('M'); // Format to display first three letters of the month and day
                                    $formatted_date = $date->format('d'); // Format to display first three letters of the month and day
                                    ?>
                                    <a class="blog_item_date">
                                        <h3>
                                            <?php
                                            echo $formatted_date;
                                            ?>
                                        </h3>
                                        <p>
                                            <?php
                                            echo $formatted_month;
                                            ?>
                                        </p>
                                    </a>
                                </div>

                                <div class="blog_details">
                                    <h2>
                                        <a href="viewblog.php?bid=<?php echo $data['blog_id'] ?>">
                                            <?php echo $data['title'] ?>
                                        </a>
                                    </h2>

                                    <?php
                                    // $content = $data['content'];
                                    // $words = str_word_count($content, 1); // Split the content into an array of words
                                    // $first_20_words = implode(' ', array_slice($words, 0, 10)); // Take the first 20 words and join them back into a string
                                    // echo $first_20_words;
                                    ?>
                                    <!-- <a href="viewblog.php?bid=<?php //echo $data['blog_id'] ?>">...viewmore</a> -->
                                </div>
                            </article>
                            <?php
                        }
                        ?>



                    </div>
                </div>

            </div>
        </div>
    </section>
    <!--================Blog Area =================-->


</body>
<?php
ob_end_flush();
include('Foot.php');
?>

</html>