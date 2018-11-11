<?php

namespace Devzone\Action;

use Twig\Environment;

/**
 * Class BaseIndexAction
 * @package Devzone\Action
 */
abstract class BaseIndexAction
{

    /**
     * @var Environment
     */
    private $twig;

    /**
     * BaseIndexAction constructor.
     * @param Environment $twig
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @return Environment
     */
    public function getTwig(): Environment
    {
        return $this->twig;
    }

}
