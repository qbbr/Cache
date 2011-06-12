<?php
/**
 * WinCache
 *
 * @package Q_Cache
 * @author Sokolov Innokenty, <sokolov.innokenty@gmail.com>
 * @license http://opensource.org/licenses/MIT MIT License
 * @copyright Copyright (c) 2011, qbbr
 */
class Q_Cache_Adapter_WinCache extends Q_Cache_Adapter_Abstract
{
    /**
     * @throws Q_Cache_Adapter_Exception
     */
    public function __construct()
    {
        if (!extension_loaded('wincache')) {
            throw new Q_Cache_Adapter_Exception('WinCache is not installed');
        }
    }

    public function flush()
    {
        return wincache_ucache_clear();
    }

    public function get($key, $defaultValue = null)
    {
        $value = wincache_ucache_get($this->getKey($key), $success);

        if ($success) return $value;
        else return $defaultValue;
    }

    public function has($key)
    {
        return wincache_ucache_exists($this->getKey($key));
    }

    public function remove($key)
    {
        return wincache_ucache_delete($this->getKey($key));
    }

    public function set($key, $value, $lifetime = null)
    {
        $result = wincache_ucache_add($this->getKey($key), $value, $this->getLifetime($lifetime));
    }
}
