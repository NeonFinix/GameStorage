<?php
ob_start();
include("Head.php");
include('../Assets/Connection/Connection.php');
session_start();
include("session.php");
function validateImageDimensions($imagePath, $targetAspectRatio = 1)
{
  // Get image dimensions
  list($width, $height) = getimagesize($imagePath);

  // Check if the aspect ratio matches the target aspect ratio (e.g., 1:1)
  $aspectRatio = $width / $height;

  return abs($aspectRatio - $targetAspectRatio) < 0.01; // You can adjust the tolerance if needed
}

if (isset($_POST['submit'])) {
  $logo = $_FILES['txt_logo']['name'];
  $path = $_FILES['txt_logo']['tmp_name'];
  if (empty($logo)) {
    ?>
    <script>
      alert("Select an Image");
    </script>
    <?php
  }
  if (validateImageDimensions($path, 1)) {
    move_uploaded_file($path, "../Assets/Files/Developer/GameLogo/" . $logo);

    $name = $conn->real_escape_string($_POST['txt_name']);
    $descr = $conn->real_escape_string($_POST['txt_descr']);
    $date = $_POST['date'];

    $genreid = $_POST["genre"];
    $ids = implode(",", $genreid);

    $age = $_POST['txt_age'];
    $devid = $_SESSION['did'];

    $platform = $_POST['platform'];
    $pids = implode(",", $platform);

    $status = 0;
    $trailer_link = $_POST['trailer'];
    if ($trailer_link == "") {
      $trailer_link = null;
    }

    $ss1 = $_FILES['screenshot1']['name'];
    $path = $_FILES['screenshot1']['tmp_name'];
    move_uploaded_file($path, "../Assets/Files/Developer/Screenshots/" . $ss1);

    $ss2 = $_FILES['screenshot2']['name'];
    $path = $_FILES['screenshot2']['tmp_name'];
    move_uploaded_file($path, "../Assets/Files/Developer/Screenshots/" . $ss2);

    $ss3 = $_FILES['screenshot3']['name'];
    $path = $_FILES['screenshot3']['tmp_name'];
    move_uploaded_file($path, "../Assets/Files/Developer/Screenshots/" . $ss3);

    $ss4 = $_FILES['screenshot4']['name'];
    $path = $_FILES['screenshot4']['tmp_name'];
    move_uploaded_file($path, "../Assets/Files/Developer/Screenshots/" . $ss4);

    $ss5 = $_FILES['screenshot5']['name'];
    $path = $_FILES['screenshot5']['tmp_name'];
    move_uploaded_file($path, "../Assets/Files/Developer/Screenshots/" . $ss5);

    $insert = "INSERT INTO tbl_games(game_name,company_id,genre_id,description,trailer,screenshot1,screenshot2,screenshot3,screenshot4,screenshot5,platform_id,min_age,game_logo,release_date,game_status) VALUES ('$name','$devid','$ids','$descr','$trailer_link','$ss1','$ss2','$ss3','$ss4','$ss5','$pids','$age','$logo','$date','$status')";

    if ($conn->query($insert)) {
      ?>
      <script>
        alert("Inserted!!");
        window.location = "AddGame.php";
      </script>
      <?php
    }
  } else {
    ?>
    <script>
      alert("Image does not have a 1:1 aspect ratio");
    </script>
    <?php
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Add Game</title>
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
    <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
      <div class="form-group">
        <label for="txt_name">Game Name</label>
        <input type="text" class="form-control" name="txt_name" id="txt_name" required />
      </div>

      <div class="form-group">
        <label for="txt_descr">Description</label>
        <textarea class="form-control" name="txt_descr" id="txt_descr" cols="45" rows="5" required></textarea>
      </div>

      <div class="form-group">
        <label for="genre">Genre</label><br>
        <?php
        $show = "SELECT * FROM tbl_genre";
        $row = $conn->query($show);
        while ($data = $row->fetch_assoc()) {
          ?>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="genre[]" value="<?php echo $data["genre_id"] ?>"
              required />
            <label class="form-check-label">
              <?php echo $data["genre_name"] ?>
            </label>
          </div>
          <?php
        }
        ?>
      </div>

      <div class="form-group">
        <label for="platform">Platform</label><br>
        <?php
        $sel = "SELECT * FROM tbl_platform";
        $res = $conn->query($sel);
        while ($row = $res->fetch_assoc()) {
          ?>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="platform[]" value="<?php echo $row["platform_id"] ?>"
              required />
            <label class="form-check-label">
              <?php echo $row["platform_name"] ?>
            </label>
          </div>
          <?php
        }
        ?>
      </div>

      <div class="form-group">
        <label for="trailer">Trailer Link from Youtube (Optional)</label>
        <input type="text" class="form-control" name="trailer" id="trailer">
      </div>

      <div class="form-group">
        <label for="screenshot1">Screenshot 1</label>
        <input type="file" class="form-control-file" name="screenshot1" id="screenshot1" accept="image/*" required><br>
      </div>

      <div class="form-group">
        <label for="screenshot2">Screenshot 2</label>
        <input type="file" class="form-control-file" name="screenshot2" id="screenshot2" accept="image/*" required><br>
      </div>

      <div class="form-group">
        <label for="screenshot3">Screenshot 3</label>
        <input type="file" class="form-control-file" name="screenshot3" id="screenshot3" accept="image/*" required><br>
      </div>

      <div class="form-group">
        <label for="screenshot4">Screenshot 4</label>
        <input type="file" class="form-control-file" name="screenshot4" id="screenshot4" accept="image/*" required><br>
      </div>

      <div class="form-group">
        <label for="screenshot5">Screenshot 5</label>
        <input type="file" class="form-control-file" name="screenshot5" id="screenshot5" accept="image/*" required><br>
      </div>

      <div class="form-group">
        <label for="date">Release Date</label>
        <input type="date" class="form-control" name="date" id="date" required>
      </div>

      <div class="form-group">
        <label for="txt_age">Minimum Age</label>
        <input type="number" class="form-control" name="txt_age" id="txt_age" required />
      </div>

      <div class="form-group">
        <label for="txt_logo">Game Logo(1:1)</label>
        <input type="file" class="form-control-file" name="txt_logo" id="txt_logo" accept="image/*" required />
      </div>
<h4>NB:make sure to give names of the images unique names</h4>
      <div class="text-center">
        <button type="submit" class="btn btn-primary" name="submit" id="submit">Submit</button>
        <button type="reset" class="btn btn-secondary" name="cancel" id="cancel">Cancel</button>
      </div>
    </form>
  </div>

  <!-- Add Bootstrap JS links here -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

  <?php
  ob_end_flush();
  include('Foot.php');
  ?>

</body>

</html>