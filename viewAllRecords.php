<?php
include 'user.php';
include 'dbconnector.php';

$connection = new dbconnector();
$users = User::readAll($connection->conn);
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="lab1.css">
        <title>View Records</title>
    </head>
    <body>
        <table style="width: 100%">
            <tr>
                <th>#</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>City</th>
            </tr>
            <?php
                if ($users->num_rows > 0)
                {
                    while($row=$users->fetch_assoc())
                    {
                        echo '<tr>';
                        echo '<td>' . $row['id'] . '</td>';
                        echo '<td>' . $row['first_name'] . '</td>';
                        echo '<td>' . $row['last_name'] . '</td>';
                        echo '<td>' . $row['user_city'] . '</td>';
                        echo '</tr>';
                    }
                }
            ?>
        </table>
    </body>
</html>
