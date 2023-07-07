<?php

namespace Itmo\UI\Resolver\Book;

use Generator;
use Itmo\Application\UseCases\Query\Book\Update\UpdateBookQuery;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;

class UpdateBookResolver implements ArgumentValueResolverInterface
{

    public function supports(Request $request, ArgumentMetadata $argument): bool
    {
        return $argument->getType() === UpdateBookQuery::class;
    }

    public function resolve(Request $request, ArgumentMetadata $argument): Generator
    {
        $content = json_decode($request->getContent(), true);

        yield new UpdateBookQuery(
            $content['id'],
            $content['name'],
            $content['isbn'],
            $content['numberPages'],
            $content['yearPublishing'],
        );
    }
}
