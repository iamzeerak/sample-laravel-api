<?php

namespace App\Http\Controllers;

use App\Services\RestaurantService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    protected $service;

    /**
     * RestaurantController constructor.
     * @param RestaurantService $service
     */
    public function __construct(RestaurantService $service)
    {
        $this->service = $service;
    }

    /**
     * @return JsonResponse
     */
    public function fetchAll(): JsonResponse
    {
        return response()->json([
            "code" => 200,
            "status" => "Success",
            "message" => "Data successfully fetched.",
            "data" => $this->service->fetchAll()
        ]);

    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function insert(Request $request): JsonResponse
    {
        $data = $this->service->insert($request->all());
        return response()->json([
            "code" => 200,
            "status" => "Success",
            "message" => "Data successfully saved",
            "data" => $data
        ]);
    }
}
