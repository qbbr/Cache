<?php
/**
 * Abstract
 *
 * @package Q_Cache
 * @author Sokolov Innokenty, <sokolov.innokenty@gmail.com>
 * @license http://opensource.org/licenses/MIT MIT License
 * @copyright Copyright (c) 2011, qbbr
 */
abstract class Q_Cache_Adapter_Abstract
{
    public $_options = array();
    
    public function getLifetime($lifetime)
    {
        return (null === $lifetime)
             ? (isset($this->_options['lifetime'])) ? $this->_options['lifetime'] : null
             : $lifetime;
    }

    abstract public function set($key, $value, $lifetime = null);

    abstract public function get($key, $defaultValue = null);

    abstract public function has($key);

    abstract public function remove($key);

    abstract public function flush();
    
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