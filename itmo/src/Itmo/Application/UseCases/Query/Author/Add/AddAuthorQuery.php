<?php

namespace Itmo\Application\UseCases\Query\Author\Add;

use Itmo\Application\UseCases\Query\QueryInterface;

class AddAuthorQuery implements QueryInterface
{
    public function __construct(
        private readonly string $fio,
    ) {
    }

    public function getFio(): string
    {
        return $this->fio;
    }
}
