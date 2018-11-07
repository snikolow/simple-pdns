<?php

namespace Devzone\Form;

use Devzone\Entity\Domain;
use Devzone\Enum\DomainTypesEnum;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
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
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', TextType::class, [
            'label' => 'domain.name',
        ]);
        $builder->add('type', ChoiceType::class, [
            'label' => 'domain.type',
            'choices' => DomainTypesEnum::getOptions(),
            'disabled' => true,
        ]);
    }

    /**
     * @param \Symfony\Component\OptionsResolver\OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'class' => Domain::class,
            'translation_domain' => 'forms',
        ]);
    }

}
