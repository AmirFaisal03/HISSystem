<?php

$dbUsername = "root";
$dbPassword = "";
$dbServer = "";
$dbName = 'fashion_store';

$dsn = new mysqli($dbServer, $dbUsername,  $dbPassword, $dbName, 4307);

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

?>
