<?php

namespace App\Helpers;

/**
 * Interface Logger
 * @package JohnDeereProfileBundle\Helper
 */
class JsonLogger implements JsonLoggable
{
    private $data;

    /**
     * JsonLogger constructor.
     * @param array $data
     */
    public function __construct(array $data = array())
    {
        $this->data = $data;
    }

    /**
     * @param $key
     * @param $value
     */
    public function log($key, $value)
    {
        $this->data[$key] = $value;
    }

    /**
     * @return string
     */
    public function toJSON()
    {
        return json_encode($this->jsonSerialize());
    }

    /**
     * @param JsonLogger $logger
     * @return int
     */
    public function append(JsonLogger $logger)
    {
        return array_push($this->data, $logger->toArray());
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return $this->data;
    }

    public static function utf8Decore(array $data)
    {
        array_walk_recursive($data, function (&$item, $key) {
            $item = utf8_decode($item);
        });

        return $data;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        $data = $this->data;

        array_walk_recursive($data, function (&$item, $key) {
            $item = utf8_encode($item);
        });

        return $data;
    }
}
