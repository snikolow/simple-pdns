<?php

namespace Devzone\Action\Domain\Ajax;

use Devzone\Service\DataTable\DomainDataTable;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DataTableAction
 * @package Devzone\Action\Domain\Ajax
 */
class DataTableAction
{

    /**
     * @Route("/domain/xhr/data-table", name="action.domain.xhr.data_table")
     *
     * @param Request $request
     * @param DomainDataTable $dataTable
     *
     * @return Response
     */
    public function __invoke(Request $request, DomainDataTable $dataTable): Response
    {
        if (!$request->isXmlHttpRequest()) {
            return new JsonResponse(['success' => false, 'message' => 'Unsupported method!'], Response::HTTP_METHOD_NOT_ALLOWED);
        }

        $dataTable->setRequest($request);

        $count = $dataTable->countAll();
        $result = $dataTable->findAll();

        return new JsonResponse([
            'success' => true,
            'draw' => $request->get('draw'),
            'recordsFiltered' => $count,
            'recordsTotal' => $count,
            'data' => $result
        ]);
    }

}
