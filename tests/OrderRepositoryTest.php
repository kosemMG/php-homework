<?php

namespace app\tests;


use app\models\repositories\OrderRepository;
use PHPUnit\Framework\TestCase;

final class OrderRepositoryTest extends TestCase
{
    public function testGetTableName()
    {
        $orderRepository = new OrderRepository();
        $result = $orderRepository->getTableName();

        $this->assertIsNotFloat($result);
        $this->assertIsNotInt($result);
        $this->assertIsNotNumeric($result);
        $this->assertIsNotArray($result);
        $this->assertIsString($result);
        $this->assertGreaterThan(0, strlen($result));
        $this->assertEquals(6, strlen($result));
        $this->assertEquals(1, str_word_count($result));
        $this->assertEquals('orders', $result);
    }

    public function testGetEntityClass()
    {
        $orderRepository = new OrderRepository();
        $result = $orderRepository->getEntityClass();

        $this->assertIsString($result);
        $this->assertGreaterThan(0, strlen($result));
        $this->assertEquals("app\\models\\entities\\Order", $result);
    }
}