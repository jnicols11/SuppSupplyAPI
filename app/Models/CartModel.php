<?php

namespace App\Models;

use App\Models\ProductModel;

class CartModel 
{
    private $ID;
    private $userID;

    public function __construct($ID, $userID) {
        $this->ID = $ID;
        $this->userID = $userID;
    }

    public function getID() {
        return $this->ID;
    }

    public function getUserID() {
        return $this->userID;
    }

    public function setID($ID) {
        $this->ID = $ID;
    }

    public function setUserID($userID) {
        $this->userID = $userID;
    }

    public function jsonSerialize()
    {
        $vars = get_object_vars($this);

        return $vars;
    }
}