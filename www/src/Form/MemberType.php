<?php

namespace Devzone\Form;

use Devzone\Entity\Member;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * Class MemberType
 * @package Devzone\Form
 */
class MemberType extends AbstractType
{

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('username', EmailType::class, [
            'label' => 'member.username',
        ]);
        $builder->add('displayName', TextType::class, [
            'label' => 'member.display_name',
            'constraints' => [new NotBlank()],
        ]);
        $builder->add('plainPassword', RepeatedType::class, [
            'required' => ($builder->getData()->getId() === null),
            'first_options' => [
                'label' => 'Password',
            ],
            'second_options' => [
                'label' => 'Repeat Password',
            ],
            'constraints' => ($builder->getData()->getId())
                ? [new Length(['max' => 4096])]
                : [new Length(['max' => 4096]), new NotBlank()]
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