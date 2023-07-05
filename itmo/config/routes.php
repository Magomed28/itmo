<?php
    use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

        return function (RoutingConfigurator $routes) {
        $apiVersionPrefix = '/api';

        $routes->import(__DIR__ . '/../src/Itmo/UI/Http/Rest/Controller/Author/', 'annotation')
        ->prefix("{$apiVersionPrefix}/")
        ->namePrefix('author.api.');

        $routes->import(__DIR__ . '/../src/Itmo/UI/Http/Rest/Controller/Book/', 'annotation')
            ->prefix("{$apiVersionPrefix}/")
            ->namePrefix('book.api.');

    };