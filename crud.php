<?php

interface Crud
{
    public function save($conn);

    public static function readAll($conn);

    public function readUnique();

    public function search();

    public function update();

    public function removeOne();

    public function removeAll();
}
?>
