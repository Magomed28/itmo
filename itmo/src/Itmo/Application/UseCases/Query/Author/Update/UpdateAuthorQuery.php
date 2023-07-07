<?php

namespace Itmo\Application\UseCases\Query\Author\Update;

use Itmo\Application\UseCases\Query\QueryInterface;

class UpdateAuthorQuery implements QueryInterface
{
    public function __construct(
        private readonly int $id,
        private readonly string $fio,
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getFio(): string
    {
        return $this->fio;
    }
}
