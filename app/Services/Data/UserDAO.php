<?php

namespace App\Services\Data;

use App\Models\UserModel;
use Illuminate\Support\Facades\DB;

class UserDAO
{
    public static function getAllUsers() {
        // get all users from database and return as JSON data
        return DB::table('user')->get()->toJson();
    }

    public static function getUserByID($id) {
        // get user from database by ID
        $user = DB::table('user')->where('ID', $id)->first();

        $user = new UserModel($id, $user->FirstName, $user->LastName, $user->Email, null);

        return $user;
    }

    public static function register($user) {
        // check for repeat email address
        $value = DB::table('user')->where('Email', $user->getEmail());

        if ($value->count() == 0) {
            DB::table('user')->insert([
                'FirstName' => $user->getFirstName(),
                'LastName' => $user->getLastName(),
                'Email' => $user->getEmail(),
                'Password' => $user->getPassword()
            ]);

            return 200;
        } else {
            // email already exists
            return 422;
        }

        // return 500 server error
        return 500;
    }

    public static function login($email, $password) {
        // check email and password
        if (DB::table('user')->where('Email', $email)->value('Password') == $password) {
            // set User Object
            $user = DB::table('user')->where('Email', $email)->first();
            $firstName = $user->FirstName;
            $lastName = $user->LastName;
            $email = $user->Email;
            $ID = $user->ID;
            
            // populate User Model
            $user = new UserModel($ID, $firstName, $lastName, $email, null);

            return $user;
        } else {
            // return login failed status code
            return 401;
        }
    }

    public static function update($user) {
        // update user in database
        DB::update('update user set FirstName = ? and LastName = ? and Email = ? where ID = ?', [$user->getFirstName(), $user->getLastName(), $user->getEmail(), $user->getID()]);
    }

    public static function updatePassword($ID, $password) {
        // update user password in database
        DB::update('update user set Password = ? where ID = ?', [$password, $ID]);
    }

    public static function delete($userID) {
        // Delete user in database
        DB::delete('delete user where ID = ?', [$userID]);
    }
}
