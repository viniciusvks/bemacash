<?php

namespace App\Exceptions\Auth;

use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Class TokenExpiredException
 * @package App\Exceptions\Auth
 */
class TokenExpiredException extends HttpException
{
}
