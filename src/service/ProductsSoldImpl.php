<?php
namespace Service\Implement;
use Service\Products;
use Service\ProductsSoldInterface;
class ProductsSoldImpl implements ProductsSoldInterface
{
    private static $productsSoldImpl;
    private function ProductsSoldImpl() {}
    public static function getProductsSoldImpl(): ProductsSoldImpl{
        if(self::$productsSoldImpl == null){
            self::$productsSoldImpl = new ProductsSoldImpl();
            return self::$productsSoldImpl;
        }else {return self::$productsSoldImpl;}
    }

    /**
     * @param int $productId
     * @return int
     */
    public function getSoldTotal(int $productId): int
    {
        return Products::$stockSold[$productId];
    }

    /**
     * @param int $productId
     * @param int $amount
     */
    public function updateSoldTotal(int $productId, int $amount): void
    {
        Products::$stockSold[$productId] += $amount;
    }
}