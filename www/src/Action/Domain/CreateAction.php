<?php

namespace Devzone\Action\Domain;

use Devzone\Action\Contract\ActionInterface;
use Devzone\Entity\Domain;
use Devzone\Form\DomainType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;
use Twig\Environment;

/**
 * Class CreateAction
 * @package Devzone\Action\Domain
 */
class CreateAction implements ActionInterface
{

    /**
     * @var \Twig\Environment
     */
    private $twig;

    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * IndexAction constructor.
     * @param \Twig\Environment $twig
     * @param FormFactoryInterface $formFactory
     * @param EntityManagerInterface $entityManager
     * @param RouterInterface $router
     */
    public function __construct(
        Environment $twig,
        FormFactoryInterface $formFactory,
        EntityManagerInterface $entityManager,
        RouterInterface $router
    ) {
        $this->twig = $twig;
        $this->formFactory = $formFactory;
        $this->entityManager = $entityManager;
        $this->router = $router;
    }

    /**
     * @Route("/domain/create", name="action.domain.create")
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function __invoke(Request $request): Response
    {
        $form = $this->formFactory->create(DomainType::class, new Domain());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            return new RedirectResponse(
                $this->router->generate('action.domain.list')
            );
        }

        return new Response(
            $this->twig->render('domain/form.html.twig', [
                'form' => $form->createView(),
            ])
        );
    }

}
