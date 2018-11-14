<?php

namespace Devzone\Action\Record\Ajax;

use Devzone\Entity\Domain;
use Devzone\Service\DataTable\RecordDataTable;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DataTableAction
 * @package Devzone\Action\Record\Ajax
 */
class DataTableAction
{

    /**
     * @var RecordDataTable
     */
    private $dataTable;

    /**
     * DataTableAction constructor.
     * @param RecordDataTable $dataTable
     */
    public function __construct(RecordDataTable $dataTable)
    {
        $this->dataTable = $dataTable;
    }

    /**
     * @Route("/records/{domain}/xhr/data-table", name="action.record.xhr.data_table")
     *
     * @param Request $request
     * @param Domain $domain
     *
     * @return Response
     */
    public function __invoke(Request $request, Domain $domain): Response
    {
        if (!$request->isXmlHttpRequest()) {
            return new JsonResponse(['success' => false, 'message' => 'Unsupported method!'], Response::HTTP_METHOD_NOT_ALLOWED);
        }

        $this->dataTable
            ->setDomain($domain)
            ->setRequest($request);

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
