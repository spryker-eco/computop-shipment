<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\ComputopShipment\Business;

use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use SprykerEco\Zed\ComputopShipment\Business\QuoteShipmentExpander\QuoteDefaultShipmentExpander;
use SprykerEco\Zed\ComputopShipment\Business\QuoteShipmentExpander\QuoteShipmentExpanderInterface;
use SprykerEco\Zed\ComputopShipment\ComputopShipmentDependencyProvider;
use SprykerEco\Zed\ComputopShipment\Dependency\ComputopShipmentToShipmentFacadeInterface;

/**
 * @method \SprykerEco\Zed\ComputopShipment\ComputopShipmentConfig getConfig()
 */
class ComputopShipmentBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \SprykerEco\Zed\ComputopShipment\Business\QuoteShipmentExpander\QuoteShipmentExpanderInterface
     */
    public function createQuoteDefaultShipmentExpander(): QuoteShipmentExpanderInterface
    {
        return new QuoteDefaultShipmentExpander(
            $this->getConfig(),
            $this->getShipmentFacade(),
        );
    }

    /**
     * @return \SprykerEco\Zed\ComputopShipment\Dependency\ComputopShipmentToShipmentFacadeInterface
     */
    public function getShipmentFacade(): ComputopShipmentToShipmentFacadeInterface
    {
        return $this->getProvidedDependency(ComputopShipmentDependencyProvider::FACADE_SHIPMENT);
    }
}
