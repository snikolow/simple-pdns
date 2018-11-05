<?php

namespace Devzone\Action\Domain;

use Devzone\Action\Contract\ActionInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

/**
 * Class IndexAction
 * @package Devzone\Action\Domain
 */
class IndexAction implements ActionInterface
{

    /**
     * @var \Twig\Environment
     */
    private $twig;

    /**
     * IndexAction constructor.
     * @param \Twig\Environment $twig
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
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function __invoke(Request $request): Response
    {
        return new Response(
            $this->twig->render('domain/index.html.twig', [])
        );
    }

}
