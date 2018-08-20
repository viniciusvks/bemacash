<?php

namespace App\Exceptions\Auth;

use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Class TokenBlacklistedException
 * @package App\Exceptions\Auth
 */
class TokenBlacklistedException extends HttpException
{
}
