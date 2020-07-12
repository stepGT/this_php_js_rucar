<?php
require_once 'db_const.php';
require_once 'db_conn.php';
//
$query = mysqli_query($conn, "SELECT * FROM " . DB_NAME . ".`car_mark` WHERE `name` IS NOT NULL");
$marks = [];
//
while ($item = mysqli_fetch_array($query)) {
  $marks[$item['id_car_mark']]['name']        = $item['name'];
  $marks[$item['id_car_mark']]['id_car_mark'] = $item['id_car_mark'];
}
mysqli_close($conn);
// Send a JSON encoded object to client
echo json_encode($marks);