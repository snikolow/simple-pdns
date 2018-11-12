<?php

namespace Devzone\Action\Record;

use Devzone\Action\BaseUpdateAction;
use Devzone\Entity\Domain;
use Devzone\Entity\Record;
use Devzone\Form\RecordType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class UpdateAction
 * @package Devzone\Action\Record
 */
class UpdateAction extends BaseUpdateAction
{

    /**
     * @Route(
     *     "/domain/{domain}/records/update/{id}",
     *     requirements={"id": "([__ID__])|([0-9]+)", "domain": "([__DOMAIN_ID__])|([0-9]+)"},
     *     name="action.record.update"
     * )
     *
     * @param Request $request
     * @param Domain $domain
     * @param Record $entity
     *
     * @return Response
     */
    public function __invoke(Request $request, Domain $domain, Record $entity): Response
    {
        $form = $this->getFormFactory()->create(RecordType::class, $entity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getEntityManager()->persist($entity);
            $this->getEntityManager()->flush();

            return new RedirectResponse(
                $this->getRouter()->generate('action.record.index', [
                    'domain' => $domain->getId(),
                ])
            );
        }

        return new Response(
            $this->getTwig()->render('record/form.html.twig', [
                'form' => $form->createView(),
            ])
        );
    }

}
