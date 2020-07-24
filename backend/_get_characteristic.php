<?php
require_once 'db_const.php';
require_once 'db_conn.php';
//
$value = htmlspecialchars($_POST['value']);
//
$entities = [];
$all_characteristic = [];
//
$query_characteristic = mysqli_query($conn, 'SELECT * FROM ' . DB_NAME . '.`car_characteristic`');
//
while ($characteristic = mysqli_fetch_array($query_characteristic)) {
  $characteristics_value = mysqli_query($conn, 'SELECT * FROM ' . DB_NAME . '.`car_characteristic_value` WHERE `id_car_characteristic` = ' . $characteristic['id_car_characteristic'] . ' AND `id_car_modification` = ' . $value);
  //
  while ($characteristic_value = mysqli_fetch_array($characteristics_value)) {
    $all_characteristic[] = $characteristic['name'] . ' ' . $characteristic_value['value'] . ' ' . $characteristic_value['unit'];
  }
}
mysqli_close($conn);
// Send a JSON encoded object to client
echo json_encode($all_characteristic);