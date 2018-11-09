<?php

namespace Devzone\Action\Domain;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

/**
 * Class IndexAction
 * @package Devzone\Action\Domain
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
     * @Route("/domain", name="action.domain.index")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function __invoke(Request $request): Response
    {
        return new Response(
            $this->twig->render('domain/index.html.twig', [])
        );
    }

}
