<?php
require_once 'db_const.php';
require_once 'db_conn.php';
//
$value = htmlspecialchars($_POST['value']);
$arr   = [];
// Fetch all car options
$query = mysqli_query($conn, 'SELECT DISTINCT * FROM ' . DB_NAME . '.`car_option`');
//
while ($option = mysqli_fetch_array($query)) {
  // Fetch car option value for current equipment
  $query_value = mysqli_query($conn, 'SELECT DISTINCT * FROM ' . DB_NAME . '.`car_option_value` WHERE `id_car_option` = ' . $option['id_car_option'] . ' AND `id_car_equipment` = ' . $value);
  //
  while ($option_value = mysqli_fetch_array($query_value)) {
    $arr[$option['id_car_option']]['name'] = $option['name'];
  }
}
mysqli_close($conn);
// Send a JSON encoded object to client
echo json_encode($arr);