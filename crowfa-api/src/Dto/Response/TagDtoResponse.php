<?php


namespace App\Dto\Response;


class TagDtoResponse
{
    public int $tid;
    public string $value;

    public function __construct(int $tid, string $value)
    {
        $this->tid = $tid;
        $this->value = $value;
    }
}
