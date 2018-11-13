<?php

namespace Devzone\Action\Security;

use Symfony\Component\Routing\Annotation\Route;

/**
 * Class LoginCheckAction
 * @package Devzone\Action\Security
 */
class LoginCheckAction
{

    /**
     * @Route("/login-check", name="action.security.login_check")
     */
    public function __invoke()
    {
        // ...
    }

}
