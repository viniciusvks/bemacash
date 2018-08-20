<?php

namespace App\Helpers\Schema;

use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

/**
 * Class SuccessSchema
 * @package App\Helpers\Schema
 */
class SuccessSchema extends JsonSchema
{
    private $results;
    private $resultsInfo;
    private $pagigation;

    const RESULT_WITH_PAGINATION = true;
    const RESULT_WITHOUT_PAGINATION = false;

    /**
     * SuccessSchema constructor.
     * @param bool $pagination
     */
    public function __construct(bool $pagination = self::RESULT_WITHOUT_PAGINATION)
    {
        parent::__construct();

        $this->message = "";
        $this->results = [];
        $this->resultsInfo = [];
        $this->statusCode = Response::HTTP_OK;
        $this->pagigation = $pagination;
    }

    /**
     * @return null|string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return array
     */
    public function getResults(): array
    {
        return $this->results;
    }

    /**
     * @param array $results
     */
    public function setResults(array $results = [])
    {
        $this->results = $results;
    }

    /**
     * @return array
     */
    public function getResultsInfo(): array
    {
        return $this->resultsInfo;
    }

    /**
     * @param array $resultsInfo
     */
    public function setResultsInfo(array $resultsInfo)
    {
        $this->resultsInfo = $resultsInfo;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        $schema = [];
        $schema['success'] = true;
        $schema['message'] = $this->message;
        $schema['messageCode'] = $this->messageCode;
        $schema['statusCode'] = $this->statusCode;
        $schema['results'] = $this->results;

        if ($this->pagigation) {
            $schema['resultsInfo'] = $this->resultsInfo;
        }

        return $schema;
    }

    /**
     * @param LengthAwarePaginator $paginator
     * @return SuccessSchema
     */
    public static function createSchemaByPagination(LengthAwarePaginator $paginator)
    {

        $schema = new self(self::RESULT_WITH_PAGINATION);
        $schema->setResults(
            $paginator->items()
        );

        $schema->setResultsInfo([
            'currentPage' => $paginator->currentPage(),
            'from' => $paginator->firstItem(),
            'lastPage' => $paginator->lastPage(),
            'nextPageUrl' => $paginator->nextPageUrl(),
            'perPage' => $paginator->perPage(),
            'prevPageUrl' => $paginator->previousPageUrl(),
            'to' => $paginator->lastItem(),
            'total' => $paginator->total(),
        ]);

        return $schema;
    }
}
