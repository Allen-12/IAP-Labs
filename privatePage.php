<?php
session_start();
if (!isset($_SESSION['username']))
{
    header("Location:login.php");
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PRIVATE PAGE</title>
    <script type="text/javascript" src="validate.js"></script>
    <link rel="stylesheet" type="text/css" href="validate.css">
</head>
<body>
    <p>This is a private page</p>
    <p>We want to protect it</p>
    <p><a href="logout.php">Logout</a></p>
</body>
</html>
