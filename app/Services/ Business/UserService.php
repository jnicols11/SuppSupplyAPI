<?php

namespace App\Services\Business;

use App\Services\Data\UserDAO;

class UserService
{
    public static function getAllUsers() {
        return UserDAO::getAllUsers();
    }

    public static function getUserByID($id) {
        return UserDAO::getUserByID($id);
    }

    public static function register($user) {
        return UserDAO::register($user);
    }

    public static function login($email, $password) {
        return UserDAO::login($email, $password);
    }

    public static function update($user) {
        return UserDAO::update($user);
    }

    public static function delete($userID) {
        return UserDAO::delete($userID);
    }
}