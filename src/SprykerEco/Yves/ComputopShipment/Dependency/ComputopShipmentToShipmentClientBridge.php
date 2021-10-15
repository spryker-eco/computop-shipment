<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Yves\ComputopShipment\Dependency;

use Generated\Shared\Transfer\QuoteTransfer;

class ComputopShipmentToShipmentClientBridge implements ComputopShipmentToShipmentClientInterface
{
    /**
     * @var \Spryker\Client\Shipment\ShipmentClientInterface
     */
    protected $shipmentClient;

    /**
     * @param \Spryker\Client\Shipment\ShipmentClientInterface $shipmentClient
     */
    public function __construct($shipmentClient)
    {
        $this->shipmentClient = $shipmentClient;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function expandQuoteWithShipmentGroups(QuoteTransfer $quoteTransfer): QuoteTransfer
    {
        return $this->shipmentClient->expandQuoteWithShipmentGroups($quoteTransfer);
    }
}
