<?php

namespace Itmo\Application\UseCases\Query\Book\Delete;

use Itmo\Application\UseCases\Query\QueryInterface;

class DeleteBookQuery implements QueryInterface
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
