<?php

namespace Devzone\Action\Domain;

use Devzone\Action\BaseIndexAction;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class IndexAction
 * @package Devzone\Action\Domain
 */
class IndexAction extends BaseIndexAction
{

    /**
     * @Route("/domain", name="action.domain.index")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function __invoke(Request $request): Response
    {
        return new Response(
            $this->getTwig()->render('domain/index.html.twig', [])
        );
    }

}
