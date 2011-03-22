<?php
/**
 * eAccelerator
 *
 * @author Sokolov Innokenty, <sokolov.innokenty@gmail.com>
 * @copyright Copyright (c) 2011, qbbr
 */
class Q_Cache_Adapter_eAccelerator extends Q_Cache_Adapter_Abstract
{
    public function __construct()
    {
        if (!function_exists('eaccelerator_put') || !ini_get('eaccelerator.enable'))
        {
            throw new Q_Cache_Exception('eAccelerator is not installed or is not enabled');
        }
    }

    public function get($key, $defaultValue = null)
    {
        $value = eaccelerator_get($key);

        return (false === $value) ? $defaultValue : $value;
    }

    public function has($key)
    {
        return (boolean) eaccelerator_get($key);
    }

    public function remove($key)
    {
        return eaccelerator_rm($key);
    }

    public function set($key, $value, $lifetime = null)
    {
        return eaccelerator_put($key, $value, $lifetime);
    }

    public function flush()
    {
        eaccelerator_purge();

        return true;
    }
}