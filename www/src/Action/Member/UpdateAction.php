<?php

namespace Devzone\Action\Member;

use Devzone\Action\BaseUpdateAction;
use Devzone\Entity\Member;
use Devzone\Form\MemberType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class UpdateAction
 * @package Devzone\Action\Member
 */
class UpdateAction extends BaseUpdateAction
{

    /**
     * @Route(
     *     "/members/update/{id}",
     *     requirements={"id": "([__ID__])|([0-9]+)"},
     *     name="action.member.update"
     * )
     *
     * @param Request $request
     * @param Member $entity
     *
     * @return Response
     */
    public function __invoke(Request $request, Member $entity): Response
    {
        $form = $this->getFormFactory()->create(MemberType::class, $entity);
        $form->remove('username');
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getEntityManager()->persist($entity);
            $this->getEntityManager()->flush();

            return new RedirectResponse(
                $this->getRouter()->generate('action.member.index')
            );
        }

        return new Response(
            $this->getTwig()->render('member/form.html.twig', [
                'form' => $form->createView(),
            ])
        );
    }

}
