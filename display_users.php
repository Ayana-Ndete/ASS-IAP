<?php
global $conn;
require 'db.php';

class User
{
    private $username;
    private $email;
    private $password;

    public function __construct($username, $email, $password)
    {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
    }

    public function getName()
    {
        return $this->username;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
$username = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

    // Insert the data into the database
$sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
if (mysqli_query($conn, $sql)) {
echo " ";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

$user = new User($username, $email, $password);
} else {
    echo "Form data not submitted";
}
?>
