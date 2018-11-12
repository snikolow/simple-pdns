<?php

namespace Devzone\Action\Record;

use Devzone\Action\BaseActionCreate;
use Devzone\Entity\Domain;
use Devzone\Entity\Record;
use Devzone\Form\DomainType;
use Devzone\Form\RecordType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CreateAction
 * @package Devzone\Action\Record
 */
class CreateAction extends BaseActionCreate
{

    /**
     * @Route("/domain/{domain}/records/create", requirements={"id": "\d+"}, name="action.record.create")
     *
     * @param Request $request
     * @param Domain $domain
     *
     * @return Response
     */
    public function __invoke(Request $request, Domain $domain): Response
    {
        $entity = new Record();
        $entity->setDomain($domain);
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
