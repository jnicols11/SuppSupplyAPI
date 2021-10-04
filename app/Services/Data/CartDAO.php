<?php

namespace App\Services\Data;

use App\Models\CartModel;
use App\Models\ProductModel;
use Illuminate\Support\Facades\DB;

class CartDAO
{
    public static function getAllCarts() {
        // get all carts from database and return as JSON data
        return DB::table('cart')->get()->toJson();
    }

    public static function getCartByID($id) {
        // get cart from database by ID
        $cart = DB::table('cart')->where('ID', $id)->first();

        if ($cart != null) {
            $cart = new CartModel($id, $cart->userID);

            return $cart;
        }

        return null;
    }

    public static function getCartByUser($userID) {
        // get cart from database based on userID
        $cart = DB::table('cart')->where('userID', $userID)->first();

        $cart = new CartModel($cart->ID, $userID);

        return $cart;
    }

    public static function getCartProducts($id) {
        // get all products from database connected to cart
        $products = DB::table('cartproduct')->where('cartID', $id)->get();

        // loop through products array
        if ($products->count() > 0) {
            return $products;
        }

        return [];
    }

    public static function create($cart) {
        // check for repeat cart creation
        $value = DB::table('cart')->where('userID', $cart->getUserID());

        if ($value->count() == 0) {
            DB::table('cart')->insert([
                'userID' => $cart->getUserID()
            ]);

            return 200;
        } else {
            // cart already exists
            return 422;
        }

        // internal server error
        return 500;
    }

    public static function addToCart($product, $cartID) {
        // check for repeat item
        $value = DB::table('cartproduct')->where([['cartID', '=', $cartID], ['productID', '=', $product->getID()]])->get();

        if ($value->count() == 0) {
            DB::table('cartproduct')->insert([
                'Name' => $product->getName(),
                'Description' => $product->getDescription(),
                'Price' => $product->getPrice(),
                'Quantity' => 1,
                'Image' => $product->getImage(),
                'cartID' => $cartID,
                'productID' => $product->getID()
            ]);

            return 200;
        } else {
            // product already in cart, increase quantity
            DB::update('update cartproduct set Quantity = ? where productID = ?', [($value[0]->Quantity + 1), $product->getID()]);

            return 200;
        }

        // internal server error
        return 500;
    }

    public static function removeFromCart($productID, $cartID) {
        DB::table('cartproduct')->delete($cartID, $productID);

        return 200;
    }

    public static function update($cart) {

    }

    public static function delete($id) {
        DB::table('cart')->delete($id);
    }
}