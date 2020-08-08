<?php
require_once 'db_conn.php';
//
$entity = $_POST['entity'];
$value  = $_POST['value'];
//
switch ($entity) {
  case 'mark':
    $stmt = $dbh->prepare('SELECT `name`, `id_car_mark` FROM `car_mark` ORDER BY `name`');
    $stmt->execute();
    break;
  case 'model':
    $stmt = $dbh->prepare('SELECT `name`, `id_car_model` FROM `car_model` WHERE `id_car_mark` = :val ORDER BY `name`');
    $stmt->execute(['val' => $value]);
    break;
  case 'generation':
    $stmt = $dbh->prepare('SELECT `name`, `id_car_generation`, `year_begin`, `year_end` FROM `car_generation` WHERE `id_car_model` = :val AND `year_begin` IS NOT NULL AND `year_end` IS NOT NULL ORDER BY `name`');
    $stmt->execute(['val' => $value]);
    break;
  case 'serie':
    $stmt = $dbh->prepare('SELECT `name`, `id_car_serie` FROM `car_serie` WHERE `id_car_generation` = :val ORDER BY `name`');
    $stmt->execute(['val' => $value]);
    break;
  case 'modification':
    $stmt = $dbh->prepare('SELECT `name`, `id_car_modification` FROM `car_modification` WHERE `id_car_serie` = :val ORDER BY `name`');
    $stmt->execute(['val' => $value]);
    break;
  case 'equipment':
    $stmt = $dbh->prepare('SELECT `name`, `id_car_equipment` FROM `car_equipment` WHERE `id_car_modification` = :val ORDER BY `name`');
    $stmt->execute(['val' => $value]);
    break;
  case 'characteristic':
    $stmt = $dbh->prepare('SELECT `name`, `unit`, `value` FROM `car_characteristic_value` AS `cv` 
  LEFT JOIN `car_characteristic` AS `cc` ON `cv`.`id_car_characteristic` = `cc`.`id_car_characteristic` 
    WHERE `id_car_modification` = :val ORDER BY `name`');
    $stmt->execute(['val' => $value]);
    break;
  default;
}
// Close connect
$dbh = NULL;
// Send a JSON encoded object to client
echo json_encode($stmt ? $stmt->fetchAll() : new PDOStatement());