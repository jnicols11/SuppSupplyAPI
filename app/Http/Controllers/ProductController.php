<?php

namespace App\Http\Controllers;

use App\Services\Business\ProductService;
use Illuminate\Http\Request;
use App\Models\ProductModel;

class ProductController extends Controller 
{
    public function getAllProducts() {
        $products = [];

        if (ProductService::getAllProducts() != 500) {
            // populate users array
            $products = ProductService::getAllProducts();

            return $products;
        } else {
            // return error response
			return repsonse()->json([
				'message' => 'Internal server error'
			], 500);
        }
    }

    public function getProductByID($id) {

        $product = ProductService::getProductByID($id);

        if ($product != null) {
            return $product->jsonSerialize();
        } else {
			return response()->json([
				'message' => 'Product not found'
			], 404);
		}
    }

    public function searchProductsByName(Request $request) {
        $name = $request->input('name');

        return ProductService::searchProductsByName($name);
    }

    public function searchProductsByDesc(Request $request) {

        $desc = $request->input('desc');

        return ProductService::searchProductsByDesc($desc);
    }

    public function createProduct(Request $request) {
        // Establish variables from request
        $name = $request->input('name');
        $description = $request->input('desc');
        $price = $request->input('price');
        $quantity = $request->input('quantity');
        $image = $request->input('image');

        // populate model
        $product = new ProductModel(-1, $name, $description, $price, $quantity, $image);

        if (ProductService::createProduct($product) == 200) {
            // return creation success message
            return response()->json([
                'message' => 'Product created successfully'
            ], 200);
        } else if (ProductService::createProduct($product) == 422) {
            // return product already exists
            return response()->json([
                'message' => 'Product already exists'
            ], 422);
        } else {
            // return error response
			return repsonse()->json([
				'message' => 'Internal server error'
			], 500);
        }
    }

    public function updateProduct(Request $request) {
        // Establish variables from
    }

    public function deleteProduct(Request $request) {

    }
}