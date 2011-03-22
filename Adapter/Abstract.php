<?php
/**
 * Abstract
 *
 * @author Sokolov Innokenty, <sokolov.innokenty@gmail.com>
 * @copyright Copyright (c) 2011, qbbr
 */
abstract class Q_Cache_Adapter_Abstract
{
    public function getLifetime($lifetime)
    {
        return (null === $lifetime) ? '' : $lifetime;
    }

    abstract public function set($key, $value, $lifetime = null);

    abstract public function get($key, $defaultValue = null);

    abstract public function has($key);

    abstract public function remove($key);

    abstract public function flush();
}