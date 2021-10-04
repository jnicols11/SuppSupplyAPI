<?php

namespace App\Services\Data;

use App\Models\ProductModel;
use Illuminate\Support\Facades\DB;

class ProductDAO
{
    public static function getAllProducts() {
        // get all products from database and return as JSON data
        return DB::table('product')->get()->toJson();
    }

    public static function getProductByID($id) {
        // get product from database by ID
        $product = DB::table('product')->where('ID', $id)->first();

        if ($product != null) {
            $product = new ProductModel($id, $product->Name, $product->Description, $product->Price, $product->Quantity, $product->Image);

            return $product;
        }

        return null;
    }

    public static function searchProductByName($name) {
        // search for products by name in database
        $products = DB::table('product')->where('Name', $name)->get();

        if ($products->count() > 0) {
            return $products;
        }

        return 404;
    }

    public static function searchProductByDesc($desc) {
        // search for products by description in database
        $products = DB::table('product')->where('Description', 'like', $desc)->get();

        if ($products->count() > 0) {
            return $products;
        }

        return 404;
    }

    public static function createProduct($product) {
           // check for repeat email address
           $value = DB::table('product')->where('Name', $product->getName());

           if ($value->count() == 0) {
               DB::table('product')->insert([
                   'Name' => $product->getName(),
                   'Description' => $product->getDescription(),
                   'Price' => $product->getPrice(),
                   'Quantity' => $product->getQuantity(),
                   'Image' => $product->getImage()
               ]);

               return 200;
            } else {
               // Increment product quantity
                $product = new ProductModel($value[0]->ID, $value[0]->Name, $value[0]->Description, $value[0]->Price, $value[0]->Quantity, $value[0]->Image);

                $product->setQuantity($product->getQuantity + 1);

                updateProduct($product);
            }
   
           // return 500 server error
           return 500;
    }

    public static function updateProduct($product) {
        // update entire product
        DB::update('update product set Name = ? and Description = ? and Price = ? and Quantity = ? and Image = ? where ID = ?', [$product->getName(), $product->getDescription(), $product->getPrice(), $product->getQuantity, $product->getImage(), $product->getID()]);

        return 200;
    }

    public static function deleteProduct($productID) {
        // Delete product from DB based on ID
        DB::table('product')->delete($productID);

        return 200;
    }   
}