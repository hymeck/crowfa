<?php

declare(strict_types=1);

namespace App\Service;


class ResponseResult implements ResponseResultInterface
{
    /**
     * indicates whether request is successful
     */
    protected bool $isSuccess;

    /**
     * status code of response
     */
    protected int $statusCode;

    /**
     * data to return
     */
    protected mixed $data;

    protected function __construct(bool $isSuccess, int $statusCode, $data)
    {
        $this->isSuccess = $isSuccess;
        $this->statusCode = $statusCode;
        $this->data = $data;
    }

    public static function success($data, int $code): ResponseResultInterface
    {
        return new ResponseResult(true, $code, $data);
    }

    public static function failure($data, int $code): ResponseResultInterface
    {
        return new ResponseResult(false, $code, $data);
    }

    public function isSuccess(): bool
    {
        return $this->isSuccess;
    }

    public function getData(): mixed
    {
        return $this->data;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }
}
