<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Yves\ComputopShipment;

use Spryker\Yves\Kernel\AbstractFactory;
use SprykerEco\Yves\ComputopShipment\Dependency\ComputopShipmentToShipmentClientInterface;

class ComputopShipmentFactory extends AbstractFactory
{
    /**
     * @return \SprykerEco\Yves\ComputopShipment\Dependency\ComputopShipmentToShipmentClientInterface
     */
    public function getShipmentClient(): ComputopShipmentToShipmentClientInterface
    {
        return $this->getProvidedDependency(ComputopShipmentDependencyProvider::CLIENT_SHIPMENT);
    }
}
