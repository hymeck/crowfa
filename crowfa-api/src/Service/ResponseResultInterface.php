<?php

declare(strict_types=1);

namespace App\Service;


interface ResponseResultInterface
{
    function isSuccess(): bool;
    function getData(): mixed;
    function getStatusCode(): int;
}
