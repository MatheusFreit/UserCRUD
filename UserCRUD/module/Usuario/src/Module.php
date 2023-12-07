<?php

declare(strict_types=1);

namespace Usuario;

class Module
{
    public function getConfig()
    {
        $config = include __DIR__ . '/../config/module.config.php';
        return $config;
    }
}
?>