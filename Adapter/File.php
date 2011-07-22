<?php
/**
 * File
 *
 * @package Q_Cache
 * @author Sokolov Innokenty, <sokolov.innokenty@gmail.com>
 * @license http://opensource.org/licenses/MIT MIT License
 * @copyright Copyright (c) 2011, qbbr
 */
class Q_Cache_Adapter_File extends Q_Cache_Adapter_Abstract
{
    const EXTENSION = '.cache';
    const SEPARATOR = '_';

    protected $_cacheDir;

    /**
     * @param string $cacheDir Directory to storage cache file
     * @throws Q_Cache_Adapter_Exception
     */
    public function __construct($cacheDir)
    {
        if (!is_dir($cacheDir)) {
            if (!mkdir($cacheDir, 0777)) {
                throw new Q_Cache_Adapter_Exception("Dir ({$cacheDir}) not found");
            }
        }

        if (!is_writable($cacheDir)) {
            if (!@chmod($cacheDir, 0777)) {
                throw new Q_Cache_Adapter_Exception("Dir ({$cacheDir}) is not writable");
            }
        }

        $this->_cacheDir = $cacheDir;
    }

    public function get($key, $defaultValue = null)
    {
        $filePath = $this->getFilePath($key);

        if (!file_exists($filePath)) {
            return $defaultValue;
        }

        $fp = fopen($filePath, 'r');

        $firstLine = fgets($fp, 12);

        return (intval($firstLine) > time()) ? stream_get_contents($fp, -1, strlen($firstLine)) : $defaultValue;
    }

    public function has($key)
    {
        return file_exists($this->getFilePath($key));
    }

    public function remove($key)
    {
        $filePath = $this->getFilePath($key);

        if (file_exists($filePath)) {
            return unlink($this->getFilePath($key));
        }

        return true;
    }

    public function set($key, $value, $lifetime = null)
    {
        $filePath = $this->getFilePath($key);

        if (!is_dir(dirname($filePath))) {
            mkdir(dirname($filePath), 0777, true);
        }

        $content = time() + $this->getLifetime($lifetime)
                 . PHP_EOL
                 . $value;

        file_put_contents($filePath, $content);

        @chmod($filePath, 0666);

        return true;
    }

    public function flush()
    {
        return $this->recursiveRemove($this->_cacheDir);
    }

    /**
     * Convert key to file path
     *
     * @param string $key
     * @return string
     */
    protected function getFilePath($key)
    {
        return $this->_cacheDir . DIRECTORY_SEPARATOR . str_replace(self::SEPARATOR, DIRECTORY_SEPARATOR, $key) . self::EXTENSION;
    }

    /**
     * Recursive remove directory content
     *
     * @param string $dir
     * @return boolean
     */
    protected function recursiveRemove($dir)
    {
        $result = true;

        foreach (glob($dir . DIRECTORY_SEPARATOR . '*') as $file) {
            if (is_dir($file)) {
                $result = $this->recursiveRemove($file);
                $result = rmdir($file) && $result;
            } else {
                $result = unlink($file) && $result;
            }
        }

        return $result;
    }
}