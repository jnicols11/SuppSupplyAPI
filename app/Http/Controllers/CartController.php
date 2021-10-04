<?php

namespace App\Http\Controllers;

use App\Services\Business\CartService;
use Illuminate\Http\Request;
use App\Models\CartModel;
use App\Models\ProductModel;

class CartController extends Controller
{
    public function getAllCarts() {
        $carts = [];

        if (CartService::getAllCarts() != 500) {
            // populate carts array
            $carts = CartService::getAllCarts();

            return $carts;
        } else {
            // return error response
			return repsonse()->json([
				'message' => 'Internal server error'
			], 500);
        }
    }

    public function getCartByID($id) {
        $cart = CartService::getCartByID($id);

        if ($cart != null) {
            // return cart as JSON data
            return $cart->jsonSerialize();
        } else {
            return response()->json([
				'message' => 'Cart not found'
			], 404);
        }
    }

    public function getCartByUser($userID) {

        $cart = CartService::getCartByUser($userID);

        if ($cart != null) {
            // return cart as JSON data
            return $cart->jsonSerialize();
        } else {
            return response()->json([
                'message' => 'Cart not found for user'
            ], 404);
        }

        // return error response
        return repsonse()->json([
            'message' => 'Internal server error'
        ], 500);
    }

    public function getCartProducts($id) {

        $products = CartService::getCartProducts($id);

        if ($products != null) {
            // return products as JSON data
            return $products;
        } else {
            return response()->json([
                'message' => 'Cart not found'
            ], 404);
        }

        // return error response
        return repsonse()->json([
            'message' => 'Internal server error'
        ], 500);
    }

    public function createCart(Request $request) {
        // Establish variables from request
        $userID = $request->input('userID');

        // Populate cart model
        $cart = new CartModel(-1, $userID);

        if (CartService::create($cart) == 200) {
            // return creation success message
            return response()->json([
                'message' => 'cart created successfully'
            ], 200);
        } else if (CartService::create($cart) == 422) {
            // return cart already exists
            return response()->json([
                'message' => 'cart already exists'
            ], 422);
        } else {
            // return error response
			return repsonse()->json([
				'message' => 'Internal server error'
			], 500);
        }
    }

    public function addToCart(Request $request) {
        // Establish variables from request
        $productID = $request->input('productID');
        $cartID = $request->input('cartID');

        if (CartService::addToCart($productID, $cartID) == 200) {
            // add product to cart
            CartService::addToCart($productID, $cartID);

            // return success response
            return response()->json([
                'message' => 'Product added to cart'
            ], 200);
        } else {
            // return error response
			return repsonse()->json([
				'message' => 'Internal server error'
			], 500);
        }
    }

    public function removeFromCart(Request $request) {
        // Establish variables from request
        $productID = $request->input('productID');
        $cartID = $request->input('cartID');

        if (CartService::removeFromCart($productID, $cartID) == 200) {
            // remove product from cart
            CartService::removeFromCart($productID, $cartID);

            // return success response
            return response()->json([
                'message' => 'Product removed from cart'
            ], 200);
        } else {
            // return error response
			return response()->json([
				'message' => 'Internal server error'
			], 500);
        }
    }

    public function updateCart(Request $request) {

    }

    public function deleteCart(Request $request) {
        // Establish variables from request
        $id = $request->input('id');
    }
}