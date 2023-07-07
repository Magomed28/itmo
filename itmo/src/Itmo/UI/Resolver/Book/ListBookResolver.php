<?php

namespace Itmo\UI\Resolver\Book;

use Generator;
use Itmo\Application\UseCases\Query\Book\List\ListBookQuery;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;

class ListBookResolver implements ArgumentValueResolverInterface
{
    public function supports(Request $request, ArgumentMetadata $argument): bool
    {
        return $argument->getType() === ListBookQuery::class;
    }

    public function resolve(Request $request, ArgumentMetadata $argument): Generator
    {
        yield new ListBookQuery();
    }
}
