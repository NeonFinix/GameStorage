<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../Assets/phpMail/src/Exception.php';
require '../Assets/phpMail/src/PHPMailer.php';
require '../Assets/phpMail/src/SMTP.php';
include('../Assets/Connection/Connection.php');
ob_start();
include("Head.php");
if (isset($_POST['submit'])) {
    // Change 'reply' to the appropriate name if needed
    $email = $_POST['reply'];
    $reply = $_POST['msg'];
    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'gamestoragesfaq@gmail.com'; // Your gmail
    $mail->Password = 'kfzkpgtrqunxhnjt'; // Your gmail app password
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setFrom('gamestoragesfaq@gmail.com'); // Your gmail

    $mail->addAddress($email);

    $mail->isHTML(true);

    $mail->Subject = 'Complaint';
    $mail->Body = "Hello, " . $reply;
    if ($mail->send()) {
        ?>
        <script>
            alert("mail sent");
            window.location="Complaint.php";
        </script>
        <?php
    } else {
        echo "Failed";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reply</title>
</head>

<body>
    <form method="POST">
        <!-- Add a hidden input field to pass the email -->
        <input type="hidden" name="reply" value="<?php echo $_GET['reply']; ?>">
        <textarea name="msg" id="" cols="30" rows="10"></textarea><br>
        <input type="submit" value="Send" name="submit">
    </form>
</body>
<?php
ob_end_flush();
include('Foot.php');
?>
</html>