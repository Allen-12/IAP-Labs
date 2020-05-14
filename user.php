<?php
include_once 'crud.php';
include_once 'authenticator.php';
include_once 'dbconnector.php';

class User implements Crud,Authenticator
{
    private $user_id;
    private $first_name;
    private $last_name;
    private $city_name;
    private $username;
    private $password;
    private $timestamp;
    private $offset;

    public function __construct($fname,$lname,$cname,$uname,$pass,$timestamp,$offset)
    {
        $this->first_name = $fname;
        $this->last_name  = $lname;
        $this->city_name = $cname;
        $this->username = $uname;
        $this->password = $pass;
        $this->timestamp = $timestamp;
        $this->offset = $offset;
    }

    /**
     * @return mixed
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * @param mixed $timestamp
     */
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;
    }

    /**
     * @return mixed
     */
    public function getOffset()
    {
        return $this->offset;
    }

    /**
     * @param mixed $offset
     */
    public function setOffset($offset)
    {
        $this->offset = $offset;
    }

    public static function create()
    {
        $instance = new self("","","","","");
        return $instance;
    }

    /**
     * @param mixed $user_id
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function save($conn,$path)
    {
        $fn = $this->first_name;
        $ln = $this->last_name;
        $cn = $this->city_name;
        $un = $this->username;
        $this->hashPassword();
        $pass = $this->password;
        $targetPath = $path;
        $off = $this->offset;
        $ts = $this->timestamp;

        $result = mysqli_query($conn,"INSERT INTO user(first_name, last_name, user_city,username,password,image_path,offset,timestamp) 
                                            VALUES ('$fn','$ln','$cn','$un','$pass','$targetPath',$off,$ts)") or die("Error ".mysqli_error());
        return $result;
    }

    public static function readAll($conn)
    {
        $result = mysqli_query($conn,"SELECT * FROM `user`") or die("Error ".mysqli_error());
        return $result;
    }

    public function readUnique()
    {
        // TODO: Implement readUnique() method.
    }

    public function search()
    {
        // TODO: Implement search() method.
    }

    public function update()
    {
        // TODO: Implement update() method.
    }

    public function removeOne()
    {
        // TODO: Implement removeOne() method.
    }

    public function removeAll()
    {
        // TODO: Implement removeAll() method.
    }

    public function validateForm()
    {
        $fn = $this->first_name;
        $ln = $this->last_name;
        $city = $this->city_name;

        if($fn == "" || $ln == "" || $city == "")
        {
            return false;
        }
        return true;
    }

    public function createFormErrorSessions()
    {
        session_start();
        $_SESSION['form_errors'] = 'All fields are required';
    }

    public function hashPassword()
    {
        $this->password = password_hash($this->password,PASSWORD_DEFAULT);
    }

    public static function isPasswordCorrect($password,$username)
    {
        $conn = new dbconnector();
        $found = false;
        $result = mysqli_query($conn->conn,"SELECT id, username, password FROM user WHERE username='$username'")
                    or die("Error".mysqli_error($conn->conn));


        if($result->num_rows > 0)
        {

            $row = $result->fetch_assoc();
            if (password_verify($password,$row['password']))
            {
                $found = true;

            }
        }

        $conn->closeConnection();
        return $found;
    }

    public function login($conn,$password,$username)
    {
        if(self::isPasswordCorrect())
        {
            header("Location:private_page.php");
        }
    }

    public static function createUserSession($username)
    {
        session_start();
        $_SESSION['username'] = $username;
    }

    public static function logout()
    {
        session_start();
        unset($_SESSION['username']);
        session_destroy();
        header("Location:lab1.php");
    }

    public function isUserExist()
    {
        
    }
}