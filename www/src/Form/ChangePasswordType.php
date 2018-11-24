<?php

namespace Devzone\Form;

use Devzone\Entity\Member;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * Class ChangePasswordType
 * @package Devzone\Form
 */
class ChangePasswordType extends AbstractType
{

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // Use the non-mapped field plainPassword to change te password only when necessary.
        // By invoking setPlainPassword() we reset the already encoded "password" field
        // so that we can trigger successfully the preUpdate() event listener.
        $builder->add('plainPassword', RepeatedType::class, [
            'first_options' => [
                'label' => 'Password',
            ],
            'second_options' => [
                'label' => 'Repeat Password',
            ],
            'constraints' => [
                new NotBlank(),
                new Length(['max' => 4096]),
            ],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'class' => Member::class,
            'translation_domain' => 'forms',
        ]);
    }

}