<?php
session_start();

if (!isset($_SESSION["2fa_token"])) {
  header("Location: signup.php");
  exit;
}

$token = $_SESSION["2fa_token"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $user_token = $_POST["token"];

  if ($user_token == $token) {
    // 2FA token is valid, proceed to store user data in the database
    // ...
  } else {
    $error = "Invalid 2FA token.";
  }
}
?>

<html>
<head>
  <title>2FA Token</title>
</head>
<body>
<h1>Enter 2FA Token</h1>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
  <label for="token">2FA Token:</label>
  <input type="text" id="token" name="token"><br><br>
  <input type="submit" value="Submit">
</form>

<?php if (isset($error)) { echo $error; } ?>
</body>
</html>
