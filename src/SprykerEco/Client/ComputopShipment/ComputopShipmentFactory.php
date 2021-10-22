<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Client\ComputopShipment;

use Spryker\Client\Kernel\AbstractFactory;
use SprykerEco\Client\ComputopShipment\Dependency\Client\ComputopShipmentToZedRequestClientInterface;
use SprykerEco\Client\ComputopShipment\QuoteShipmentExpander\QuoteDefaultShipmentExpander;
use SprykerEco\Client\ComputopShipment\QuoteShipmentExpander\QuoteShipmentExpanderInterface;
use SprykerEco\Client\ComputopShipment\Zed\ComputopShipmentStub;
use SprykerEco\Client\ComputopShipment\Zed\ComputopShipmentStubInterface;

class ComputopShipmentFactory extends AbstractFactory
{
    /**
     * @return \SprykerEco\Client\ComputopShipment\Zed\ComputopShipmentStubInterface
     */
    public function createZedStub(): ComputopShipmentStubInterface
    {
        return new ComputopShipmentStub($this->getZedRequestClient());
    }

    /**
     * @return \SprykerEco\Client\ComputopShipment\Dependency\Client\ComputopShipmentToZedRequestClientInterface
     */
    public function getZedRequestClient(): ComputopShipmentToZedRequestClientInterface
    {
        return $this->getProvidedDependency(ComputopShipmentDependencyProvider::CLIENT_ZED_REQUEST);
    }

    /**
     * @return \SprykerEco\Client\ComputopShipment\QuoteShipmentExpander\QuoteShipmentExpanderInterface
     */
    public function createQuoteShipmentExpander(): QuoteShipmentExpanderInterface
    {
        return new QuoteDefaultShipmentExpander($this->createZedStub());
    }
}
