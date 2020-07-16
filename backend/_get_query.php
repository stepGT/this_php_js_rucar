<?php
require_once 'db_const.php';
require_once 'db_conn.php';
//
$entity   = htmlspecialchars($_POST['entity']);
$value    = htmlspecialchars($_POST['value']);
$prev_ent = htmlspecialchars($_POST['prev_ent']);
$entities = [];
//
if ($entity === 'mark') {
  $query = mysqli_query($conn, 'SELECT * FROM ' . DB_NAME . '.`car_' . $entity . '` WHERE `name` IS NOT NULL');
}
else {
  $query = mysqli_query($conn, 'SELECT `name`, `id_car_' . $entity . '` FROM ' . DB_NAME . '.`car_' . $entity . '` WHERE `id_car_' . $prev_ent . '` = ' . $value);
}
//
while ($item = mysqli_fetch_array($query)) {
  $entities[$item['id_car_' . $entity]]['name']              = $item['name'];
  $entities[$item['id_car_' . $entity]]['id_car_' . $entity] = $item['id_car_' . $entity . ''];
}
mysqli_close($conn);
// Send a JSON encoded object to client
echo json_encode($entities);