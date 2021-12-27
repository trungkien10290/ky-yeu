<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class Select2
{
    const DEFAULT_FIELD = ['id' => 'id', 'text' => 'title_vi'];

    private $model;
    private $field;
    private $select;

    public function __construct($model, array $field = self::DEFAULT_FIELD)
    {
        $this->model = is_string($model) ? new $model : $model;
        $this->field = $field;
        $this->select = [
            "{$this->field['id']} as id",
            "{$this->field['text']} as text",
        ];
    }

    public function show($id)
    {
        $result = [];
        if (!empty($id)) {
            $result = $this->model->select(array_values($this->field))->where('id', ($id))->get()->pluck($this->field['text'], $this->field['id']);
        }
        return $result;
    }

    public function ajax()
    {
        $params = request('params');
        $params = !empty($params) ? json_decode($params, true) : [];
        $baseName = Str::lower(class_basename($this->model));
        $query = $this->model->select($this->select);
        if (!empty(request('q'))) {
            $query->where($this->field['text'], "like", "%" . request('q') . "%");
        }
        if (!empty($params[$baseName])) {
            $query->where($this->field['id'], '!=', $params[$baseName]);
        }
        return $query->paginate(null);
    }
}
