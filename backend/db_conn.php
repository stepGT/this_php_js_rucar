<?php
//
try {
  $options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Exceptions
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
  ];
  // Database Handle
  $DBH = new PDO("mysql:host=" . HOST . ";dbname=" . DB_NAME . "", USER, PASS, $options);
} catch (PDOException $e) {
  echo $e->getMessage();
  file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
}