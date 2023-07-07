<?php

namespace Itmo\Application\UseCases\Query\Author\Delete;

use Itmo\Application\UseCases\Query\QueryInterface;

class DeleteAuthorQuery implements QueryInterface
{
    public function __construct(
        private readonly int $id,
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }
}
