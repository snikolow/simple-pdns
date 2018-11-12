<?php

namespace Devzone\Form;

use Devzone\Entity\Domain;
use Devzone\Enum\DomainTypesEnum;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class DomainType
 * @package Devzone\Form
 */
class DomainType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if ($options['renderAllElements']) {
            $builder->add('name', TextType::class, [
                'label' => 'domain.name',
            ]);
            $builder->add('email', EmailType::class, [
                'label' => 'domain.email',
            ]);
        }
        $builder->add('primaryRecord', TextType::class, [
            'label' => 'domain.primary',
        ]);
        $builder->add('refresh', NumberType::class, [
            'label' => 'domain.refresh',
        ]);
        $builder->add('expire', NumberType::class, [
            'label' => 'domain.expire',
        ]);
        $builder->add('retry', NumberType::class, [
            'label' => 'domain.retry',
        ]);
        $builder->add('ttl', NumberType::class, [
            'label' => 'domain.ttl',
        ]);
        $builder->add('type', ChoiceType::class, [
            'label' => 'domain.type',
            'choices' => DomainTypesEnum::getOptions(),
            'disabled' => true,
        ]);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'class' => Domain::class,
            'translation_domain' => 'forms',
            'renderAllElements' => true,
        ]);
    }

}
