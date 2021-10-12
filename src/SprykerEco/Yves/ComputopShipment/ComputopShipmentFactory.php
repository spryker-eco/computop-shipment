<?php

namespace SprykerEco\Yves\ComputopShipment;

use Spryker\Yves\Kernel\AbstractFactory;
use SprykerEco\Yves\ComputopShipment\Dependency\ComputopShipmentToShipmentClientInterface;

class ComputopShipmentFactory extends AbstractFactory
{
    /**
     * @return ComputopShipmentToShipmentClientInterface
     */
    public function getShipmentClient(): ComputopShipmentToShipmentClientInterface
    {
        return $this->getProvidedDependency(ComputopShipmentDependencyProvider::CLIENT_SHIPMENT);
    }
}
