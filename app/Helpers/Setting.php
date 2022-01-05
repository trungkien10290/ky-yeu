<?php

namespace App\Helpers;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class Setting
{
    const FILE_SETTING = 'app.json';
    private $data;
    private static $instance;


    public static function ins()
    {
        if (!self::$instance) {
            self::$instance = new static();
        }
        return self::$instance;
    }

    public function validate()
    {
        if (!Storage::disk('local')->exists(self::FILE_SETTING)) {
            $this->save('');
        }
        return $this;
    }

    protected function getData()
    {
        $data = Storage::disk('local')->get(self::FILE_SETTING);
        return !empty($data) ? json_decode($data, true) : [];
    }

    public function data()
    {
        if (!$this->data) {
            $this->data = $this->validate()->getData();
        }
        return $this->data;
    }

    public function get($key, $default = null)
    {
        return Arr::get($this->data(), $key) ?? $default;
    }

    public function trans($key, $default = null)
    {
        return Arr::get($this->data(), $key . '_' . get_lang()) ?? $default;
    }

    public function save($data)
    {
        Storage::disk('local')->put(self::FILE_SETTING, json_encode($data));
    }
}
