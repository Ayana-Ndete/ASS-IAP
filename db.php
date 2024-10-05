
<?php
$dsn = 'mysql:host=localhost;dbname=api';
$username = 'ayana';
$password = '1234';

try {
$conn = new PDO($dsn, $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
echo 'Connection failed: ' . $e->getMessage();
}
