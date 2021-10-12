<?php

namespace SprykerEco\Yves\ComputopShipment\Plugin\Computop;

use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Yves\Kernel\AbstractPlugin;
use SprykerEco\Yves\Computop\Dependency\Plugin\PayPalExpressInitPluginInterface;

/**
 * @method \SprykerEco\Yves\ComputopShipment\ComputopShipmentFactory getFactory()
 */
class ExpandShipmentPlugin extends AbstractPlugin implements PayPalExpressInitPluginInterface
{
    /**
     * {@inheritDoc}
     * - Expands Quote with shipment groups.
     *
     * @api
     *
     * @param QuoteTransfer $quoteTransfer
     *
     * @return QuoteTransfer
     */
    public function aggregate(QuoteTransfer $quoteTransfer): QuoteTransfer
    {
        return $this->getFactory()->getShipmentClient()->expandQuoteWithShipmentGroups($quoteTransfer);
    }
}
