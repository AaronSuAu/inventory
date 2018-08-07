<?php
namespace Service\Implement;
use Service\ProductsPurchasedInterface;
use Service\Products;
class ProductsPurchasedImpl implements  ProductsPurchasedInterface
{

    const AMOUNT=20;
    private function ProductsPurchasedImpl(){}
    private static $productsPurchasedImpl;
    public static function getProductsPurchasedImpl(): ProductsPurchasedImpl{
        if(self::$productsPurchasedImpl == null){
            self::$productsPurchasedImpl = new ProductsPurchasedImpl();
            return self::$productsPurchasedImpl;
        }else return self::$productsPurchasedImpl;
    }
    /**
     * @param int $productId
     * @return int
     */
    public function getPurchasedReceivedTotal(int $productId): int
    {
        return Products::$receivedStocks[$productId];
    }

    public function updatePurchasedReceivedTotal(int $productId):void{
        Products::$receivedStocks[$productId] += self::AMOUNT;
    }

    /**
     * @param int $productId
     * @return int
     */
    public function getPurchasedPendingTotal(int $productId): int
    {
        $purchasedOrder = Products::$purchaseOrder;
        $total = 0;
        foreach ($purchasedOrder as $day => $items) {
            foreach ($items as $item) {
                if($item == $productId) $total += 20;
            }
        }
        return $total;
    }
    public function getAllPending():void{
        foreach (Products::products as $productId) {
            Products::$pendingOrder[$productId] = $this->getPurchasedPendingTotal($productId);
        }
    }

    /**
     * @param int $day
     */
    public function addPendingPurchase(int $day): void
    {
        $stocks = Products::$stockLevels;
        //print_r($stocks);
        $orders = array();
        foreach ($stocks as $id => $amount){
            if($amount < 10 && ($day == 1 || !(in_array($id, Products::$purchaseOrder[$day-1])))){
                array_push($orders, $id);
            }
        }
        Products::$purchaseOrder[$day]=$orders;
    }

    /**
     * @param int $day
     */
    public function pendingPurchaseArrived(int $day): void
    {
        if($day -2 <= 0 ) return;
        //$stocks = Products::$stockLevels;
        $purchasedOrder = Products::$purchaseOrder;
        $orderArrive = $purchasedOrder[$day - 2];
        if(count($orderArrive) <= 0) return;

        foreach ($orderArrive as $id){
            Products::$stockLevels[$id] += self::AMOUNT;
            $this->updatePurchasedReceivedTotal($id);
        }
        // remove the pending as they arrived
        unset(Products::$purchaseOrder[$day -2]);
    }
}