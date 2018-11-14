<?php

namespace Devzone\Action\Domain;

use Devzone\Action\BaseActionCreate;
use Devzone\Entity\Domain;
use Devzone\Form\DomainType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CreateAction
 * @package Devzone\Action\Domain
 */
class CreateAction extends BaseActionCreate
{

    /**
     * @Route("/domains/create/{type}", requirements={"type": "(master|slave|native)"}, name="action.domain.create")
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
