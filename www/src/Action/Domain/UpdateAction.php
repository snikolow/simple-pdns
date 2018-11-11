<?php

namespace Devzone\Action\Domain;

use Devzone\Action\BaseUpdateAction;
use Devzone\Entity\Domain;
use Devzone\Form\DomainType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class UpdateAction
 * @package Devzone\Action\Domain
 */
class UpdateAction extends BaseUpdateAction
{

    /**
     * @Route("/domain/update/{id}", requirements={"id": "([__ID__])|([0-9]+)"}, name="action.domain.update")
     *
     * @param Request $request
     * @param Domain $entity
     *
     * @return Response
     */
    public function __invoke(Request $request, Domain $entity): Response
    {
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
