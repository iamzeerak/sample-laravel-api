<?php

namespace App\Services;

use App\Repositories\MenuRepository;
use Illuminate\Support\Arr;

class MenuService
{
    protected $repository;

    /**
     * MenuService constructor.
     * @param MenuRepository $repository
     */
    public function __construct(MenuRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $filters
     * @return mixed
     */
    public function fetchAll(array $filters = [])
    {
        return $this->repository->getAll(true, $filters)->toArray();
    }

    /**
     * @param array $data
     * @return bool|mixed
     */
    public function insert(array $data)
    {
        try {
            //check and assign category using previous value if not available in payload
            if (!Arr::get($data, 'category')) {
                $menuItem = $this->repository->getAll(false, ['restaurant_id' => Arr::get($data, 'restaurant_id')], 'desc', 1)->first();
                if (!isset($menuItem)) {
                    return false;
                }
                $data['category'] = $menuItem['category'];
            }
            $res = $this->repository->insert($data);
        } catch (\Exception $exception) {
            $res = false;
        }
        return $res;
    }
}
