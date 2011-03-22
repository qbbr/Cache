<?php
/**
 * Apc
 *
 * @author Sokolov Innokenty, <sokolov.innokenty@gmail.com>
 * @copyright Copyright (c) 2011, qbbr
 */
class Q_Cache_Adapter_APC extends Q_Cache_Adapter_Abstract
{
    /**
     * @throws Q_Cache_Exception
     */
    public function __construct()
    {
        if (!function_exists('apc_store') || !ini_get('apc.enabled')) {
            throw new Q_Cache_Exception('APC is not installed or is not enabled');
        }
    }

    public function get($key, $defaultValue = null)
    {
        $value = apc_fetch($key, $success);

        return ($success) ? $value : $defaultValue;
    }

    public function has($key)
    {
        apc_fetch($key, $success);

        return $success;
    }

    public function remove($key)
    {
        return apc_delete($key);
    }

    public function set($key, $value, $lifetime = null)
    {
        return apc_store($key, $value, $lifetime);
    }

    public function flush()
    {
        return apc_clear_cache('user');
    }
}