<?php

namespace App\Exceptions\Auth;

use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Class TooManyRequestsException
 * @package App\Exceptions\Auth
 */
class TooManyRequestsException extends HttpException
{
    private $timeLeft;

    /**
     * InvalidCredentialsException constructor.
     * @param null $message
     * @param null $statusCode
     * @param array $headers
     * @param int $timeLeft
     * @param null $previous
     */
    public function __construct($message, $statusCode, array $headers = array(), int $timeLeft = 0, $previous = null)
    {
        parent::__construct($message, $statusCode, $headers, $previous);

        $this->timeLeft = $timeLeft;
    }

    /**
     * @return int
     */
    public function getTimeLeft(): int
    {
        return $this->timeLeft;
    }
}
