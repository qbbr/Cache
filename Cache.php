<?php
/**
 * Cache
 *
 * @author Sokolov Innokenty, <sokolov.innokenty@gmail.com>
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
        'lifetime' => 4320
    );

    public function __construct(Q_Cache_Adapter_Abstract $adapter, array $options)
    {
        $this->_adapter = $adapter;
        $this->setOptions($options);
    }

    /**
     * Назначить
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
     * Получить
     *
     * @param string $key Cache key
     * @param mixed $default Default data
     * @return mixed
     */
    public function get($key, $default = null)
    {
        return $this->_adapter->get($key, $defaultValue);
    }

    /**
     * Проверить на существование
     *
     * @param string $key Cache key
     * @return boolean
     */
    public function has($key)
    {
        return $this->_adapter->has($key);
    }

    /**
     * Удалить
     *
     * @param string $key Cache key
     * @return boolean
     */
    public function remove($key)
    {
        return $this->_adapter->remove($key);
    }

    /**
     * Очистить кэш
     *
     * @return boolean
     */
    public function flush() {
        return $this->_adapter->flush();
    }

    public function setOption($key, $value)
    {
        $this->_options[$key] = $value;
    }

    public function setOptions(array $options)
    {
        foreach ($options as $key => $value) {
            $this->setOption($key, $value);
        }
    }
}