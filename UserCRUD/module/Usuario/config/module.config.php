<?php

namespace Usuario;
use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;
use Laminas\ServiceManager\Factory\InvokableFactory;
use Usuario\Controller\UsuarioController;

return [
    'router' => [
        'routes' => [
            'usuario' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/usuario[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            'id' => '[0-9]+'],
                    'defaults' => [
                        'controller' => Controller\UsuarioController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            //Controller\UsuarioController::class => InvokableFactory::class,
        ],
    ],
   
    'view_manager' => [
        'template_path_stack' => [ 'usuario' => __DIR__ . '/../view',
        ],
    ],
    'db' => [
        'driver'   => 'Pdo_Mysql',
        'database' => 'cadastrado',
        'username' => 'root',
        'password' => '',
        'hostname' => '127.0.0.1',
    ],

    'service_manager' => [
        'factories' => [
            Adapter::class => InvokableFactory::class,
        ],
    ],
    
];


?> 