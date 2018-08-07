<?php
namespace Service;
use Service\Implement\ProductsPurchasedImpl;
class Products
{
    const BROWNIE = 1;
    const LAMINGTON = 2;
    const BLUEBERRY_MUFFIN = 3;
    const CROISSANT = 4;
    const CHOCOLATE_CAKE = 5;
    const products =[self::BROWNIE, self::LAMINGTON, self::BLUEBERRY_MUFFIN, self::CROISSANT, self::CHOCOLATE_CAKE];
    const productsName=array(self::BROWNIE => "Brownie",
        self::LAMINGTON => "Lamington", self::BLUEBERRY_MUFFIN=>"Blueberry Muffin",
        self::CROISSANT => "Croissant", self::CHOCOLATE_CAKE => "Chocolate Cake");
    public static $stockLevels;
    public static $stockSold;
    public static $receivedStocks;
    public static $purchaseOrder;//["day(int)":[...id]]
    public static $pendingOrder;
    public static function initStocks():void {
        self::$purchaseOrder = array();
        foreach (self::products as $productId) {
            self::$stockSold[$productId] = 0;
            self::$receivedStocks[$productId] = 0;
            self::$stockLevels[$productId] = 20;
            self::$pendingOrder[$productId] = 0;
        }
    }

}