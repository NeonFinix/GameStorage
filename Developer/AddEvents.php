<?php
ob_start();
include("Head.php");
include('../Assets/Connection/Connection.php');
session_start();
include("session.php");

if (isset($_POST['txt_submit'])) {
  $event = $_POST['txt_event'];
  $game = $_POST['txt_game'];
  $descr = $_POST['txt_descr'];
  $start = $_POST['txt_start'];
  $end = $_POST['txt_end'];
  $dev = $_SESSION['did'];

  $insert = "INSERT INTO tbl_events(event_name,game_id,company_id,event_desc,start_date,end_date) VALUES ('$event','$game','$dev','$descr','$start','$end')";
  if ($conn->query($insert)) {
    ?>
    <script>
      alert("Inserted!!");
      window.location = "AddEvents.php";
    </script>
    <?php
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Add Events</title>
  <!-- Add Bootstrap CSS link here -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <!-- Add your custom styles if needed -->
  <style>
    body {
      background-color: #f8f9fa;
      /* Set a background color */
    }
  </style>
</head>

<body style="color: white;">
  <div class="container">
    <form name="form1" method="post" action="">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="txt_game">Game</label>
            <select class="form-control" name="txt_game" id="txt_game" required>
              <?php
              $get = "SELECT * FROM tbl_games where company_id = " . $_SESSION['did'];
              $getl = $conn->query($get);
              while ($data = $getl->fetch_assoc()) {
                ?>
                <option value="<?php echo $data["game_id"] ?>">
                  <?php echo $data["game_name"] ?>
                </option>
                <?php
              }
              ?>
            </select>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="txt_event">Event Name</label>
            <input type="text" class="form-control" name="txt_event" id="txt_event" required>
          </div>
        </div>
      </div>

      <div class="form-group">
        <label for="txt_descr">Event Description</label>
        <textarea class="form-control" name="txt_descr" id="txt_descr" cols="45" rows="5" required></textarea>
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="txt_start">Start Date</label>
            <input type="date" class="form-control" name="txt_start" id="txt_start" required>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="txt_end">End Date</label>
            <input type="date" class="form-control" name="txt_end" id="txt_end" required>
          </div>
        </div>
      </div>

      <div class="text-center">
        <button type="submit" class="btn btn-primary" name="txt_submit" id="txt_submit">Submit</button>
        <button type="reset" class="btn btn-secondary" name="txt_reset" id="txt_reset">Cancel</button>
      </div>
    </form>
  </div>

  <!-- Add Bootstrap JS links here -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

<?php
ob_end_flush();
include('Foot.php');
?>

</html>