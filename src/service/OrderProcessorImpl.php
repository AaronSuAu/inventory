<?php

namespace Service\Implement;
use Service\Products;
use Service\OrderProcessorInterface;

class OrderProcessorImpl implements OrderProcessorInterface{
    private $inventoryImpl;
    private $productsSoldImpl;
    private $productsPurchasedImpl;
    private static $orderProcessorImpl;
    private function OrderProcessorImpl(){}
    public static function getOrderProcessorImpl():OrderProcessorImpl{
        if(self::$orderProcessorImpl == null){
            self::$orderProcessorImpl = new OrderProcessorImpl();
            return self::$orderProcessorImpl;
        }else {return self::$orderProcessorImpl;}

    }
    /**
     * Init all the services
     */
    public function initAllServices():void{
        $this->inventoryImpl = InventoryImpl::getInventoryImpl();
        $this->productsSoldImpl = ProductsSoldImpl::getProductsSoldImpl();
        $this->productsPurchasedImpl = ProductsPurchasedImpl::getProductsPurchasedImpl();
    }

    /**
     * check if the single item purchase amount is less than the current amount
     * @param int $id
     * @param int $num
     * @return bool
     */
    public function checkSinglePurchase(int $id, int $num):bool {
        // First check if the product Id is valid
        if(!in_array($id, Products::products)) return false;
        $currentAmount = $this->inventoryImpl->getStockLevel($id);
        if($currentAmount>$num){
            return true;
        }else{
            return false;
        }
    }

    /**
     * After the transaction, update the stock level and sold
     * @param int $id
     * @param int $num
     *
     */
    public function processSinglePurchase(int $id, int $num):void {
        $currentAmount = $this->inventoryImpl->getStockLevel($id);
        if($currentAmount>$num){
            $this->inventoryImpl->updateStockLevel($id, $currentAmount - $num);
            $this->productsSoldImpl->updateSoldTotal($id, $num);
        }
    }

    /**
     * @param string $filePath
     * @return array
     * read the file and return the Json Array
     */
    public function getOrders(string $filePath): array {
        $json = array();
        try{
            $str = file_get_contents($filePath);
            $json = json_decode($str, true);
        } catch (Exception $e){
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
        return $json;
    }

    /**
     * Process multiple orders of the day
     * @param array $dayOrder
     *
     */
    public function processDayOrder(array $dayOrder):void{
        foreach ($dayOrder as $eachOrder) {
            $flag = true;
            // first check if there are enough stocks for the order
            foreach ($eachOrder as $productId => $amount){
                if (!$this->checkSinglePurchase((int)$productId, (int)$amount)){
                    $flag = false;
                    break;
                }
            }
            if(!$flag) {continue;}
            // if there are enough stocks, let the transaction happen
            foreach ($eachOrder as $productId => $amount){
                $this->processSinglePurchase((int)$productId, (int)$amount);
            }
        }
    }
    /**
     * This function receives the path of the json for all the orders of the week,
     * processes all orders for the week,
     * while keeping track of stock levels, units sold and purchased
     * See `orders-sample.json` for example
     *
     * @param string $filePath
     */
    public function processFromJson(string $filePath):void
    {
        Products::initStocks();
        $this->initAllServices();

        $orders = $this->getOrders($filePath);
        if(count($orders) == 0) return;
        $days = 1;
        foreach ($orders as $dayOrder) {
            //At the beginning of the day, check if there are coming stock
            $this->productsPurchasedImpl->pendingPurchaseArrived($days);
            // Start to process the orders of the day
            $this->processDayOrder($dayOrder);
            // At the end of the day, make orders for below 10 items
            $this->productsPurchasedImpl->addPendingPurchase($days);
            $days ++;
        }
        //at the end of each week
        $this->productsPurchasedImpl->getAllPending();
    }
}
?>