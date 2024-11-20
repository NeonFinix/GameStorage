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

  $count = "select count(*) as sum from tbl_games";
  $total = $conn->query($count);
  $get_count = $total->fetch_assoc();
  echo $get_count["sum"];
?>;

var xValues = [
<?php 
  $sel="SELECT g.game_name, COUNT(c.game_id) AS view_count
  FROM tbl_games g
  INNER JOIN tbl_count c ON g.game_id = c.game_id
  GROUP BY g.game_name
  ORDER BY view_count DESC";
  $row=$conn->query($sel);
  while($data=$row->fetch_assoc())
  {
        echo "'".$data["game_name"]."',";
      
  }

?>
];

var yValues = [
<?php 
  $sel="SELECT g.*, COUNT(c.game_id) AS view_count
  FROM tbl_games g
  INNER JOIN tbl_count c ON g.game_id = c.game_id
  GROUP BY g.game_name
  ORDER BY view_count DESC";
  $row=$conn->query($sel);
  while($data=$row->fetch_assoc())
  {
	  
	 $sel1="select count(ca.game_id) as id from tbl_count ca inner join  tbl_games b  on b.game_id=ca.game_id WHERE ca.game_id='".$data["game_id"]."' limit 10";
	  $row1=$conn->query($sel1);
  while($data1=$row1->fetch_assoc())
	  {
			echo $data1["id"].",";
	  }
  }

?>
];

// // Now you have an array of colors in order according to the number of records
// console.log(colors);


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
      text: "Total Games"+cValues
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
