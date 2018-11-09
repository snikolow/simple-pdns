<?php

namespace Devzone\Action\Domain;

use Devzone\Action\BaseActionCreate;
use Devzone\Entity\Domain;
use Devzone\Enum\Events;
use Devzone\Event\Domain\DomainCreatedEvent;
use Devzone\Form\DomainType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Twig\Environment;

/**
 * Class CreateAction
 * @package Devzone\Action\Domain
 */
class CreateAction extends BaseActionCreate
{

    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    /**
     * CreateAction constructor.
     * @param Environment $twig
     * @param FormFactoryInterface $formFactory
     * @param EntityManagerInterface $entityManager
     * @param RouterInterface $router
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(
        Environment $twig,
        FormFactoryInterface $formFactory,
        EntityManagerInterface $entityManager,
        RouterInterface $router,
        EventDispatcherInterface $eventDispatcher
    ) {
        parent::__construct($twig, $formFactory, $entityManager, $router);

        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @Route("/domain/{type}/create", requirements={"type": "(master|slave|native)"}, name="action.domain.create")
     *
     * @param Request $request
     * @param string $type
     *
     * @return Response
     */
    public function __invoke(Request $request, string $type): Response
    {
        $entity = new Domain();
        $entity->setType($type);
        $form = $this->getFormFactory()->create(DomainType::class, $entity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getEntityManager()->persist($entity);
            $this->getEntityManager()->flush();

            $this->eventDispatcher->dispatch(
                Events::ON_DOMAIN_CREATED,
                new DomainCreatedEvent($entity)
            );

            return new RedirectResponse(
                $this->getRouter()->generate('action.domain.index')
            );
        }

        return new Response(
            $this->getTwig()->render('domain/form.html.twig', [
                'form' => $form->createView(),
            ])
        );
    }

}
