<?php

namespace Itmo\UI\Resolver\Book;

use Generator;
use Itmo\Application\UseCases\Query\Book\Add\AddBookQuery;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;

class AddBookResolver implements ArgumentValueResolverInterface
{

    public function supports(Request $request, ArgumentMetadata $argument): bool
    {
        return $argument->getType() === AddBookQuery::class;
    }

    public function resolve(Request $request, ArgumentMetadata $argument): Generator
    {
        $content = json_decode($request->getContent(), true);

        yield new AddBookQuery($content['name'], $content['isbn'], $content['numberPages'], $content['yearPublishing']);
    }
}
