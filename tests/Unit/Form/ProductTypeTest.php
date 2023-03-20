<?php

namespace App\Tests\Unit\Form;

use App\Entity\Product;
use App\Form\ProductType;
use Symfony\Component\Form\Test\TypeTestCase;

class ProductTypeTest extends TypeTestCase
{

    use \Symfony\Component\Form\Test\Traits\ValidatorExtensionTrait;

    public function testSubmitValidData()
    {
        $formData['product'] = [
            'name' => 'test',
            'storageCapacity' => '10',
            'price' => '10',
            'stock' => '10'
        ];

        $model = new Product();
        $form = $this->factory->create(ProductType::class, $model);

        $expected = new Product($formData['product']);
        $form->submit($formData);

        $this->assertTrue($form->isSynchronized());
        $this->assertEquals($expected, $model);
    }
}