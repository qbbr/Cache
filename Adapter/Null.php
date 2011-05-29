<?php
/**
 * Null
 *
 * @package Q_Cache
 * @author Sokolov Innokenty, <sokolov.innokenty@gmail.com>
 * @license http://opensource.org/licenses/MIT MIT License
 * @copyright Copyright (c) 2011, qbbr
 */
class Q_Cache_Adapter_Null extends Q_Cache_Adapter_Abstract
{
    public function get($key, $defaultValue = null)
    {
        return (null !== $defaultValue) ? $defaultValue : null;
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

    public function flush()
    {
        return true;
    }
}