<?php

namespace Devzone\EventListener;

use Devzone\Entity\Member;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class MemberListener
 * @package Devzone\EventListener
 */
class MemberListener implements EventSubscriber
{

    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    /**
     * MemberListener constructor.
     * @param UserPasswordEncoderInterface $encoder
     */
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    /**
     * {@inheritdoc}
     */
    public function getSubscribedEvents(): array
    {
        return [
            'prePersist',
            'preUpdate',
        ];
    }

    /**
     * @param LifecycleEventArgs $eventArgs
     */
    public function prePersist(LifecycleEventArgs $eventArgs)
    {
        /** @var Member $entity */
        $entity = $eventArgs->getEntity();

        if (!$entity instanceof UserInterface) {
            return;
        }

        // Ensure plain password is present - meaning that this change is not triggered by
        // regular profile update, but ChangePassword is used instead.
        if (!$plainPassword = $entity->getPlainPassword()) {
            return;
        }

        $entity->setPassword($this->encoder->encodePassword(
            $entity,
            $entity->getPlainPassword()
        ));
    }

    /**
     * @param PreUpdateEventArgs $eventArgs
     */
    public function preUpdate(PreUpdateEventArgs $eventArgs)
    {
        /** @var Member $entity */
        $entity = $eventArgs->getEntity();

        if (!$entity instanceof UserInterface) {
            return;
        }

        $entityManager = $eventArgs->getEntityManager();
        $classMetadata = $entityManager->getClassMetadata(Member::class);

        // Ensure plain password is present - meaning that this change is not triggered by
        // regular profile update, but ChangePassword is used instead.
        if (!$plainPassword = $entity->getPlainPassword()) {
            return;
        }

        $entity->setPassword($this->encoder->encodePassword(
            $entity,
            $entity->getPlainPassword()
        ));

        $entityManager
            ->getUnitOfWork()
            ->recomputeSingleEntityChangeSet($classMetadata, $entity);
    }

}