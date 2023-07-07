<?php

namespace Itmo\UI\Resolver\Author;

use Generator;
use Itmo\Application\UseCases\Query\Author\Add\AddAuthorQuery;
use Itmo\Application\UseCases\Query\Author\Bind\BindAuthorBookQuery;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;

class BindAuthorBookResolver implements ArgumentValueResolverInterface
{

    public function supports(Request $request, ArgumentMetadata $argument): bool
    {
        return $argument->getType() === BindAuthorBookQuery::class;
    }

    public function resolve(Request $request, ArgumentMetadata $argument): Generator
    {
        $content = json_decode($request->getContent(), true);

        yield new BindAuthorBookQuery($content['author_id'], $content['book_id']);
    }
}
