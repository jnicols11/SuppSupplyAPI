<?php

namespace App\Services\Business;

use App\Services\Data\CartDAO;

class CartService
{
    public static function getAllCarts() {
        return CartDAO::getAllCarts();
    }

    public static function getCartByID($id) {
        return CartDAO::getCartByID($id);
    }

    public static function getCartByUser($userID) {
        return CartDAO::getCartByUser($userID);
    }

    public static function getCartProducts($id) {
        return CartDAO::getCartProducts($id);
    }

    public static function create($cart) {
        return CartDAO::create($cart);
    }

    public static function addToCart($productID, $cartID) {
        // get product from service
        $product = ProductService::getProductByID($productID);
        return CartDAO::addToCart($product, $cartID);
    }

    public static function removeFromCart($productID, $cartID) {
        return CartDAO::removeFromCart($productID, $cartID);
    }

    public static function update($cart) {
        return CartDAO::update($cart);
    }

    public static function delete($id) {
        return CartDAO::delete($id);
    }
}