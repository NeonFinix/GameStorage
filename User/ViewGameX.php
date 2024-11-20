<?php
ob_start();
include("Head.php");
include('../Assets/Connection/Connection.php');
session_start();
if(isset($_GET['view']))
{
    $gg = "select * from tbl_games where game_id = ".$_GET['kid'];
    $gg1 = $conn->query($gg);
    $gg2 = $gg1->fetch_assoc();
    $updateView = $gg2['views'] + 1;
    $insert = "update tbl_games set views = $updateView where game_id = ".$_GET['kid'];
    $conn->query($insert);

    $insqry = "insert into tbl_count(user_id,game_id,view_date) values ('".$_SESSION['uid']."','".$_GET['kid']."',now())";
    if($conn->query($insqry))
    {
        ?>
        <script>
            window.location="ViewGame.php?kid=<?php echo $_GET['kid']?>";
        </script>
        <?php
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ViewGame</title>
</head>
<body>
<form id="form1" name="form1" method="post" action="">
<?php 
	$ind = "select * from tbl_games gs inner join tbl_dev d on gs.company_id=d.company_id inner join tbl_genre gr on gs.genre_id=gr.genre_id where game_id=".$_GET["kid"];
	$geti = $conn->query($ind);
	$data = $geti->fetch_assoc();
?>
  <table border="1" align="center" style="background-color: white;">
    <tr>
      <td colspan="2"><p align="center"><img src="../Assets/Files/Developer/GameLogo/<?php echo $data['game_logo']?>"  class="img-fluid" style="max-width: 300px;"></p></td>
    </tr>
      					<tr>
                            <td>

                            <?php
										
											
                                        $average_rating = 0;
                                        $total_review = 0;
                                        $five_star_review = 0;
                                        $four_star_review = 0;
                                        $three_star_review = 0;
                                        $two_star_review = 0;
                                        $one_star_review = 0;
                                        $total_user_rating = 0;
                                        $review_content = array();
                                    
                                        $query = "SELECT * FROM tbl_rating where game_id = '" . $data["game_id"] . "' ORDER BY rating_id DESC";

                                        $result = $conn->query($query);
                                    
                                        while ($row = $result->fetch_assoc()) {

                                            
                                    
                                            if($row["rating_value"] == '5')
                                            {
                                                $five_star_review++;
                                            }
                                    
                                            if($row["rating_value"] == '4')
                                            {
                                                $four_star_review++;
                                            }
                                    
                                            if($row["rating_value"] == '3')
                                            {
                                                $three_star_review++;
                                            }
                                    
                                            if($row["rating_value"] == '2')
                                            {
                                                $two_star_review++;
                                            }
                                    
                                            if($row["rating_value"] == '1')
                                            {
                                                $one_star_review++;
                                            }
                                    
                                            $total_review++;
                                    
                                            $total_user_rating = $total_user_rating + $row["rating_value"];
                                    
                                        }
                                        
                                        
                                        if($total_review==0 || $total_user_rating==0 )
                                        {
                                            $average_rating = 0 ; 			
                                        }
                                        else
                                        {
                                            $average_rating = round($total_user_rating / $total_review);
                                        }
                                        
                                        ?>
                                        <p align="center" style="color:#F96;font-size:20px">
                                       <?php
                                       if($average_rating==5 || $average_rating==4.5)
                                       {
                                           ?>
                                            <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                                            <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                                            <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                                            <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                                            <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                                           <?php
                                       }
                                       if($average_rating==4 || $average_rating==3.5)
                                       {
                                           ?>
                                            <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                                            <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                                            <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                                            <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                                            <i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
                                           <?php
                                       }
                                       if($average_rating==3 || $average_rating==2.5)
                                       {
                                           ?>
                                            <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                                            <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                                            <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                                            <i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
                                            <i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
                                           <?php
                                       }
                                       if($average_rating==2 || $average_rating==1.5)
                                       {
                                           ?>
                                            <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                                            <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                                            <i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
                                            <i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
                                            <i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
                                           <?php
                                       }
                                       if($average_rating==1)
                                       {
                                           ?>
                                            <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                                            <i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
                                            <i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
                                            <i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
                                            <i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
                                           <?php
                                       }
                                       if($average_rating==0)
                                       {
                                           ?>
                                            <i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
                                            <i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
                                            <i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
                                            <i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
                                            <i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
                                           <?php
                                       }
                                       ?>
                                       
                                    </p>
                           
                            </td>
                          </tr>
     <tr><td colspan="2">
       <input type="submit" name="rate" id="rate" value="Rate This Game" />   
       <input type="submit" name="fav" value="Favourite">    
       <input type="submit" name="wishlist" value="Wishlist" />
    </td></tr>
    <tr><td>
    <div id="video-container">
    <iframe
      width="560"
      height="315"
      src="https://www.youtube.com/embed/<?php echo $data['trailer']?>"
      frameborder="0"
      allowfullscreen
    ></iframe>
  </div>

  <div id="screenshots-container">
    <img class="screenshot" src="../Assets/Files/Developer/Screenshots/<?php echo $data['screenshot1']?>" alt="Screenshot 1">
    <img class="screenshot" src="../Assets/Files/Developer/Screenshots/<?php echo $data['screenshot2']?>" alt="Screenshot 2">
    <img class="screenshot" src="../Assets/Files/Developer/Screenshots/<?php echo $data['screenshot3']?>" alt="Screenshot 3">
    <img class="screenshot" src="../Assets/Files/Developer/Screenshots/<?php echo $data['screenshot4']?>" alt="Screenshot 4">
    <img class="screenshot" src="../Assets/Files/Developer/Screenshots/<?php echo $data['screenshot5']?>" alt="Screenshot 5">
  </div>
    </td></tr>
    <tr>
      <td width="207">Name</td>
      <td width="409"><?php echo $data['game_name'] ?></td>
    </tr>
    <tr>
      <td>Developers</td>
      <td><a href="../Developer/ShowProfile.php?dev=<?php echo $data['company_id']?>"><?php echo $data['company_name']?></a></td>
    </tr>
    <tr>
      <td>Genre</td>
      <td>
        <?php
				$gg = "SELECT * FROM tbl_games WHERE game_id = " . $_GET['kid'];
                $gg1 = $conn->query($gg);
                while ($gg2 = $gg1->fetch_assoc()) {
                    $gg3 = $gg2['genre_id'];
                    $comma = ",";
                    $print = explode($comma, $gg3);
                    foreach ($print as $value) {
                        $qry = "select * from tbl_genre where genre_id = ".$value;
                        $qry1 = $conn->query($qry);
                        $qry2 = $qry1->fetch_assoc();
                        echo $qry2['genre_name'] . "<br>";
                    }
                }
		  ?>
        </td>
    </tr>
    <tr>
      <td>Description</td>
      <td><?php echo $data['description']?></td>
    </tr>
    <tr>
        <td>Release Date</td>
        <td><?php echo $data['release_date']?></td>
    </tr>
    <tr>
      <td>Platforms</td>
      <td><?php
				$kid = "SELECT * FROM tbl_games WHERE game_id = " . $_GET['kid'];
                $kid1 = $conn->query($gg);
                while ($kid2 = $kid1->fetch_assoc()) {
                    $kid3 = $kid2['platform_id'];
                    $comma = ",";
                    $print = explode($comma, $kid3);
                    foreach ($print as $value) {
                        $qry = "select * from tbl_platform where platform_id = ".$value;
                        $qry1 = $conn->query($qry);
                        $qry2 = $qry1->fetch_assoc();
                        echo $qry2['platform_name'] . "<br>";
                    }
                }
		  ?></td>
    </tr>
  </table>
</form>
<?php 
	$bb = "SELECT * from tbl_events where game_id = ".$_GET["kid"];
	$bet = $conn->query($bb);
	if($bet->num_rows>0)
		{
		$hh = mysqli_fetch_assoc($bet);
?>
<h2>EVENTS HAPPENING NOW!!</h2>
<?php echo $hh['event_name'];
	  echo "<br><h3>DESCRIPTION</h3>";
	  echo $hh['event_desc'];
	  echo "<br> End Date  -  ";
	  echo $hh['end_date'];
	}
	else
	{
	?>
    <h3>NO EVENTS</h3>
    <?php
	}
	?>
</body>
</html>
<?php
 if(isset($_POST['wishlist']))
 	{
		$go = "select * from tbl_wishlist where game_id = $data[game_id] and user_id = $_SESSION[uid]";
		$go1 = $conn->query($go);
		if($go1->num_rows>0)
			{
				$del = "delete from tbl_wishlist where game_id =$data[game_id] and user_id = $_SESSION[uid]";
				if($delete = $conn->query($del))
					{
					?>
						<script>
						alert("Removed From Wishlist");
						</script>
					<?php
					}
			}
		else
			{
				$ins = "insert into tbl_wishlist (game_id,user_id) values ($data[game_id],$_SESSION[uid])";
				if($inse = $conn->query($ins))
					{
					?>
						<script>
						alert("Added to Wishlist");
						</script>
					<?php
					}
			}
	}
if(isset($_POST['rate']))
{
	?>
    <script>
	window.location="GameRating.php?gameid=<?php echo $data['game_id']?>";
	</script>
    <?php
}
if(isset($_POST['fav']))
    {
        $who = "user";
        $go = "select * from tbl_favourite where who = '$who'and id = $_SESSION[uid] and game_id = $data[game_id]";
		$go1 = $conn->query($go);
		if($go1->num_rows>0)
			{
				$del = "delete from tbl_favourite where who = '$who' and id = $_SESSION[uid] and game_id =$data[game_id]";
				if($delete = $conn->query($del))
					{
					?>
						<script>
						alert("Removed From Favourites");
						</script>
					<?php
					}
			}
		else
			{
				$ins = "insert into tbl_favourite(who,id,game_id) values ('$who',$_SESSION[uid],$data[game_id])";
				if($inse = $conn->query($ins))
					{
					?>
						<script>
						alert("Added to Favourites");
						</script>
					<?php
					}
			}
    }
  ob_end_flush();
  include('Foot.php');
  ?>