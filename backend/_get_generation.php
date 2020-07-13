<?php
require_once 'db_const.php';
require_once 'db_conn.php';
//
$query = mysqli_query($conn, 'SELECT `name`, `id_car_generation` FROM ' . DB_NAME . '.`car_generation` WHERE `id_car_model` = ' . $_POST['value']);
$models = [];
//
while ($item = mysqli_fetch_array($query)) {
  $models[$item['id_car_generation']]['name']              = $item['name'];
  $models[$item['id_car_generation']]['id_car_generation'] = $item['id_car_generation'];
}
mysqli_close($conn);
// Send a JSON encoded object to client
echo json_encode($models);