<?php
class User {
  private $username;
  private $email;

  public function __construct($username, $email) {
    $this->username = $username;
    $this->email = $email;
  }

  public function getName() {
    return $this->username;
  }

  public function getEmail() {
    return $this->email;
  }
}

$conn = mysqli_connect("localhost", "username", "password", "database");
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT username, email FROM users";
$result = mysqli_query($conn, $sql);

$users = array();
while ($row = mysqli_fetch_assoc($result)) {
  $user = new User($row["username"], $row["email"]);
  $users[] = $user;
}

mysqli_close($conn);
?>

<html>
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
        <?php foreach ($users as $user) { ?>
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

