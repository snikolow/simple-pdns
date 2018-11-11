<?php

namespace Devzone\Action\Record;

use Devzone\Entity\Domain;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

/**
 * Class IndexAction
 * @package Devzone\Action\Record
 */
class IndexAction
{

    /**
     * @var Environment
     */
    private $twig;

    /**
     * IndexAction constructor.
     * @param Environment $twig
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @Route("/record/{domain}", requirements={"domain": "([__ID__])|([0-9]+)"}, name="action.record.index")
     *
     * @param Request $request
     * @param Domain $domain
     *
     * @return Response
     */
    public function __invoke(Request $request, Domain $domain): Response
    {
        return new Response(
            $this->twig->render('record/index.html.twig', [])
        );
    }

}
