<?php
require_once 'db_const.php';
require_once 'db_conn.php';
//


/**
 * @param $conn
 *
 * @return bool|\mysqli_result
 */
function this_get_marks($conn) {
  return mysqli_query($conn, "SELECT * FROM " . DB_NAME . ".`car_mark` WHERE `name_rus` IS NOT NULL");
}

$query = this_get_marks($conn);
$marks = [];
//
while ($item = mysqli_fetch_array($query)) {
  $marks[$item['id_car_mark']]['name']        = $item['name'];
  $marks[$item['id_car_mark']]['name_rus']    = $item['name_rus'];
  $marks[$item['id_car_mark']]['id_car_mark'] = $item['id_car_mark'];
}