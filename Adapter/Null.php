<?php
/**
 * Null
 *
 * @author Sokolov Innokenty, <sokolov.innokenty@gmail.com>
 * @copyright Copyright (c) 2011, qbbr
 */
class Q_Cache_Adapter_Null extends Q_Cache_Adapter_Abstract
{
    public function get($key, $defaultValue)
    {
        return $defaultValue;
    }

    public function has($key)
    {
        return null;
    }

    public function remove($key)
    {
        return true;
    }

    public function set($key, $value, $lifetime = null)
    {
        return true;
    }
}