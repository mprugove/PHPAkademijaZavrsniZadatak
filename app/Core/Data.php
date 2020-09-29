<?php


namespace App\Core;


class Data
{
    protected $data = [];

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    public function __get($key)
    {
        return $this->data[$key] ?? null;
    }

    public function __set($key, $value)
    {
        $this->data[$key] = $value;
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

    public function getData(string $key = null): array
    {
        if ($key !== null) {
            return $this->__get($key);
        }
        return $this->data;
    }

    /**
     * The $key parameter can be string or array.
     * If $key is string, the attribute value will be overwritten by $value.
     * If $key is an array, it will overwrite all the data in the object.
     */
    public function setData($key, $value = null)
    {
        if ($key === (array)$key) {
            $this->data = $key;
        } else {
            $this->data[$key] = $value;
        }

        return $this;
    }

    public function __call($name, $arguments)
    {
        $key = $this->underscore(substr($name, 3));

        switch (substr($name, 0, 3)) {
            case 'get':
                return $this->__get($key);
            case 'set':
                $value = $arguments[0] ?? null;
                return $this->__set($key, $value);
            case 'uns':
                return $this->__unset($key);
            case 'has':
                return $this->__isset($key);
        }

        return $this;
    }

    /**
     * $this->setMyField($value) === $this->setData('my_field', $value)
     *
     * @param string $name
     * @return string
     */
    protected function underscore(string $name): string
    {
        return strtolower(trim(preg_replace('/([A-Z]|[0-9]+)/', "_$1", $name), '_'));
    }
}
