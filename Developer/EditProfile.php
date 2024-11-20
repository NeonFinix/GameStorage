<?php 
ob_start();
include("Head.php");
session_start(); 
include('../Assets/Connection/Connection.php');
include("session.php");

// Handle form submission
if(isset($_POST['submit']))
{
    $name = $_POST['txt_name'];
    $email = $_POST['txt_email'];
    $address = $_POST['txt_addr'];
    $contact = $_POST['txt_contact'];
    
    $update = "UPDATE tbl_dev SET company_name='$name', company_email='$email', company_address='$address', company_contact='$contact' WHERE company_id=".$_SESSION['did'];

    if($conn->query($update))
    {
        ?>
        <script>
            alert("Updated!!");
            window.location="HomePage.php";
        </script>
        <?php	
    }	
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Edit Profile</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="color: white;">
    <div class="container mt-5">
        <?php
        $selqry = "SELECT * FROM tbl_dev WHERE company_id=".$_SESSION['did'];
        $row = $conn->query($selqry);
        $data = $row->fetch_assoc();
        $name = $data["company_name"];
        $email = $data["company_email"];
        $address = $data["company_address"];
        ?>

        <form id="form1" name="form1" method="post" action="">
            <div class="row mb-3">
                <label for="txt_name" class="col-sm-2 col-form-label">Company Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="txt_name" id="txt_name" value="<?php echo $name?>" required />
                </div>
            </div>

            <div class="row mb-3">
                <label for="txt_email" class="col-sm-2 col-form-label">E-mail</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="txt_email" id="txt_email" value="<?php echo $email?>"required />
                </div>
            </div>

            <div class="row mb-3">
                <label for="txt_addr" class="col-sm-2 col-form-label">Address</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="txt_addr" id="txt_addr" value="<?php echo $address?>"required />
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-10 offset-sm-2">
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    <button type="reset" name="cancel" class="btn btn-secondary">Cancel</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

<?php
ob_end_flush();
include('Foot.php');
?>

</html>