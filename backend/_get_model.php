<?php
require_once 'db_const.php';
require_once 'db_conn.php';
//
$query = mysqli_query($conn, 'SELECT `name`, `id_car_model` FROM ' . DB_NAME . '.`car_model` WHERE `id_car_mark` = ' . $_POST['value']);
$models = [];
//
while ($item = mysqli_fetch_array($query)) {
  $models[$item['id_car_model']]['name']        = $item['name'];
  $models[$item['id_car_model']]['id_car_model'] = $item['id_car_model'];
}
mysqli_close($conn);
// Send a JSON encoded object to client
echo json_encode($models);