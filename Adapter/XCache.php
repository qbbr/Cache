<?php
/**
 * XCache
 *
 * @package Q_Cache
 * @author Sokolov Innokenty, <sokolov.innokenty@gmail.com>
 * @license http://opensource.org/licenses/MIT MIT License
 * @copyright Copyright (c) 2011, qbbr
 */
class Q_Cache_Adapter_XCache extends Q_Cache_Adapter_Abstract
{
    /**
     * @throws Q_Cache_Adapter_Exception
     */
    public function __construct()
    {
        if (!function_exists('xcache_set')) {
            throw new Q_Cache_Adapter_Exception('XCache is not installed');
        }
    }

    public function get($key, $defaultValue = null)
    {
        $value = xcache_get($this->getKey($key));

        return (false === $value) ? $defaultValue : $value;
    }

    public function has($key)
    {
        return xcache_isset($this->getKey($key));
    }

    public function remove($key)
    {
        return xcache_unset($this->getKey($key));
    }

    public function set($key, $value, $lifetime = null)
    {
        return xcache_set($this->getKey($key), $value, $this->getLifetime($lifetime));
    }

    public function flush()
    {
        for ($i = 0, $max = xcache_count(XC_TYPE_VAR); $i < $max; $i++) {
            xcache_clear_cache(XC_TYPE_VAR, $i);
        }

        return true;
    }
}