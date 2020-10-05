<?php

use App\Controller\Api\GenerateController;
use App\Controller\Api\OrderController;
use App\Controller\Api\ProductController;
use App\Controller\ErrorController;
use App\Controller\HomeController;
use App\Core\DataManager;
use App\Service\OrderService;
use App\Service\ProductService;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Главный файл конфигурации приложения
 */

return [
    'isDebug'   => true,
    'viewPath'  => __DIR__.'/../views/',
    'errorRoute' => [ErrorController::class, 'errorAction'],
    'routes'    => [
        '/'                   => [HomeController::class, 'homeAction', ['GET']],
        '/api/generate'       => [GenerateController::class, 'productAction', ['POST']],
        '/api/order-create'   => [OrderController::class, 'createAction', ['POST']],
        '/api/order-complete' => [OrderController::class, 'completeAction', ['PUT']],
    ],
    /**
     * Сервисы контейнера
     */
    'container' => [
        DataManager::class => [
            'arguments' => [
                'entityPaths' => [__DIR__.'/../src/Entity',],
                'credentials' => [
                    'driver'   => 'pdo_mysql',
                    'host'     => 'mysql',
                    'dbname'   => 'database',
                    'user'     => 'user',
                    'password' => 'pass',
                    'charset'  => 'utf8',
                ],
            ],
        ],
        ProductService::class => [
            'arguments' => [
                new Reference(DataManager::class)
            ]
        ],
        OrderService::class => [
            'arguments' => [
                new Reference(DataManager::class)
            ]
        ]
    ],
];