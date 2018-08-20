<?php

namespace App\Exceptions;

use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Class RequestException
 * @package App\Exceptions
 */
class RequestException extends HttpException
{
    private $errors;
    private $messageCode;

    /**
     * RequestException constructor.
     * @param string $message
     * @param string $messageCode
     * @param int $statusCode
     * @param array $errors
     * @param array $headers
     * @param \Exception|null $previous
     */
    public function __construct(
        string $message,
        string $messageCode,
        int $statusCode,
        array $errors = [],
        array $headers = array(),
        \Exception $previous = null
    ) {
        parent::__construct($statusCode, $message, $previous, $headers);

        $this->errors = $errors;
        $this->messageCode = $messageCode;
    }

    /**
     * @return array
     */
    public function getErrors() : array
    {
        return array_where($this->errors, function ($value) {
            return !is_null($value);
        });
    }

    /**
     * @return null
     */
    public function getMessageCode()
    {
        return $this->messageCode;
    }
}
