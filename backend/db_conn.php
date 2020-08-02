<?php
//
const HOST = 'localhost';
const USER = 'root';
const PASS = '';
const DB_NAME = 'auto_rus_demo';
//
try {
  $options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Exceptions
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
  ];
  // Database Handle
  $dbh = new PDO("mysql:host=" . HOST . ";dbname=" . DB_NAME . "", USER, PASS, $options);
} catch (PDOException $e) {
  echo $e->getMessage();
  file_put_contents('../logs/PDOErrors.txt', $e->getMessage() . "\r\n", FILE_APPEND);
}