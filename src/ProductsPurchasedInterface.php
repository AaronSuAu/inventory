<?php
namespace Service;
interface ProductsPurchasedInterface
{
    /**
     * @param int $productId
     * @return int
     */
    public function getPurchasedReceivedTotal(int $productId): int;

    /**
     * @param int $productId
     * @return int
     */
    public function updatePurchasedReceivedTotal(int $productId): void;
    /**
     * @param int $productId
     * @return int
     */
    public function getPurchasedPendingTotal(int $productId): int;

    /**
     * @param int $productId
     * @param int $day
     */
    public function addPendingPurchase(int $day):void;

    /**
     * @param int $day
     */
    public function pendingPurchaseArrived(int $day): void;
}
