<?php
namespace Service;
interface InventoryInterface
{
    /**
     * @param int $productId
     * @return int
     */
    public function getStockLevel(int $productId): int;

    public function updateStockLevel(int $productId, $amount): void;
}
