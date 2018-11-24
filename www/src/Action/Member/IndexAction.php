<?php

namespace Devzone\Action\Member;

use Devzone\Action\BaseIndexAction;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class IndexAction
 * @package Devzone\Action\Member
 */
class IndexAction extends BaseIndexAction
{

    /**
     * @Route("/members", name="action.member.index")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function __invoke(Request $request): Response
    {
        return new Response(
            $this->getTwig()->render('member/index.html.twig', [

            ])
        );
    }

}
