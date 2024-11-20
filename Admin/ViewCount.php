<?php
  ob_start();
  include("Head.php");
  include("../Assets/Connection/Connection.php");
  ?>
  <!DOCTYPE html>
<body>
 
  <form id="form1" name="form1" method="post" action="">
    <table border="1" cellpadding="10" align="center">
      <tr>
        <td>From Date</td>
        <td><label for="txt_f"></label>
          <input type="date" name="txt_f" id="txt_f" />
        </td>
        <td>To Date</td>
        <td><label for="txt_t"></label>
          <input type="date" name="txt_t" id="txt_t" />
        </td>
        <td>Limit</td>
        <td><label for="limit"></label>
        <input type="number" name="limit" id="limit" value="30">
        </td>
      </tr>
      <tr>
        <td colspan="6" align="center"><input type="submit" name="btnsave" id="btnsave" value="View Results" /></td>
      </tr>
    </table>
    <?php
    if (isset($_POST["btnsave"])) {
      $limit = $_POST['limit'];
      ?>
      <div id="pri">
        <table border="1" cellpadding="10" align="center">
          <tr>
            <td width="41">Sl.no</td>
            <td width="46">Game Name</td>
            <td width="60">Developers</td>
            <td width="97">Genre</td>
            <td width="59">Views</td>


          </tr>
          <?php
          echo "<br>";
          $sel = "select distinct tbl_games.game_id,tbl_games.game_name, tbl_dev.company_id,tbl_dev.company_name,tbl_games.views from ((tbl_count inner join tbl_games on tbl_count.game_id = tbl_games.game_id) inner join tbl_dev on tbl_games.company_id = tbl_dev.company_id) where tbl_count.view_date between '" . $_POST["txt_f"] . "' and '" . $_POST["txt_t"] . "' order by tbl_games.views desc limit ".$limit;
          $row = $conn->query($sel);
          $i = 0;
          while ($data = $row->fetch_assoc()) {
            $i++;
            ?>
            <tr>
              <td>
                <?php echo $i ?>
              </td>
              <td>
                <?php echo $data["game_name"]; ?>
              </td>
              <td>
                <?php echo $data["company_name"]; ?>
              </td>
              <td>
                <?php
                $gg = "SELECT * FROM tbl_games WHERE game_id = " . $data['game_id'];
                $gg1 = $conn->query($gg);
                while ($gg2 = $gg1->fetch_assoc()) {
                  $gg3 = $gg2['genre_id'];
                  $comma = ",";
                  $print = explode($comma, $gg3);
                  foreach ($print as $value) {
                    $qry = "select * from tbl_genre where genre_id = " . $value;
                    $qry1 = $conn->query($qry);
                    $qry2 = $qry1->fetch_assoc();
                    echo $qry2['genre_name'] . "<br>";
                  }
                }
                ?>
              </td>
              <td>
                <?php
                echo $data["views"];
                // $sew = "SELECT COUNT(game_id) AS record_count FROM tbl_count where game_id='" . $data['game_id'] . "'";
                // $sew1 = $conn->query($sew);
                // $sew2 = $sew1->fetch_assoc();
                // echo $sew2['record_count'];
                ?>
              </td>

            </tr>
            <?php
          }
          ?>
        </table>
      </div>
      <?php
    }
    ?>

  </form>
</body>

</html>
<?php
include("Foot.php");
ob_flush();
?>