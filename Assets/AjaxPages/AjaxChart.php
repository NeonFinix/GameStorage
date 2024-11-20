<?php
include('../Connection/Connection.php');

$sel = "select * from tbl_games";
$row = $conn->query($sel);
$games = array();

while ($data = $row->fetch_assoc()) {
    $games[] = $data["game_name"];
}

$dataArray = array(); // Create an array to store the data

// $sel = "select * from tbl_games";
// $row = $conn->query($sel);

// while ($data = $row->fetch_assoc()) {
//     $sel1 = "select sum(cart_quantity) as id from tbl_cart ca inner join tbl_booking b on b.booking_id=ca.booking_id inner join tbl_user u on u.user_id=b.user_id inner join tbl_product p on ca.product_id=p.product_id inner join tbl_games y on p.game_id=y.game_id inner join tbl_category c on y.category_id= c.category_id WHERE y.game_id='" . $data["game_id"] . "'";
//     $row1 = $conn->query($sel1);
//     while ($data1 = $row1->fetch_assoc()) {
//         $dataArray[] = $data1["id"];
//     }
// }

// Initialize arrays for the current year and previous years
$currentUserCounts = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

$userSel = "SELECT MONTH(view_date) as userMonth, YEAR(view_date) as userYear FROM tbl_count";
$row6 = $conn->query($userSel);

while ($data7 = $row6->fetch_assoc()) {
    $userMonth = $data7['userMonth'];
    

        $currentUserCounts[$userMonth - 1]++;
    
}

$dataArrayBar = array(); // $dataArrayBarLength
$dataArrayBarLength = array(); // $dataArrayBarLength

$sel = "select * from tbl_category c inner join tbl_games s on c.category_id = s.category_id where c.category_id = 7";
$row1 = $conn->query($sel);

while ($data1 = $row1->fetch_assoc()) {
    $dataArrayBar[] = $data1["game_name"];
}


$sel = "select * from tbl_category c inner join  tbl_games s on c.category_id = s.category_id where c.category_id = 7";
    $row = $conn->query($sel);
while ($data = $row->fetch_assoc()) {
    $sel1 = "select sum(cart_quantity) as id from tbl_cart ca inner join tbl_booking b on b.booking_id=ca.booking_id inner join tbl_user u on u.user_id=b.user_id inner join tbl_product p on ca.product_id=p.product_id inner join tbl_games y on p.game_id=y.game_id inner join tbl_category c on y.category_id= c.category_id WHERE y.game_id='" . $data["game_id"] . "'";
    $row1 = $conn->query($sel1);
    while ($data1 = $row1->fetch_assoc()) {
        $dataArrayBarLength[] = $data1["id"];
    }
}

// Now $currentYearCounts contains the counts of users for each month in the current year, and
// $previousYearsCounts contains the counts for previous years.



// Create an associative array with subcategories and quantities
$resultArray = array(
    'dataArrayBar' => $dataArrayBar,
    'dataArrayBarLength' => $dataArrayBarLength,
    'currentUserCounts' => $currentUserCounts,
    'subcategories' => $games,
    'quantities' => $dataArray,
);

// Encode the associative array as JSON
$jsonResult = json_encode($resultArray);

echo $jsonResult;
?>
