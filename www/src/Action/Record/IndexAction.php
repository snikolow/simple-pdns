<?php

namespace Devzone\Action\Record;

use Devzone\Action\BaseIndexAction;
use Devzone\Entity\Domain;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class IndexAction
 * @package Devzone\Action\Record
 */
class IndexAction extends BaseIndexAction
{

    /**
     * @Route("/domain/{domain}/records", requirements={"domain": "([__ID__])|([0-9]+)"}, name="action.record.index")
     *
     * @param Request $request
     * @param Domain $domain
     *
     * @return Response
     */
    public function __invoke(Request $request, Domain $domain): Response
    {
        return new Response(
            $this->getTwig()->render('record/index.html.twig', [
                'domain' => $domain,
            ])
        );
    }

}
