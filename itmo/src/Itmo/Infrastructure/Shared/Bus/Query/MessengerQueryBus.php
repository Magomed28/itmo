<?php

namespace Itmo\Infrastructure\Shared\Bus\Query;

use Itmo\Application\UseCases\Query\QueryBusInterface;
use Itmo\Application\UseCases\Query\QueryInterface;
use Itmo\Infrastructure\Shared\Bus\MessageBusExceptionTrait;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Throwable;

/**
 * Class MessengerQueryBus
 *
 * @package Itmo\Infrastructure\Shared\Bus\Query
 */
class MessengerQueryBus implements QueryBusInterface
{
    use MessageBusExceptionTrait;

    public function __construct(
        private readonly MessageBusInterface $messageBus,
    ) {
    }

    /**
     * @throws Throwable
     * @return mixed
     */
    public function ask(QueryInterface $query)
    {


        try {
            $envelope = $this->messageBus->dispatch($query);
            /** @var HandledStamp $stamp */
            $stamp = $envelope->last(HandledStamp::class);

            return $stamp->getResult();
        } catch (HandlerFailedException $e) {

            $this->throwException($e);
        }
    }
}
