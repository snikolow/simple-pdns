<?php

namespace Devzone\Action\Member\Ajax;

use Devzone\Service\DataTable\MemberDataTable;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DataTableAction
 * @package Devzone\Action\Member\Ajax
 */
class DataTableAction
{

    /**
     * @var MemberDataTable
     */
    private $dataTable;

    /**
     * DataTableAction constructor.
     * @param MemberDataTable $dataTable
     */
    public function __construct(MemberDataTable $dataTable)
    {
        $this->dataTable = $dataTable;
    }

    /**
     * @Route("/members/xhr/data-table", name="action.member.xhr.data_table")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function __invoke(Request $request): Response
    {
        if (!$request->isXmlHttpRequest()) {
            return new JsonResponse(['success' => false, 'message' => 'Unsupported method!'], Response::HTTP_METHOD_NOT_ALLOWED);
        }

        $this->dataTable->setRequest($request);

        $count = $this->dataTable->countAll();
        $result = $this->dataTable->findAll();

        return new JsonResponse([
            'success' => true,
            'draw' => $request->get('draw'),
            'recordsFiltered' => $count,
            'recordsTotal' => $count,
            'data' => $result
        ]);
    }

}
