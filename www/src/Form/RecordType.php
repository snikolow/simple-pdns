<?php

namespace Devzone\Form;

use Devzone\Entity\Record;
use Devzone\Enum\RecordTypesEnum;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class RecordType
 * @package Devzone\Form
 */
class RecordType extends AbstractType
{

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', TextType::class, [
            'label' => 'record.name',
        ]);
        $builder->add('content', TextareaType::class, [
            'label' => 'record.content',
        ]);
        $builder->add('ttl', NumberType::class, [
            'label' => 'record.ttl',
        ]);
        $builder->add('priority', NumberType::class, [
            'label' => 'record.priority',
        ]);
        $builder->add('disabled', CheckboxType::class, [
            'label' => 'record.disabled',
            'required' => false,
        ]);
        $builder->add('orderName', TextType::class, [
            'label' => 'record.order_name',
            'required' => false,
        ]);

        $builder->addEventListener(FormEvents::POST_SET_DATA, function(FormEvent $event) {
            /** @var Record $record */
            $record = $event->getData();

            if ($record->getType() && ($record->getType() === RecordTypesEnum::TYPE_SOA)) {
                return;
            }

            $event->getForm()->add('type', ChoiceType::class, [
                'label' => 'record.type',
                'choices' => RecordTypesEnum::getOptionsForRecord(),
            ]);
        });
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'class' => Record::class,
            'translation_domain' => 'forms',
        ]);
    }

}
