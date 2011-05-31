<?php
/**
 * SQLite
 *
 * @package Q_Cache
 * @author Sokolov Innokenty, <sokolov.innokenty@gmail.com>
 * @license http://opensource.org/licenses/MIT MIT License
 * @copyright Copyright (c) 2011, qbbr
 */
class Q_Cache_Adapter_SQLite extends Q_Cache_Adapter_Abstract
{
    /**
     * @throws Q_Cache_Adapter_Exception
     */
    public function __construct($host = 'localhost', $port = 11211)
    {
        if (!extension_loaded('SQLite') && !extension_loaded('pdo_SQLite')) {
            throw new Q_Cache_Adapter_Exception('SQLite is not installed');
        }
    }
}