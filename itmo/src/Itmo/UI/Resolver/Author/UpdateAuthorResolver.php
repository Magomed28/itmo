<?php

namespace Itmo\UI\Resolver\Author;

use Generator;
use Itmo\Application\UseCases\Query\Author\Update\UpdateAuthorQuery;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;

class UpdateAuthorResolver implements ArgumentValueResolverInterface
{

    public function supports(Request $request, ArgumentMetadata $argument): bool
    {
        return $argument->getType() === UpdateAuthorQuery::class;
    }

    public function resolve(Request $request, ArgumentMetadata $argument): Generator
    {
        $content = json_decode($request->getContent(), true);

        yield new UpdateAuthorQuery($content['id'], $content['fio']);
    }
}
