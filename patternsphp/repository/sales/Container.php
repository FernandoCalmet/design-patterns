<?php

namespace Sales;

class Container
{
    private static $dependencies = [];

    public static function set(string $key, $func)
    {
        self::$dependencies[$key] = $func;
    }

    public static function get(string $key)
    {
        return self::$dependencies[$key]();
    }
}
