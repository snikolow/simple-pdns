<?php

namespace Devzone\Action\Dashboard;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

/**
 * Class IndexAction
 * @package Devzone\Action\Dashboard
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
     * @Route("/", name="action.dashboard.index")
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function __invoke(Request $request): Response
    {
        return new Response($this->twig->render('dashboard/index.html.twig'));
    }

}
