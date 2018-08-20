<?php

namespace App\Http\Controllers;

use App\Helpers\Schema\FailSchema;
use App\Helpers\Schema\SuccessSchema;
use App\Http\Requests\DataListingRequest;
use App\Models\Order;
use App\Models\OrderSummary;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Http\Response;

/**
 * Class OrderController
 * @package App\Http\Controllers
 */
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param DataListingRequest $request
     * @return \Illuminate\Http\Response
     * @throws \App\Exceptions\RepositoryException
     */
    public function index(DataListingRequest $request)
    {
        $schema = null;
        $list = $request->listData(OrderSummary::class);

        try {
            $schema =  SuccessSchema::createSchemaByPagination($list);
            $schema->setMessage(\Lang::get('messages.order.list'));
            $schema->setMessageCode(\Lang::get('codes.order.list'));
        } catch (\Exception $e) {
            $schema = new FailSchema($e);
            $schema->setMessage(\Lang::get('messages.error.unexpected'));
            $schema->setMessageCode(\Lang::get('codes.error.unexpected'));
            $schema->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()
            ->json($schema, Response::HTTP_OK);
    }

    public function show(Request $request)
    {
        $schema = null;
        $orderId = $request->route('id');

        $order = Order::findOrFail($orderId);

        try {
            $schema =  new SuccessSchema();
            $schema->setResults($order->toArray());
            $schema->setMessage(\Lang::get('messages.order.show'));
            $schema->setMessageCode(\Lang::get('codes.order.show'));
        } catch (ModelNotFoundException $e) {
            $schema = new FailSchema($e);
            $schema->setMessage(\Lang::get('messages.order.not_found'));
            $schema->setMessageCode(\Lang::get('codes.order.not_found'));
            $schema->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        } catch (\Exception $e) {
            $schema = new FailSchema($e);
            $schema->setMessage(\Lang::get('messages.error.unexpected'));
            $schema->setMessageCode(\Lang::get('codes.error.unexpected'));
            $schema->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()
            ->json($schema, Response::HTTP_OK);
    }
}
