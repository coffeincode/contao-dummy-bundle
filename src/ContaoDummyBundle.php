<?php

namespace Coffeincode\ContaoDummyBundle;

use Symfony\Component\HttpKernel\Bundle\AbstractBundle;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class ContaoDummyBundle extends AbstractBundle {
    public function loadExtension(array $config, ContainerConfigurator $container, ContainerBuilder $builder): void
    {
        
        $container->import(__DIR__.'/../config/services.yaml');
    }
}
