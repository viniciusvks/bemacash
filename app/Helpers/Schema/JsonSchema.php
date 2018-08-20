<?php

namespace App\Helpers\Schema;

/**
 * Class JsonSchema
 * @package App\Helpers\Schema
 */
abstract class JsonSchema implements \JsonSerializable
{
    protected $message;
    protected $headers;
    protected $messageCode;
    protected $statusCode;
    protected $isDebugEnable;
    protected $isTraceEnable;

    /**
     * JsonSchema constructor.
     */
    public function __construct()
    {
        $this->isDebugEnable = config('app.debug');
        $this->isTraceEnable = config('app.trace');
    }

    /**
     * @param string $message
     */
    public function setMessage(string $message)
    {
        if (!mb_detect_encoding($message, 'utf-8', true)) {
            $message = utf8_encode($message);
        }

        $this->message = $message;
    }

    /**
     * @return array
     */
    public function getHeaders() : array
    {
        return $this->headers;
    }

    /**
     * @param array $headers
     */
    public function setHeaders(array $headers)
    {
        $this->headers = $headers;
    }

    /**
     * @return string
     */
    public function getMessageCode() : string
    {
        return $this->messageCode;
    }

    /**
     * @param string $messageCode
     */
    public function setMessageCode(string $messageCode)
    {
        $this->messageCode = $messageCode;
    }

    /**
     * @return int
     */
    public function getStatusCode() : int
    {
        return $this->statusCode;
    }

    /**
     * @param mixed $statusCode
     */
    public function setStatusCode(int $statusCode)
    {
        $this->statusCode = $statusCode;
    }

    /**
     * @param array $array
     * @return array
     */
    protected function utf8Converter(array $array = []) : array
    {
        array_walk_recursive($array, function (&$item) {
            if (!mb_detect_encoding($item, 'utf-8', true)) {
                $item = utf8_encode($item);
            }
        });

        return $array;
    }

    /**
     * @return array
     */
    abstract public function jsonSerialize();
}
