<?php

namespace App\Models;

class ProductModel 
{
    private $ID;
    private $name;
    private $description;
    private $price;
    private $quantity;
    private $image;

    public function __construct($ID, $name, $description, $price, $quantity, $image) {
        $this->ID = $ID;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->quantity = $quantity;
        $this->image = $image;
    }

    public function getID() {
        return $this->ID;
    }

    public function getName() {
        return $this->name;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getQuantity() {
        return $this->quantity;
    }

    public function getImage() {
        return $this->image;
    }

    public function setID($ID) {
        $this->ID = $ID;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function setQuantity($quantity) {
        $this->quantity = $quantity;
    }

    public function setImage($image) {
        $this->image = $image;
    }

    public function jsonSerialize()
    {
        $vars = get_object_vars($this);

        return $vars;
    }
}