<?php
use PHPUnit\Framework\TestCase;
use Service\Implement\OrderProcessorImpl;
use Service\Products;
class OrderProcessingTests extends TestCase
{
    public function test1(): void{
        $orderProcessorImpl = OrderProcessorImpl::getOrderProcessorImpl();
        $orderProcessorImpl->processFromJson("./tests/resources/order1.json");

        $this->assertEquals(Products::$stockLevels[Products::BROWNIE],17);
        $this->assertEquals(Products::$stockLevels[Products::LAMINGTON],20);
        $this->assertEquals(Products::$stockLevels[Products::BLUEBERRY_MUFFIN],18);
        $this->assertEquals(Products::$stockLevels[Products::CROISSANT], 20);
        $this->assertEquals(Products::$stockLevels[Products::CHOCOLATE_CAKE], 7);

        $this->assertEquals(Products::$stockSold[Products::BROWNIE],3);
        $this->assertEquals(Products::$stockSold[Products::LAMINGTON],0);
        $this->assertEquals(Products::$stockSold[Products::BLUEBERRY_MUFFIN],2);
        $this->assertEquals(Products::$stockSold[Products::CROISSANT], 0);
        $this->assertEquals(Products::$stockSold[Products::CHOCOLATE_CAKE], 13);

        $this->assertEquals(Products::$purchaseOrder[1],[5]);

        $this->assertEquals(Products::$receivedStocks[Products::BROWNIE],0);
        $this->assertEquals(Products::$receivedStocks[Products::LAMINGTON],0);
        $this->assertEquals(Products::$receivedStocks[Products::BLUEBERRY_MUFFIN],0);
        $this->assertEquals(Products::$receivedStocks[Products::CROISSANT], 0);
        $this->assertEquals(Products::$receivedStocks[Products::CHOCOLATE_CAKE], 0);
    }

    public function test2(): void{
        $orderProcessorImpl = OrderProcessorImpl::getOrderProcessorImpl();
        $orderProcessorImpl->processFromJson("./tests/resources/order2.json");

        $this->assertEquals(Products::$stockLevels[Products::BROWNIE],12);
        $this->assertEquals(Products::$stockLevels[Products::LAMINGTON],9);
        $this->assertEquals(Products::$stockLevels[Products::BLUEBERRY_MUFFIN],5);
        $this->assertEquals(Products::$stockLevels[Products::CROISSANT], 20);
        $this->assertEquals(Products::$stockLevels[Products::CHOCOLATE_CAKE], 20);

        $this->assertEquals(Products::$stockSold[Products::BROWNIE],28);
        $this->assertEquals(Products::$stockSold[Products::LAMINGTON],11);
        $this->assertEquals(Products::$stockSold[Products::BLUEBERRY_MUFFIN],15);
        $this->assertEquals(Products::$stockSold[Products::CROISSANT], 0);
        $this->assertEquals(Products::$stockSold[Products::CHOCOLATE_CAKE], 0);

        $this->assertEquals(Products::$purchaseOrder[1],null);
        $this->assertEquals(Products::$purchaseOrder[2],[2]);
        $this->assertEquals(Products::$purchaseOrder[3],[3]);

        $this->assertEquals(Products::$receivedStocks[Products::BROWNIE],20);
        $this->assertEquals(Products::$receivedStocks[Products::LAMINGTON],0);
        $this->assertEquals(Products::$receivedStocks[Products::BLUEBERRY_MUFFIN],0);
        $this->assertEquals(Products::$receivedStocks[Products::CROISSANT], 0);
        $this->assertEquals(Products::$receivedStocks[Products::CHOCOLATE_CAKE], 0);

    }
    public function test3(): void{
        $orderProcessorImpl = OrderProcessorImpl::getOrderProcessorImpl();
        $orderProcessorImpl->processFromJson("./orders-sample.json");

        $this->assertEquals(Products::$stockLevels[Products::BROWNIE],13);
        $this->assertEquals(Products::$stockLevels[Products::LAMINGTON],3);
        $this->assertEquals(Products::$stockLevels[Products::BLUEBERRY_MUFFIN],13);
        $this->assertEquals(Products::$stockLevels[Products::CROISSANT], 16);
        $this->assertEquals(Products::$stockLevels[Products::CHOCOLATE_CAKE], 12);

        $this->assertEquals(Products::$stockSold[Products::BROWNIE],47);
        $this->assertEquals(Products::$stockSold[Products::LAMINGTON],37);
        $this->assertEquals(Products::$stockSold[Products::BLUEBERRY_MUFFIN],27);
        $this->assertEquals(Products::$stockSold[Products::CROISSANT], 24);
        $this->assertEquals(Products::$stockSold[Products::CHOCOLATE_CAKE], 28);

        $this->assertEquals(Products::$pendingOrder[Products::BROWNIE],0);
        $this->assertEquals(Products::$pendingOrder[Products::LAMINGTON], 20);
        $this->assertEquals(Products::$pendingOrder[Products::BLUEBERRY_MUFFIN], 0);
        $this->assertEquals(Products::$pendingOrder[Products::CROISSANT], 0);
        $this->assertEquals(Products::$pendingOrder[Products::CHOCOLATE_CAKE], 0);

        $this->assertEquals(Products::$receivedStocks[Products::BROWNIE],40);
        $this->assertEquals(Products::$receivedStocks[Products::LAMINGTON],20);
        $this->assertEquals(Products::$receivedStocks[Products::BLUEBERRY_MUFFIN],20);
        $this->assertEquals(Products::$receivedStocks[Products::CROISSANT], 20);
        $this->assertEquals(Products::$receivedStocks[Products::CHOCOLATE_CAKE], 20);

    }
    public function test4(): void
    {
        $orderProcessorImpl = OrderProcessorImpl::getOrderProcessorImpl();
        $orderProcessorImpl->processFromJson("./tests/resources/order3.json");
        $this->assertEquals(Products::$stockLevels[Products::BROWNIE],20);
        $this->assertEquals(Products::$stockLevels[Products::LAMINGTON],20);
        $this->assertEquals(Products::$stockLevels[Products::BLUEBERRY_MUFFIN],20);
        $this->assertEquals(Products::$stockLevels[Products::CROISSANT], 20);
        $this->assertEquals(Products::$stockLevels[Products::CHOCOLATE_CAKE], 20);
    }
}