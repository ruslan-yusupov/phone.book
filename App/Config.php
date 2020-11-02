<?php

namespace App;

class Config
{

    public array $data;
    protected static $instance;

    /**
     * Config constructor.
     */
    protected function __construct()
    {
        $envData = file(__DIR__ . '/../.env', FILE_IGNORE_NEW_LINES);
        $configData = [];
        array_walk($envData, function ($value) use (&$configData) {
            if (!empty($value)) {
                $data = explode('=', $value);
                $configData[$data[0]] = $data[1];
            }
        });

        $this->data = $configData;

    }


    /**
     * @return static
     */
    public static function getInstance(): self
    {

        if (null !== static::$instance) {

            return static::$instance;

        }

        static::$instance = new static;

        return static::$instance;

    }

}