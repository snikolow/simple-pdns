<?php

namespace Devzone\Action\Security;

use Devzone\Action\BaseUpdateAction;
use Devzone\Form\ProfileType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class ProfileAction
 * @package Devzone\Action\Security
 */
class ProfileAction extends BaseUpdateAction
{

    /**
     * @Route("/profile-settings", name="action.security.profile")
     *
     * @param Request $request
     * @param UserInterface $currentMember
     *
     * @return Response
     */
    public function __invoke(Request $request, UserInterface $currentMember): Response
    {
        $form = $this->getFormFactory()->create(ProfileType::class, $currentMember);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getEntityManager()->persist($currentMember);
            $this->getEntityManager()->flush();

            return new RedirectResponse(
                $this->getRouter()->generate('action.security.profile')
            );
        }

        return new Response(
            $this->getTwig()->render('security/profile.html.twig', [
                'form' => $form->createView(),
            ])
        );
    }

}