<?php

namespace App\Services;

use App\Repositories\RestaurantRepository;

class RestaurantService
{
    protected $repository;

    /**
     * RestaurantService constructor.
     * @param RestaurantRepository $repository
     */
    public function __construct(RestaurantRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function exists(int $id): bool
    {
        return $this->repository->exists($id);
    }

    /**
     * @return mixed
     */
    public function fetchAll()
    {
        return $this->repository->getAll()->toArray();
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function insert(array $data)
    {
        return $this->repository->insert($data);
    }
}
