<?php
require_once 'db_const.php';
require_once 'db_conn.php';
//
$value = htmlspecialchars($_POST['value']);
$arr   = [];
// Fetch all car characteristic
$query = mysqli_query($conn, 'SELECT DISTINCT * FROM ' . DB_NAME . '.`car_characteristic`');
//
while ($characteristic = mysqli_fetch_array($query)) {
  // Fetch car characteristic value for current modification
  $query_value = mysqli_query($conn, 'SELECT DISTINCT * FROM ' . DB_NAME . '.`car_characteristic_value` WHERE `id_car_characteristic` = ' . $characteristic['id_car_characteristic'] . ' AND `id_car_modification` = ' . $value);
  //
  while ($characteristic_value = mysqli_fetch_array($query_value)) {
    $arr[$characteristic['id_car_characteristic']]['name'] = $characteristic['name'];
    $arr[$characteristic['id_car_characteristic']]['value'] = $characteristic_value['value'];
    $arr[$characteristic['id_car_characteristic']]['unit'] = $characteristic_value['unit'] ? $characteristic_value['unit'] : '';
  }
}
mysqli_close($conn);
// Send a JSON encoded object to client
echo json_encode($arr);