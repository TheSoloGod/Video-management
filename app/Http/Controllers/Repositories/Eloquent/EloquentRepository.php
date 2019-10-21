<?php


namespace App\Http\Controllers\Repositories\Eloquent;


abstract class EloquentRepository implements RepositoryInterface
{
    protected $model;

    public function __construct()
    {
        $this->setModel();
    }

    abstract public function getModel();

    public function setModel()
    {
        $this->model = app()->make($this->getModel());
    }

    public function getAll()
    {
        $results = $this->model->all();
        return $results;
    }

    public function getById($id)
    {
        $result = $this->model->findOrFail($id);
        return $result;
    }

    public function paginate($number)
    {
        $results = $this->model->paginate($number);
        return $results;
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(array $data, $object)
    {
        return $object->update($data);
    }

    public function delete($object)
    {
        return $object->delete();
    }
}
