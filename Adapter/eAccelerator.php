<?php
/**
 * eAccelerator
 *
 * @package Q_Cache
 * @author Sokolov Innokenty, <sokolov.innokenty@gmail.com>
 * @license http://opensource.org/licenses/MIT MIT License
 * @copyright Copyright (c) 2011, qbbr
 */
class Q_Cache_Adapter_eAccelerator extends Q_Cache_Adapter_Abstract
{
    /**
     * @throws Q_Cache_Adapter_Exception
     */
    public function __construct()
    {
        if (!function_exists('eaccelerator_put') || !ini_get('eaccelerator.enable')) {
            throw new Q_Cache_Adapter_Exception('eAccelerator is not installed or is not enabled');
        }
    }

    public function get($key, $defaultValue = null)
    {
        $value = eaccelerator_get($this->getKey($key));

        return (false === $value) ? $defaultValue : $value;
    }

    public function has($key)
    {
        return (boolean) eaccelerator_get($this->getKey($key));
    }

    public function remove($key)
    {
        return eaccelerator_rm($this->getKey($key));
    }

    public function set($key, $value, $lifetime = null)
    {
        return eaccelerator_put($this->getKey($key), $value, $this->getLifetime($lifetime));
    }

    public function flush()
    {
        eaccelerator_purge();

        return true;
    }
}