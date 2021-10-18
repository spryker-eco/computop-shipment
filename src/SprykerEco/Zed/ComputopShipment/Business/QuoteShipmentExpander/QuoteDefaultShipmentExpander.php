<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\ComputopShipment\Business\QuoteShipmentExpander;

use Generated\Shared\Transfer\AddressTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\ShipmentMethodTransfer;
use Generated\Shared\Transfer\ShipmentTransfer;
use SprykerEco\Zed\ComputopShipment\Business\Exception\ComputopDefaultShipmentException;
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
     *
     * @throws \SprykerEco\Zed\ComputopShipment\Business\Exception\ComputopDefaultShipmentException
     *
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function expand(QuoteTransfer $quoteTransfer): QuoteTransfer
    {
        $quoteTransfer->setDefaultShipmentSelected(true);

        $defaultShipmentMethodKey = $this->computopShipmentConfig->getDefaultShipmentMethodKey();
        $defaultShipmentMethodTransfer = $this->shipmentFacade->findShipmentMethodByKey($defaultShipmentMethodKey);
        if ($defaultShipmentMethodTransfer === null || $defaultShipmentMethodTransfer->getIsActive() === false) {
            throw new ComputopDefaultShipmentException(
                sprintf('Default shipment method "%s" is not available!', $defaultShipmentMethodKey)
            );
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
}
