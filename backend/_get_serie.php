<?php
require_once 'db_const.php';
require_once 'db_conn.php';
//
$query = mysqli_query($conn, 'SELECT `name`, `id_car_serie` FROM ' . DB_NAME . '.`car_serie` WHERE `id_car_generation` = ' . $_POST['value']);
$models = [];
//
while ($item = mysqli_fetch_array($query)) {
  $models[$item['id_car_serie']]['name']              = $item['name'];
  $models[$item['id_car_serie']]['id_car_serie'] = $item['id_car_serie'];
}
mysqli_close($conn);
// Send a JSON encoded object to client
echo json_encode($models);