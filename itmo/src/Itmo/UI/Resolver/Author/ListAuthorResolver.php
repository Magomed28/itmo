<?php

namespace Itmo\UI\Resolver\Author;

use Generator;
use Itmo\Application\UseCases\Query\Author\List\ListAuthorQuery;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;

class ListAuthorResolver implements ArgumentValueResolverInterface
{
    public function supports(Request $request, ArgumentMetadata $argument): bool
    {
        return $argument->getType() === ListAuthorQuery::class;
    }

    public function resolve(Request $request, ArgumentMetadata $argument): Generator
    {
        yield new ListAuthorQuery();
    }
}
