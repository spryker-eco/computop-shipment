<?php

namespace SprykerEco\Yves\ComputopShipment;

use Spryker\Yves\Kernel\AbstractBundleDependencyProvider;
use Spryker\Yves\Kernel\Container;
use SprykerEco\Yves\ComputopShipment\Dependency\ComputopShipmentToShipmentClientBridge;

class ComputopShipmentDependencyProvider extends AbstractBundleDependencyProvider
{
    public const CLIENT_SHIPMENT = 'CLIENT_SHIPMENT';

    public function provideDependencies(Container $container)
    {
        $container = parent::provideDependencies($container);

        $container = $this->addShipmentClient($container);

        return $container;
    }

    /**
     * @param Container $container
     *
     * @return Container
     */
    protected function addShipmentClient(Container $container): Container
    {
        $container->set(static::CLIENT_SHIPMENT, function (Container $container) {
            return new ComputopShipmentToShipmentClientBridge($container->getLocator()->shipment()->client());
        });

        return $container;
    }
}
