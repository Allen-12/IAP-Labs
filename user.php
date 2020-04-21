<?php
include 'crud.php';

class User implements Crud
{
    private $user_id;
    private $first_name;
    private $last_name;
    private $city_name;

    public function __construct($fname,$lname,$cname)
    {
        $this->first_name = $fname;
        $this->last_name  = $lname;
        $this->city_name = $cname;
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

    public function save($conn)
    {
        $fn = $this->first_name;
        $ln = $this->last_name;
        $cn = $this->city_name;

        $result = mysqli_query($conn,"INSERT INTO user(first_name, last_name, user_city) VALUES ('$fn','$ln','$cn')") or die("Error ".mysqli_error());
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
}