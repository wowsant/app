<?php

namespace App\Exceptions;

use Exception;
use App\Exceptions\ExceptionsDataAPI;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
// PLEASE ADD UnauthorizedHttpException class
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class Handler extends ExceptionHandler
{
    // OTHER LINES ARE HERE

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
      // PLEASE ADD THIS LINES
        if ($exception instanceof UnauthorizedHttpException) {

            $preException = $exception->getPrevious();

            if ($preException instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException)
            {
                return ExceptionsDataAPI::errorToken('TOKEN_EXPIRED');
            }
            else if ($preException instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException)
            {
                return ExceptionsDataAPI::errorToken('TOKEN_INVALID');
            }
            else if ($preException instanceof \Tymon\JWTAuth\Exceptions\TokenBlacklistedException) {

                return ExceptionsDataAPI::errorToken('TOKEN_BLACKLISTED');
            }
        }

        if ($exception->getMessage() === 'Token not provided')
        {
            return ExceptionsDataAPI::errorToken('TOKEN_NOT_PROVIDED');
        }

        return parent::render($request, $exception);
    }
}