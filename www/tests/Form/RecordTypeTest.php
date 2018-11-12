<?php

namespace Devzone\Tests\Form;

use Devzone\Entity\Record;
use Devzone\Enum\RecordTypesEnum;
use Devzone\Form\RecordType;
use Symfony\Component\Form\Test\TypeTestCase;

/**
 * Class RecordTypeTest
 * @package Devzone\Tests\Form
 */
class RecordTypeTest extends TypeTestCase
{

    public function testRecordFormDataSubmission(): void
    {
        $formData = [
            'name' => 'example.org',
            'type' => RecordTypesEnum::TYPE_A,
            'content' => '12.34.56.78',
            'ttl' => 14400,
            'priority' => 0,
            'disabled' => true,
        ];

        $object = new Record();
        $object->setName('example.org');
        $object->setType(RecordTypesEnum::TYPE_A);
        $object->setContent('12.34.56.78');
        $object->setTtl(14400);
        $object->setPriority(0);
        $object->setDisabled(true);

        $compareObject = new Record();
        $form = $this->factory->create(RecordType::class, $compareObject);

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
