<?php

declare(strict_types=1);

namespace Usuario;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\ResultSet\ResultSet;
use Laminas\Db\TableGateway\TableGateway;
use Usuario\Controller\UsuarioController;

class Module
{
    public function getConfig()
    {
        $config = include __DIR__ . '/../config/module.config.php';
        return $config;
    }

    //Configuração de serviços para injeção de dependência.  

    public function getServiceConfig()
    {
        return [
            'factories' => [
                Model\UsuarioTable::class => function ($container) {
                    $tableGateway = $container->get(Model\UsuarioTableGateway::class);
                    return new Model\UsuarioTable($tableGateway);
                },
                Model\UsuarioTableGateway::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Usuario());

                    return new TableGateway('usuarios', $dbAdapter, null, $resultSetPrototype);
                },
            ],
        ];
    }
    //Configuração de controladores.
    public function getControllerConfig()
    {
        return [
            'factories' => [
                UsuarioController::class => function ($container) {
                    $tableGateway = $container->get(Model\UsuarioTable::class);
                    $dbAdapter = $container->get(AdapterInterface::class);
                    return new UsuarioController($tableGateway, $dbAdapter);
                },
            ],
        ];
    }
}
?>