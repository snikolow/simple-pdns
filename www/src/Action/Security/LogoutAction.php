<?php

namespace Devzone\Action\Security;

use Symfony\Component\Routing\Annotation\Route;

/**
 * Class LogoutAction
 * @package Devzone\Action\Security
 */
class LogoutAction
{

    /**
     * @Route("/logout", name="action.security.logout")
     */
    public function __invoke()
    {
        // ...
    }

}
