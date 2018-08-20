<?php

namespace App\Repositories;

use App\Exceptions\RepositoryException;
use App\Http\Requests\DataListingRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class RepositoryInterface
 * @package App\Repositories
 */
abstract class Repository
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * Repository constructor.
     * @param string $class
     * @throws RepositoryException
     */
    public function __construct(string $class)
    {
        try {
            $this->model = (new $class());

            if (!$this->model instanceof Model) {
                throw new RepositoryException('Class must be a instance of Model');
            }
        } catch (\Exception $e) {
            throw new RepositoryException($e->getMessage());
        }
    }

    /**
     * @param string $class
     * @param DataListingRequest $request
     * @param \Closure|null $filter
     * @return LengthAwarePaginator
     * @throws RepositoryException
     */
    public static function listData(string $class, DataListingRequest $request, \Closure $filter = null) {

        $model = new $class;

        if (!$model instanceof Model) {
            throw new RepositoryException('Class must be a instance of Model');
        }

        $baseTable = $model->getTable();

        $data = $request->data();

        $page = $data['page'] ?? 1;

        $limit = $data['limit'] ?? 15;

        $listing = $model::addSelect("$baseTable.*");

        $listing = $listing->paginate(
            $limit,
            ['*'],
            'page',
            $page
        );

        return $listing;
    }
}
