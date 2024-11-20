<?php
ob_start();
include("Head.php");
include('../Assets/Connection/Connection.php');
session_start();
include("session.php");

if (isset($_POST['submit'])) {
    $type = $_POST['radio'];
    $who = "User";
    $id = $_SESSION['uid'];
    $sub = $_POST['sub'];
    $descr = $_POST['descr'];

    $ins = "insert into tbl_complaint(type,who,id,subject,description) values ('$type','$who','$id','$sub','$descr')";
    if ($conn->query($ins)) {
        ?>
        <script>
            alert("Successful");
            window.location = "HomePage.php";
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
    <title>Complaint Form</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .mydiv {
            ;
            background-size: cover;
            /* or 'contain' depending on your preference */

            /* Set background repeat behavior */
            background-repeat: repeat;

            /* Center the background image */
            background-position: center;

            /* Add any other styles you want for the body */
            padding: 100px;
            font-family: Arial, sans-serif;
            /* Choose your preferred font */
            /* Add more styles as needed */
        }

        .form-container {
            max-width: 500px;
            margin:  50px 0 50px auto;;
            padding: 25px;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
    </style>
</head>

<body>
    <div class="mydiv" style="background-image: url('../Assets/Mains/collage-customer-experience-concept.jpg')">
        <div class="container form-container">
            <form method="post">
                <div class="form-group">
                    <label for="type">Type</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="radio" id="feed" value="feedback">
                        <label class="form-check-label" for="feed">Feedback</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="radio" id="comp" value="complaint">
                        <label class="form-check-label" for="comp">Complaint</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="sub">Subject</label>
                    <input type="text" class="form-control" id="sub" name="sub" required>
                </div>
                <div class="form-group">
                    <label for="descr">Description</label>
                    <textarea class="form-control" id="descr" name="descr" rows="5" required></textarea>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                    <button type="reset" class="btn btn-secondary">Cancel</button>
                </div>
            </form>
        </div>


</body>
</div>
<?php
ob_end_flush();
include('Foot.php');
?>

</html>