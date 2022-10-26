<?php

namespace FSA\SmartHome;

use Redis;

class DeviceStorage
{
    private $redis;
    private $key_prefix;

    public function __construct($redis, $key_prefix)
    {
        $this->redis = $redis;
        $this->key_prefix = $key_prefix;
    }

    public function set(string $hwid, DeviceInterface $object)
    {
        $this->redis->set($this->key_prefix . ':' . $hwid, serialize($object));
    }

    public function setNx(string $hwid, DeviceInterface $object)
    {
        $this->redis->setNx($this->key_prefix . ':' . $hwid, serialize($object));
    }

    public function get(string $hwid): ?DeviceInterface
    {
        $device = unserialize($this->redis->get($this->key_prefix . ':' . $hwid));
        return $device ? $device : null;
    }

    public function exists(string $hwid): bool
    {
        return $this->redis->exists($this->key_prefix . ':' . $hwid);
    }

    public function getAllHwid($plugin = null)
    {
        $search_key = $this->key_prefix . ':' . (empty($plugin) ? '' : ($plugin . ':' . ''));
        $key_length = strlen($search_key);
        $this->redis->setOption(Redis::OPT_SCAN, Redis::SCAN_RETRY);
        $it = NULL;
        $result = [];
        while ($arr_keys = $this->redis->scan($it, $search_key . '*')) {
            foreach ($arr_keys as $str_key) {
                $result[] = substr($str_key, $key_length);
            }
        }
        return $result;
    }
}
