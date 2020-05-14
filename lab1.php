<?php
    include_once 'dbconnector.php';
    include_once 'user.php';
    include_once 'fileUploader.php';

    $connection = new dbconnector();

    if(isset($_POST['btn_save']))
    {
        $first_name =$_POST['first_name'];
        $last_name = $_POST['last_name'];
        $city_name = $_POST['city_name'];
        $username = $_POST['user_name'];
        $password = $_POST['password'];
        $timestamp = $_POST['utcTimestamp'];
        $offset = $_POST['timeZoneOffset'];

//       Get the name of the file selected, the size and the file type
        $imageName = $_FILES['fileToUpload']['name'];
        $imageTmp = $_FILES['fileToUpload']['tmp_name'];
        $imageSize = $_FILES['fileToUpload']['size'];
        $imageType = $_FILES['fileToUpload']['type'];

        $user = new User($first_name,$last_name,$city_name,$username,$password,$timestamp,$offset);
        $uploader = new FileUploader($imageName,$imageTmp,$imageSize,$imageType);

        if($uploader->uploadFile())
        {
            echo "<script>alert(\"Image uploaded successfully!\")</script>";
        }

        if (!$user->validateForm())
        {
            $user->createFormErrorSessions();
            header("Refresh:0");
            die();
        }

        $users = $user->readAll($connection->conn);

        if ($users->num_rows >0)
        {
            while ($row=$users->fetch_assoc())
            {
                if($row['username'] == $username)
                {
                    echo "<script>alert(\"Username already exists!\")</script>";
                    header("Refresh:0");
                    die();
                }
            }
        }

        $targetPath = $uploader::getTargetDirectory().$uploader->getFileOriginalName();
        $result = $user->save($connection->conn,$targetPath);

        if($result)
        {
            echo "<script>alert(\"User account created successfully!\")</script>";
            $connection->closeConnection();
        }
        else
        {
            echo 'An Error occurred.';
            echo '<br>';
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="timezone.js"></script>
        <title>Lab 1</title>
    </head>
    <body>
    <form method="post" enctype="multipart/form-data" name="user_details" id="user_details" onsubmit="return validateForm()" action="<?=$_SERVER['PHP_SELF']?>">
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
                <td><label for="fileToUpload">Profile Picture</label></td>
                <td><input type="file" name="fileToUpload" id="fileToUpload"></td>
            </tr>
            <tr>
                <td><button type="submit" name="btn_save"><strong>SAVE</strong></button></td>
            </tr>
            <input type="hidden" name="utcTimestamp" id="utcTimestamp">
            <input type="hidden" name="timeZoneOffset" id="timeZoneOffset">
            <tr>
                <a href="login.php">Login</a>
            </tr>
        </table>
    </form>

    <a href="viewAllRecords.php" >View All Records</a>

    </body>
</html>