<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Yves\ComputopShipment;

use Spryker\Yves\Kernel\AbstractBundleDependencyProvider;
use Spryker\Yves\Kernel\Container;
use SprykerEco\Yves\ComputopShipment\Dependency\ComputopShipmentToShipmentClientBridge;

class ComputopShipmentDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const CLIENT_SHIPMENT = 'CLIENT_SHIPMENT';

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    public function provideDependencies(Container $container): Container
    {
        $container = parent::provideDependencies($container);

        $container = $this->addShipmentClient($container);

        return $container;
    }

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    protected function addShipmentClient(Container $container): Container
    {
        $container->set(static::CLIENT_SHIPMENT, function (Container $container) {
            return new ComputopShipmentToShipmentClientBridge($container->getLocator()->shipment()->client());
        });

        return $container;
    }
}
