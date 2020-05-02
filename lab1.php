<?php
//    include_once 'dbconnector.php';
    include_once 'user.php';

    $connection = new dbconnector();

    if(isset($_POST['btn_save']))
    {
        $first_name =$_POST['first_name'];
        $last_name = $_POST['last_name'];
        $city_name = $_POST['city_name'];
        $username = $_POST['user_name'];
        $password = $_POST['password'];

        $user = new User($first_name,$last_name,$city_name,$username,$password);
        if (!$user->validateForm())
        {
            $user->createFormErrorSessions();
            header("Refresh:0");
            die();
        }
        $result = $user->save($connection->conn);
        $users = $user->readAll($connection->conn)->fetch_assoc();

        if($result)
        {
            echo 'Save operation successful!!';
            $connection->closeConnection();
        }
        else
        {
            echo 'An Error occurred.';
        }

//        print_r($users);

        foreach ($users as $user)
        {

        }
    }
?>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="lab1.css">
        <link rel="stylesheet" type="text/css" href="validate.css">
        <script type="text/javascript" src="validate.js"></script>
        <title>Lab 1</title>
    </head>
    <body>
    <form method="post" name="user_details" id="user_details" onsubmit="return validateForm()" action="<?=$_SERVER['PHP_SELF']?>">
        <table align="center">
            <tr>
                <td>
                    <div id="form-errors">
                        <?php
                            session_start();
                            if(!empty($_SESSION['form_errors']))
                            {
                                echo " ".$_SESSION['form_errors'];
                                unset($_SESSION['form_errors']);
                            }
                        ?>
                    </div>
                </td>
            </tr>
            <tr>
                <td><label for="fname">First Name</label></td>
                <td><input type="text" name="first_name" id="fname" required placeholder="First Name"></td>
            </tr>
            <tr>
                <td><label for="lname">Last Name</label></td>
                <td><input type="text" name="last_name" id="lname" required placeholder="Last Name"></td>
            </tr>
            <tr>
                <td><label for="city">City</label></td>
                <td><input type="text" name="city_name" id="city" placeholder="City"></td>
            </tr>
            <tr>
                <td><label for="uname">Username</label></td>
                <td><input type="text" name="user_name" id="uname" placeholder="Username"></td>
            </tr>
            <tr>
                <td><label for="password">Password</label></td>
                <td><input type="password" name="password" id="password"></td>
            </tr>
            <tr>
                <td><button type="submit" name="btn_save"><strong>SAVE</strong></button></td>
            </tr>
            <tr>
                <a href="login.php">Login</a>
            </tr>
        </table>
    </form>

    <a href="viewAllRecords.php" >View All Records</a>

    </body>
</html>