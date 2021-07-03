<?php

namespace App\Http\Controllers;

use App\Mappers\MenuSaveMapper;
use App\Services\MenuService;
use App\Services\RestaurantService;
use App\Transformers\MenuFetchAllTransformer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;

class MenuController extends Controller
{
    protected $service;
    protected $restaurantService;

    /**
     * MenuController constructor.
     * @param MenuService $service
     * @param RestaurantService $restaurantService
     */
    public function __construct(MenuService $service, RestaurantService $restaurantService)
    {
        $this->service = $service;
        $this->restaurantService = $restaurantService;
    }

    /**
     * @param int $restId
     * @return JsonResponse
     */
    public function fetchAll(int $restId): JsonResponse
    {
        if (!$this->restaurantService->exists($restId)) {
            return response()->json([
                    'code' => 400,
                    'status' => 'Bad Request',
                    'message' => 'Restaurant does not exist.']
                , 400);
        }

        $data = $this->service->fetchAll(['restaurant_id' => $restId]);
        return response()->json([
            'code' => 200,
            'status' => 'Success',
            'message' => 'Data successfully fetched.',
            'data' => MenuFetchAllTransformer::transform(Arr::get($data, 'data', [])),
            'links' => MenuFetchAllTransformer::transformLinks($data),
            'meta' => MenuFetchAllTransformer::transformMeta($data)
        ]);
    }

    /**
     * @param Request $request
     * @param int $restId
     * @return JsonResponse
     */
    public function insert(Request $request, int $restId): JsonResponse
    {
        // validate restaurant id
        if (!$this->restaurantService->exists($restId)) {
            return response()->json([
                    'code' => 400,
                    'status' => 'Bad Request',
                    'message' => 'Restaurant does not exist.']
                , 400);
        }

        // validate data
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
            ]
        );
        if ($validator->fails()) {
            return response()->json([
                'code' => 422,
                'status' => 'Validation Failed',
                'message' => 'The given data is invalid.',
                'validation_params_error' => $validator->errors()
            ], 422);
        }

        return response()->json([
            'status' => $this->service->insert(array_merge(MenuSaveMapper::map($request->all()), ['restaurant_id' => $restId])) ? 'success' : 'failed'
        ]);
    }
}
