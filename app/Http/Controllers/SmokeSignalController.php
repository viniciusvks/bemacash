<?php

namespace App\Http\Controllers;

use App\Helpers\Schema\SuccessSchema;
use Illuminate\Routing\Controller;

/**
 * Class SmokeSignalController
 * @package App\Http\Controllers
 */
class SmokeSignalController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function send()
    {
        $schema = new SuccessSchema();
        $schema->setMessage('API Is Working!!!');
        $schema->setMessageCode('api_working');

        return response()
            ->json($schema);
    }
}
