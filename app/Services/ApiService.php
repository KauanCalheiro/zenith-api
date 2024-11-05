<?php

namespace App\Services;

use Exception;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class ApiService
{
    private const DEFAULT_ERROR_CODE = 500;

    private const RESPONSE_COLLUMN_WITH_SUCCESS = "success";
    private const RESPONSE_COLLUMN_WITH_MESSAGE = "message";
    private const RESPONSE_COLLUMN_WITH_DATA    = "payload";
    private const RESPONSE_COLLUMN_WITH_COUNT   = "count";

    /**
     * Return a JSON response with the data passed
     *
     * @param array|object $data data to be returned
     * @param string $message    message to be displayed
     * @param integer $code      HTTP status code
     *
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     *
     * @author Kauan Morinel Calheiro <kauan.calheiro@univates.br>
     *
     * @date 2024-06-08
     */
    public static function response(array|object $data, string $message = "Request successfully", int $code = 200): Response|ResponseFactory
    {
        return response(
            [
                self::RESPONSE_COLLUMN_WITH_SUCCESS => true,
                self::RESPONSE_COLLUMN_WITH_MESSAGE => __($message),
                self::RESPONSE_COLLUMN_WITH_DATA    => $data,
                self::RESPONSE_COLLUMN_WITH_COUNT   => is_array($data) ? count($data) : 1
            ],
            $code
        );
    }

    /**
     * Return a JSON response with the error message passed
     *
     * @param \Exception $e
     * @param integer|null $code
     *
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     *
     * @author Kauan Morinel Calheiro <kauan.calheiro@univates.br>
     *
     * @date 2024-06-08
     */
    public static function responseError(Exception $e, ?int $code = NULL): Response|ResponseFactory
    {
        if ($e->getCode() != 0 && empty($code) && self::isValidHttpCode($e->getCode()))
        {
            $code = $e->getCode();
        }

        $code = self::isValidHttpCode($code) ? $code : self::DEFAULT_ERROR_CODE;

        return response(
            [
                self::RESPONSE_COLLUMN_WITH_SUCCESS => false,
                self::RESPONSE_COLLUMN_WITH_MESSAGE => $e->getMessage(),
                self::RESPONSE_COLLUMN_WITH_DATA    => null,
                self::RESPONSE_COLLUMN_WITH_COUNT   => 0
            ],
            $code ?: self::DEFAULT_ERROR_CODE
        );
    }

    /**
     * Check if the HTTP code is valid
     *
     * @param integer $code
     *
     * @return boolean
     *
     * @author Kauan Morinel Calheiro <kauan.calheiro@univates.br>
     *
     * @date 2024-06-12
     */
    private static function isValidHttpCode(?int $code): bool
    {
        if (empty($code))
        {
            return false;
        }
        return $code >= 100 && $code <= 599;
    }
}
