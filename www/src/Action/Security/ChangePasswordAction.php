<?php

namespace Devzone\Action\Security;

use Devzone\Action\BaseUpdateAction;
use Devzone\Form\ChangePasswordType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class ChangePasswordAction
 * @package Devzone\Action\Security
 */
class ChangePasswordAction extends BaseUpdateAction
{

    /**
     * @Route("/change-password", name="action.security.change_password")
     *
     * @param Request $request
     * @param UserInterface $currentUser
     *
     * @return Response
     */
    public function __invoke(Request $request, UserInterface $currentUser): Response
    {
        $form = $this->getFormFactory()->create(ChangePasswordType::class, $currentUser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getEntityManager()->persist($currentUser);
            $this->getEntityManager()->flush();

            return new RedirectResponse(
                $this->getRouter()->generate('action.security.change_password')
            );
        }

        return new Response(
            $this->getTwig()->render('security/change_password.html.twig', [
                'form' => $form->createView(),
            ])
        );
    }

}