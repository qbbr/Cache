<?php
/**
 * Memchache
 *
 * @package Q_Cache
 * @author Sokolov Innokenty, <sokolov.innokenty@gmail.com>
 * @license http://opensource.org/licenses/MIT MIT License
 * @copyright Copyright (c) 2011, qbbr
 */
class Q_Cache_Adapter_Memchache extends Q_Cache_Adapter_Abstract
{
    protected $_memchache;
    protected $_compress = 0;

    /**
     * @throws Q_Cache_Adapter_Exception
     */
    public function __construct($host = 'localhost', $port = 11211, $compress = false)
    {
        if (!class_exists('Memcache')) {
            throw new Q_Cache_Adapter_Exception('Memcache is not installed');
        }

        if (true === $compress) {
            $this->_compress = MEMCACHE_COMPRESSED;
        }

        $this->_memchache = new Memcache();
        $this->_memchache->addserver($host, $port);
    }

    public function get($key, $defaultValue = null)
    {
        $value = $this->_memchache->get($this->getKey($key));

        return (false === $value) ? $defaultValue : $value;
    }

    public function has($key)
    {
        return (boolean) $this->_memchache->get($this->getKey($key));
    }

    public function remove($key)
    {
        return $this->_memchache->delete($this->getKey($key));
    }

    public function set($key, $value, $lifetime = null)
    {
        return $this->_memchache->set($this->getKey($key), $value, $this->_compress, $this->getLifetime($lifetime));
    }

    public function flush()
    {
        return $this->_memchache->flush();
    }
}
