<?php
/**
 * File
 *
 * @author Sokolov Innokenty, <sokolov.innokenty@gmail.com>
 * @copyright Copyright (c) 2011, qbbr
 */
class Q_Cache_Adapter_File extends Q_Cache_Adapter_Abstract
{
    const EXTENSION = '.cache';
    const SEPARATOR = '_';

    protected $_cacheDir;

    /**
     * @param string $file Путь до файла
     * @throws Q_Logger_Exception
     */
    public function __construct($cacheDir)
    {
        if (!is_dir($cacheDir)) {
            if (!mkdir($cacheDir, 0777)) {
                throw new Q_Cache_Adapter_Exception("Dir ({$cacheDir}) not found");
            }
        }

        if (!is_writable($this->_cacheDir)) {
            throw new Q_Cache_Adapter_Exception("Dir ({$this->_cacheDir}) is not writable");
        }

        $this->_cacheDir = $cacheDir;
    }

    public function get($key, $defaultValue = null)
    {
        $filePath = $this->getFilePath($key);

        if (!file_exists($filePath)) {
            return $defaultValue;
        }
    }

    public function has($key)
    {
        return file_exists($this->getFilePath($key));
    }

    public function remove($key)
    {
        return unlink($this->getFilePath($key));
    }

    public function set($key, $value, $lifetime = null)
    {
    }

    public function flush()
    {
        return $this->recursiveRemove($this->_cacheDir());
    }

    protected function getFilePath($key)
    {
        return $this->_cacheDir . DS . str_replace(self::SEPARATOR, DS, $key) . self::EXTENSION;
    }

    protected function recursiveRemove($dir)
    {
        $result = true;

        foreach (glob($dir . DS . '*') as $file) {
            if (is_dir($file)) {
                $result = $this->recursiveRemove();
                $result = rmdir($file) && $result;
            } else {
                $result = unlink($file) && $result;
            }
        }

        return $result;
    }
}
