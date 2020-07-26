<?php
require_once 'db_const.php';
require_once 'db_conn.php';
//
$entity = 'car_mark';
$entities = [];
//
switch ($entity) {
  case 'car_mark':
    $STH = $DBH->prepare("SELECT * FROM car_mark");
    $STH->execute([$entity]);
    $row = $STH->fetch();
    print '<pre>';
    print_r($row);
    print '</pre>';
    exit;
    break;
  /*case 'generation':
    $query = mysqli_query($conn, 'SELECT * FROM ' . DB_NAME . '.`car_' . $entity . '` WHERE `id_car_' . $prev_ent . '` = ' . $value . ' AND `year_begin` IS NOT NULL AND `year_end` IS NOT NULL');
    break;
  default:
    $query = mysqli_query($conn, 'SELECT * FROM ' . DB_NAME . '.`car_' . $entity . '` WHERE `id_car_' . $prev_ent . '` = ' . $value);*/
}
//
/*while ($row = $STH->fetchAll()) {
  $entities[$row['id_car_' . $entity]]['name'] = $row['name'];
  $entities[$row['id_car_' . $entity]]['id_car_' . $entity] = $row['id_car_' . $entity . ''];
  //
  if ($entity === 'generation') {
    $entities[$row['id_car_' . $entity]]['year_begin'] = $row['year_begin'];
    $entities[$row['id_car_' . $entity]]['year_end'] = $row['year_end'];
  }
}*/
// Close connect
$DBH = NULL;
// Send a JSON encoded object to client
echo json_encode($entities);