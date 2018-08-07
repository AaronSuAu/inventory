<?php
namespace Service;
interface ProductsSoldInterface
{
    /**
     * @param int $productId
     * @return int
     */
    public function getSoldTotal(int $productId): int;

    /**
     * @param int $productId
     * @param int $amount
     */
    public function updateSoldTotal(int $productId, int $amount): void;
}
