<?php

class PassHash
{
    // this will be used to generate a hash
    public static function hash($password)
    {
        return password_hash($password, PASSWORD_DEFAULT, array("cost" => 10));
    }

    // this will be used to compare a password against a hash
    public static function check_password($password, $hash)
    {
        return password_verify($password, $hash);
    }
}
