<?php

declare(strict_types=1);

namespace Itmo\Application\UseCases\Query;

interface QueryBusInterface
{
    /**
     * @return mixed
     */
    public function ask(QueryInterface $query);
}
