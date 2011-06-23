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
     * @var SQLiteDatabase
     */
    protected $_db;

    /**
     * @throws Q_Cache_Adapter_Exception
     */
    public function __construct($host = 'localhost', $port = 11211)
    {
        if (!extension_loaded('SQLite') && !extension_loaded('pdo_SQLite')) {
            throw new Q_Cache_Adapter_Exception('SQLite is not installed');
        }
    }

    public function flush()
    {
        return (boolean) $this->_db->query("DELETE FROM cache")->numRows();
    }

    public function get($key, $defaultValue = null)
    {
        $value = $this->_db->singleQuery(sprintf("SELECT value FROM cache WHERE key = '%s' AND timeout > %d", sqlite_escape_string($this->get($key)), time()));

        return (null === $value) ? $defaultValue : $value;
    }

    public function has($key)
    {
        return (boolean) $this->_db->query(sprintf("SELECT key FROM cache WHERE key = '%s' AND timeout > %d", sqlite_escape_string($this->get($key)), time()))->numRows();
    }

    public function remove($key)
    {
        return (boolean) $this->_db->query(sprintf("DELETE FROM cache WHERE key = '%s'", sqlite_escape_string($this->get($key))));
    }

    public function set($key, $value, $lifetime = null)
    {
        return (boolean) $this->_db->query(sprintf("INSERT OR REPLACE INTO cache (key, value, timeout, last_modified) VALUES ('%s', '%s', %d, %d)", sqlite_escape_string($this->get($key)), sqlite_escape_string($value), time() + $this->getLifetime($lifetime), time()));
    }

    /**
     * @throws Q_Cache_Adapter_Exception
     */
    protected function createSchema()
    {
        $statements = array(
            'CREATE TABLE [cache] (
                [key] VARCHAR(255),
                [value] LONGVARCHAR,
                [timeout] TIMESTAMP,
                [last_modified] TIMESTAMP
              )',
            'CREATE UNIQUE INDEX [cache_unique] ON [cache] ([key])',
        );

        foreach ($statements as $statement) {
            if (!$this->query($statement)) {
                throw new Q_Cache_Adapter_Exception(sqlite_error_string($this->_db->lastError()));
            }
        }
    }
}