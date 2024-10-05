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
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$username = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

// Insert the data into the database
$stmt = $conn->prepare('INSERT INTO users (username, email, password) VALUES (:username, :email, :password)');
$stmt->bindParam(':username', $username);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':password', $password);
$stmt->execute();

$user = new User($username, $email, $password);
// Retrieve all users from the database
$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // Display all users
    while($row = mysqli_fetch_assoc($result)) {
        $users[] = new User($row['username'], $row['email'], $row['password']);
    }
} else {
    echo "No users found";
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Users</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h2>Users</h2>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($users as $user) { ?>
                    <tr>
                        <td><?= $user->getName() ?></td>
                        <td><?= $user->getEmail() ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
