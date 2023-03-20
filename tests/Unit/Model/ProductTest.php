<?php

namespace App\Tests\Unit\Entity;

use App\Entity\Product;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    const ID = '1';
    const NAME = 'Test produit';
    const STORAGECAPACITY = '8192';
    const PRICE = '100';
    const STOCK = '1';

    public function testProductName()
    {
        $product = new Product();

        $that = $product->setName(self::NAME);
        $this->assertSame($product, $that);
        $this->assertEquals(self::NAME, $product->getName());
    }

    public function testProductStorageCapacity()
    {
        $product = new Product();

        $that = $product->setStorageCapacity(self::STORAGECAPACITY);
        $this->assertSame($product, $that);
        $this->assertEquals(self::STORAGECAPACITY, $product->getStorageCapacity());
    }

    public function testProductPrice()
    {
        $product = new Product();

        $that = $product->setPrice(self::PRICE);
        $this->assertSame($product, $that);
        $this->assertEquals(self::PRICE, $product->getPrice());
    }

    public function testProductStock()
    {
        $product = new Product();

        $that = $product->setStock(self::STOCK);
        $this->assertSame($product, $that);
        $this->assertEquals(self::STOCK, $product->getStock());
    }
}