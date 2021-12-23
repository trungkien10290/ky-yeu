<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class Select2
{
    const DEFAULT_FIELD = ['id' => 'id', 'text' => 'title_vi'];

    private $model;
    private $field;

    public function __construct($model, array $field = self::DEFAULT_FIELD)
    {
        $this->model = is_string($model) ? new $model : $model;
        $this->field = $field;
    }

    public function show($id)
    {
        $result = [];
        if (!empty($id)) {
            $row = $this->model->find($id);
            if ($row) {
                $result = [$row->{$this->field['id']}, $row->{$this->field['text']}];
            }
        }
        return $result;
    }

    public function ajax()
    {
        $params = request('params');
        $params = !empty($params) ? json_decode($params, true) : [];
        $baseName = Str::lower(class_basename($this->model));
        $query = $this->model;
        if (!empty(request('q'))) {
            $query->where($this->field['text'], "like", "%" . request('q') . "%");
        }
        if (!empty($params[$baseName])) {
            $query->where($this->field['id'], '!=', $params[$baseName]);
        }
        return $query->paginate(null, [$this->field['id'], "{$this->field['text']} as text"]);
    }
}
