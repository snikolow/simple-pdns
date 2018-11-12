<?php

namespace Devzone\Tests\Form;

use Devzone\Entity\Domain;
use Devzone\Enum\DomainTypesEnum;
use Devzone\Form\DomainType;
use Symfony\Component\Form\Test\TypeTestCase;

/**
 * Class DomainTypeTest
 * @package Devzone\Tests\Form
 */
class DomainTypeTest extends TypeTestCase
{

    public function testMasterDomainFormDataSubmission(): void
    {
        $formData = [
            'name' => 'example.org',
            'primaryRecord' => 'ns1.example.org',
            'refresh' => 3600,
            'expire' => 604800,
            'retry' => 900,
            'ttl' => 86400,
            'type' => DomainTypesEnum::TYPE_MASTER,
            'email' => 'admin@example.org',
        ];

        $object = new Domain();
        $object->setName('example.org');
        $object->setPrimaryRecord('ns1.example.org');
        $object->setEmail('admin@example.org');

        $compareObject = new Domain();
        $form = $this->factory->create(DomainType::class, $compareObject);

        $form->submit($formData);

        $this->assertTrue($form->isSynchronized());
        $this->assertEquals($object, $compareObject);

        $view = $form->createView();
        $children = $view->children;

        foreach (array_keys($formData) as $key) {
            $this->assertArrayHasKey($key, $children);
        }
    }

}
