<?php
global $conn;
require 'db.php';

class User {
  private $username;
  private $email;
  private $password;

  public function __construct($username, $email, $password) {
    $this->username = $username;
    $this->email = $email;
    $this->password = $password;
  }

  public function getName() {
    return $this->username;
  }

  public function getEmail() {
    return $this->email;
  }

  public function getPassword() {
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
// signup.php
if (isset($error)) {
  echo $error;
} else {
  // Generate a random token
  $token = bin2hex(16);

  // Send the token to the user's email address
  $to = $email;
  $subject = "2FA Token";
  $message = "Your 2FA token is: $token";
  $headers = "From: your_email_address@example.com";
  mail($to, $subject, $message, $headers);

  // Store the token in the user's session
  session_start();
  $_SESSION["2fa_token"] = $token;
}
?>

<!-- Display Users table -->
<!doctype html>
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
