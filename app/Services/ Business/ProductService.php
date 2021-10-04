<?php

namespace App\Services\Business;

use App\Services\Data\ProductDAO;

class ProductService 
{
    public static function getAllProducts() {
        return ProductDAO::getAllProducts();
    }

    public static function getProductByID($id) {
        return ProductDAO::getProductByID($id);
    }

    public static function searchProductsByName($name) {
        return ProductDAO::searchProductByName($name);
    }

    public static function searchProductsByDesc($desc) {
        return ProductDAO::searchProductByDesc($desc);
    }

    public static function createProduct($product) {
        return ProductDAO::createProduct($product);
    }

    public static function updateProduct($product) {
        return ProductDAO::updateProduct($product);
    }

    public static function deleteProduct($productID) {
        return ProductDAO::deleteProduct($productID);
    }
}