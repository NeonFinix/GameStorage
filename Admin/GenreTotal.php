<?php
include("../Assets/Connection/Connection.php");
ob_start();
include("Head.php");

?>
<!DOCTYPE html>
<html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<body>
<div id="tab" align="center">
<canvas id="myChart" style="width:100%;max-width:600px"></canvas>

<script>

var cValues = 
  <?php

  $count = "select count(*) as sum from tbl_genre";
  $total = $conn->query($count);
  $get_count = $total->fetch_assoc();
  echo $get_count["sum"];
?>;

var xValues = [
<?php 

  $sel="select * from tbl_genre";
  $row=$conn->query($sel);
  while($data=$row->fetch_assoc())
  {
        echo "'".$data["genre_name"]."',";
      
  }

?>
];

var yValues = [
<?php 
  $sel="select * from tbl_genre";
  $row=$conn->query($sel);
  while($data=$row->fetch_assoc())
  {
	  
	 $sel1="select count(game_id) as id from tbl_games ca inner join  tbl_genre b  on b.genre_id=ca.genre_id WHERE ca.genre_id='".$data["genre_id"]."'";
	  
	  $row1=$conn->query($sel1);
  while($data1=$row1->fetch_assoc())
	  {
			echo $data1["id"].",";
	  }
  }

?>
];



function generateRandomColor() {
  const letters = "0123456789ABCDEF";
  let color = "#";
  for (let i = 0; i < 6; i++) {
    color += letters[Math.floor(Math.random() * 16)];
  }
  return color;
}

new Chart("myChart", {
  type: "pie",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: generateRandomColor,
      data: yValues
    }]
  },
  options: {
    title: {
      display: true,
      text: "Total Genre "+cValues
    }
  }
});
</script>
<?php
include("Foot.php");
ob_flush();
?>
</div>
</body>
</html>
