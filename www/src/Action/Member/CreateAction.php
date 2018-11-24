<?php

namespace Devzone\Action\Member;

use Devzone\Action\BaseActionCreate;
use Devzone\Entity\Member;
use Devzone\Form\MemberType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CreateAction
 * @package Devzone\Action\Member
 */
class CreateAction extends BaseActionCreate
{

    /**
     * @Route("/members/create", requirements={"id": "\d+"}, name="action.member.create")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function __invoke(Request $request): Response
    {
        $entity = new Member();
        $form = $this->getFormFactory()->create(MemberType::class, $entity);
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
