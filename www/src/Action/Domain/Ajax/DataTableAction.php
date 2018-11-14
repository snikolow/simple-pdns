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
     * @var DomainDataTable
     */
    private $dataTable;

    /**
     * DataTableAction constructor.
     * @param DomainDataTable $dataTable
     */
    public function __construct(DomainDataTable $dataTable)
    {
        $this->dataTable = $dataTable;
    }

    /**
     * @Route("/domains/xhr/data-table", name="action.domain.xhr.data_table")
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
