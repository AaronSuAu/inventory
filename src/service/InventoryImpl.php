<?php


namespace Service\Implement;
use Service\InventoryInterface;
use Service\Products;

class InventoryImpl implements InventoryInterface{
    /**
     * @param int $productId
     * @return int
     */
    private static $inventoryImpl;
    private function InventroyImpl(){}
    public static function getInventoryImpl():InventoryImpl{
        if(self::$inventoryImpl == null){
            self::$inventoryImpl = new InventoryImpl();
            return self::$inventoryImpl;
        } else {return self::$inventoryImpl;}
    }
    public function getStockLevel(int $productId): int
    {
        return Products::$stockLevels[$productId];
    }

    public function updateStockLevel(int $productId, $amount): void
    {
        Products::$stockLevels[$productId] = $amount;
    }
}