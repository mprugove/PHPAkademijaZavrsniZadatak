<?php


namespace App\Core;


class Data
{
    protected $data = [];

    public function __construct(array $data = [])
    {
        $this->data=$data;
    }

    public function __get($key)
    {
        return $this->data[$key];
    }

    public function __set($key, $val)
    {
        $this->data[$key] = $val;
        return $this;
    }

    public function __isset($key)
    {
        return isset($this->data[$key]);
    }

    public function __unset($key)
    {
        unset($this->data[$key]);
        return $this;
    }

    public function underscore(string $name): string
    {
        return strtolower(trim(preg_replace('/([A-Z] | [0-9]+)/', "_$1", $name), '_'));
    }

    public function __call($name, $arguments)
    {
        $key = $this->underscore(substr($name));

        switch (substr($name, 0, 3)) {
            case 'get':
                return $this->__get($key);
            case 'set':
                return $value =$arguments[0] ?? null;
                return $this->__set($key, $value);
            case 'uns' :
                return $this->__unset($key);
            case 'has' :
                return $this->__isset($key);
        }
        return $this;
    }
}
