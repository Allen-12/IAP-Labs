<?php

interface Authenticator
{
    public function hashPassword();

    public static function isPasswordCorrect($password,$username);

    public function login($conn,$password,$username);

    public static function logout();

    public function createFormErrorSessions();
}