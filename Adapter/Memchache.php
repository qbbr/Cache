<?php
/**
 * Memchache
 *
 * @author Sokolov Innokenty, <sokolov.innokenty@gmail.com>
 * @copyright Copyright (c) 2011, qbbr
 */
class Q_Cache_Adapter_Memchache extends Q_Cache_Adapter_Abstract
{
    protected $_memchache = null;
    protected $_compress = null;

    /**
     * @throws Q_Cache_Exception
     */
    public function __construct($host = 'localhost', $port = 11211)
    {
        if (!class_exists('Memcache')) {
            throw new Q_Cache_Exception('Memcache is not installed');
        }

        $this->_memchache = new Memcache();
        $this->_memchache->addserver('localhost', $port);
    }

    public function get($key, $defaultValue = null)
    {
        $value = $this->_memchache->get($key);

        return (false === $value) ? $defaultValue : $value;
    }

    public function has($key)
    {
        return (boolean) $this->_memchache->get($key);
    }

    public function remove($key)
    {
        return $this->_memchache->delete($key);
    }

    public function set($key, $value, $lifetime = null)
    {
        return $this->_memchache->set($key, $value, $this->_compress, $lifetime);
    }

    public function flush()
    {
        return $this->_memchache->flush();
    }
}