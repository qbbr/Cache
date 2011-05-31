<?php
/**
 * Cache
 *
 * @package Q_Cache
 * @author Sokolov Innokenty, <sokolov.innokenty@gmail.com>
 * @license http://opensource.org/licenses/MIT MIT License
 * @copyright Copyright (c) 2011, qbbr
 */
class Q_Cache
{
    /**
     * @var Q_Cache_Adapter_Abstract
     */
    protected $_adapter = null;

    /**
     * @var array
     */
    protected $_options = array(
        'lifetime' => 4320,
        'prefix' => 'Q_Cache'
    );

    /**
     * @param Q_Cache_Adapter_Abstract $adapter
     * @param array $options
     */
    public function __construct(Q_Cache_Adapter_Abstract $adapter, array $options = array())
    {
        $this->_adapter = $adapter;
        $this->_adapter->setOptions(array_merge($this->_options, $options));
    }

    /**
     * Save value in cache
     *
     * @param string $key Cache key
     * @param mixed $value Data to put
     * @param integer $lifetime Cache lifetime
     */
    public function set($key, $value, $lifetime = null)
    {
        return $this->_adapter->set($key, $value, $lifetime);
    }

    /**
     * Get cache value
     *
     * @param string $key Cache key
     * @param mixed $defaultValue Default value
     * @return mixed
     */
    public function get($key, $defaultValue = null)
    {
        return $this->_adapter->get($key, $defaultValue);
    }

    /**
     * Check for the existence of the cache
     *
     * @param string $key Cache key
     * @return boolean
     */
    public function has($key)
    {
        return $this->_adapter->has($key);
    }

    /**
     * Remove a content from cache
     *
     * @param string $key Cache key
     * @return boolean
     */
    public function remove($key)
    {
        return $this->_adapter->remove($key);
    }

    /**
     * Flush cache
     *
     * @return boolean
     */
    public function flush()
    {
        return $this->_adapter->flush();
    }

    public function setOption($key, $value)
    {
        $this->_adapter->setOption($key, $value);
    }

    public function setOptions(array $options)
    {
        $this->_adapter->setOptions($options);
    }
}
