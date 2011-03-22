<?php
/**
 * File
 *
 * @author Sokolov Innokenty, <sokolov.innokenty@gmail.com>
 * @copyright Copyright (c) 2011, qbbr
 */
class Q_Cache_Adapter_File extends Q_Cache_Adapter_Abstract
{
    protected $_file;
    
    /**
     * @param string $file Путь до файла
     * @throws Q_Logger_Exception
     */
    public function __construct($file)
    {
        if (!is_file($file)) {
            if (@!touch($file)) {
                throw new Q_Cache_Adapter_Exception("File ({$file}) not found");
            }
        }

        if (!is_writable($file)) {
            throw new Q_Cache_Adapter_Exception("File ({$file}) is not writable");
        }
    }

    public function get($key, $defaultValue = null)
    {
    }

    public function has($key)
    {
    }

    public function remove($key)
    {
    }

    public function set($key, $value, $lifetime = null)
    {
    }

    public function flush()
    {
    }
}