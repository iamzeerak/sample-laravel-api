<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    protected $model;

    /**
     * BaseRepository constructor.
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function exists(int $id): bool
    {
        return (bool)$this->model->find($id);
    }

    /**
     * @param bool $paginate
     * @param array $filters
     * @param string $orderBy
     * @param int $limit
     * @return mixed
     */
    public function getAll(bool $paginate = false, array $filters = [], string $orderBy = 'asc', int $limit = 0)
    {
        if (isset($filters)) {
            $this->model = $this->model->where($filters);
        }
        if ($limit) {
            $this->model = $this->model->limit($limit);
        }
        $this->model = $this->model->orderBy('created_at', $orderBy);
        return $paginate ? $this->model->paginate(15) : $this->model->get();
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function insert(array $data)
    {
        return $this->model->create($data);
    }

}
