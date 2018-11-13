<?php

namespace Devzone\Action\Security;

use Devzone\Form\LoginType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Twig\Environment;

class LoginAction
{

    /**
     * @var Environment
     */
    private $twig;

    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var AuthenticationUtils
     */
    private $authenticationUtils;

    /**
     * @var AuthorizationCheckerInterface
     */
    private $authorizationChecker;

    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * LoginAction constructor.
     * @param Environment $twig
     * @param FormFactoryInterface $formFactory
     * @param AuthenticationUtils $authenticationUtils
     * @param AuthorizationCheckerInterface $authorizationChecker
     * @param RouterInterface $router
     */
    public function __construct(
        Environment $twig,
        FormFactoryInterface $formFactory,
        AuthenticationUtils $authenticationUtils,
        AuthorizationCheckerInterface $authorizationChecker,
        RouterInterface $router
    ) {
        $this->twig = $twig;
        $this->formFactory = $formFactory;
        $this->authenticationUtils = $authenticationUtils;
        $this->authorizationChecker = $authorizationChecker;
        $this->router = $router;
    }


    /**
     * @Route("/login", name="action.security.login")
     */
    public function __invoke(): Response
    {
        $form = $this->formFactory->create(LoginType::class);

        if ($this->authorizationChecker->isGranted('ROLE_USER')) {
            return new RedirectResponse(
                $this->router->generate('action.dashboard.index')
            );
        }

        return new Response(
            $this->twig->render('security/login.html.twig', [
                'form' => $form->createView(),
                'error' => $this->authenticationUtils->getLastAuthenticationError(),
            ])
        );
    }

}
