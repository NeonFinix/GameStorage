<?php
include('../Assets/Connection/Connection.php');
ob_start();
include("Head.php");
  if(isset($_POST['submit']))
  {
    $wallpaper = $_FILES['wallpaper']['name'];
    $path = $_FILES['wallpaper']['tmp_name'];
    move_uploaded_file($path,"../Assets/Wallpaper/".$wallpaper);

    $ins = "insert into tbl_wallpaper(w_name) values ('".$wallpaper."')";
    if($conn->query($ins))
    {
      echo "Uploaded succesfully";
    }
  }
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
  <label for="wallpaper"></label>
  <input type="file" name="wallpaper" id="wallpaper" />
  <input type="submit" name="submit" id="submit" value="Submit" />
</form>
<br><br><br><br>
<section class="gallery_part section_padding">
  <div class="container">
      <div class="row justify-content-center">
          <div class="col-xl-5">
              <div class="section_tittle text-center">
                  <h2>Wallpaper Gallery</h2>
              </div>
          </div>
      </div>
      <div class="row">
          <div class="col-xl-12">
              <div class="gallery_part_item">
                  <div class="grid">
                      <div class="grid-sizer"></div>
                      <?php 
                      $wall = "select * from tbl_wallpaper order by date desc limit 12";
                      $wall1 = $conn->query($wall);
                      $i = 0;
                      while($wall2 = $wall1->fetch_assoc())
                      {
                          ?>
                          <img src="../Assets/Wallpaper/<?php echo $wall2['w_name'] ?>" alt="wallpaper" width="250" >
                      </a>
                      <?php
                              }
                          ?>
                  </div>
              </div>
          </div>
      </div>
  </div>
</section>
</body>
<?php
ob_end_flush();
include("Foot.php");
?>
</html>