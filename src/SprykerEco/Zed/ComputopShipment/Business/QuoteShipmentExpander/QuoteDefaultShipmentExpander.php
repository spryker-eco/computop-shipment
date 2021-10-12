<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\ComputopShipment\Business\QuoteShipmentExpander;

use Generated\Shared\Transfer\AddressTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\ShipmentMethodsTransfer;
use Generated\Shared\Transfer\ShipmentMethodTransfer;
use Generated\Shared\Transfer\ShipmentTransfer;
use SprykerEco\Zed\ComputopShipment\Business\ComputopShipmentException;
use SprykerEco\Zed\ComputopShipment\ComputopShipmentConfig;
use SprykerEco\Zed\ComputopShipment\Dependency\ComputopShipmentToShipmentFacadeInterface;

class QuoteDefaultShipmentExpander implements QuoteShipmentExpanderInterface
{
    /**
     * @var \SprykerEco\Zed\ComputopShipment\ComputopShipmentConfig
     */
    protected $computopShipmentConfig;

    /**
     * @var \SprykerEco\Zed\ComputopShipment\Dependency\ComputopShipmentToShipmentFacadeInterface
     */
    protected $shipmentFacade;

    /**
     * @param \SprykerEco\Zed\ComputopShipment\ComputopShipmentConfig $computopShipmentConfig
     * @param \SprykerEco\Zed\ComputopShipment\Dependency\ComputopShipmentToShipmentFacadeInterface $shipmentFacade
     */
    public function __construct(ComputopShipmentConfig $computopShipmentConfig, ComputopShipmentToShipmentFacadeInterface $shipmentFacade)
    {
        $this->computopShipmentConfig = $computopShipmentConfig;
        $this->shipmentFacade = $shipmentFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @throws \SprykerEco\Zed\ComputopShipment\Business\ComputopShipmentException
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function expand(QuoteTransfer $quoteTransfer): QuoteTransfer
    {
        $quoteTransfer->setDefaultShipmentSelected(true);

        $defaultShipmentMethodKey = $this->computopShipmentConfig->getDefaultShipmentMethodKey();
        $defaultShipmentMethodTransfer = $this->shipmentFacade->findShipmentMethodByKey($defaultShipmentMethodKey);
        if ($defaultShipmentMethodTransfer === null || $defaultShipmentMethodTransfer->getIsActive() === false) {
            throw new ComputopShipmentException('Default shipment method is not available!');
        }

        $itemShipmentTransfer = $this->createShipmentTransfer($defaultShipmentMethodTransfer);
        $quoteTransfer = $this->addShipmentToQuoteItems($quoteTransfer, $itemShipmentTransfer);
        $quoteTransfer = $this->shipmentFacade->expandQuoteWithShipmentGroups($quoteTransfer);

        return $quoteTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     * @param \Generated\Shared\Transfer\ShipmentTransfer $shipmentTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    protected function addShipmentToQuoteItems(QuoteTransfer $quoteTransfer, ShipmentTransfer $shipmentTransfer): QuoteTransfer
    {
        foreach ($quoteTransfer->getItems() as $itemTransfer) {
            $itemTransfer->setShipment($shipmentTransfer);
        }

        return $quoteTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\ShipmentMethodTransfer $shipmentMethodTransfer
     *
     * @return \Generated\Shared\Transfer\ShipmentTransfer
     */
    protected function createShipmentTransfer(ShipmentMethodTransfer $shipmentMethodTransfer): ShipmentTransfer
    {
        return (new ShipmentTransfer())
            ->setShipmentSelection($shipmentMethodTransfer->getIdShipmentMethod())
            ->setMethod($shipmentMethodTransfer)
            ->setShippingAddress(new AddressTransfer());
    }

    /**
     * @param \Generated\Shared\Transfer\ShipmentMethodsTransfer $shipmentMethodsTransfer
     * @param string $shipmentMethodKey
     *
     * @return \Generated\Shared\Transfer\ShipmentMethodTransfer|null
     */
    protected function findShipmentMethodById(ShipmentMethodsTransfer $shipmentMethodsTransfer, string $shipmentMethodKey): ?ShipmentMethodTransfer
    {
        foreach ($shipmentMethodsTransfer->getMethods() as $shipmentMethodTransfer) {
            if ($shipmentMethodTransfer->getShipmentMethodKey() === $shipmentMethodKey) {
                return $shipmentMethodTransfer;
            }
        }

        return null;
    }
}
