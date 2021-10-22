<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Yves\ComputopShipment\Plugin\Computop;

use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Yves\Kernel\AbstractPlugin;
use SprykerEco\Yves\ComputopExtension\Dependency\Plugin\PayPalExpressInitQuoteExpanderPluginInterface;

/**
 * @method \SprykerEco\Yves\ComputopShipment\ComputopShipmentFactory getFactory()
 */
class ExpandShipmentPayPalExpressInitPlugin extends AbstractPlugin implements PayPalExpressInitQuoteExpanderPluginInterface
{
    /**
     * {@inheritDoc}
     * - Expands Quote with shipment groups.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function expand(QuoteTransfer $quoteTransfer): QuoteTransfer
    {
        return $this->getFactory()->getShipmentClient()->expandQuoteWithShipmentGroups($quoteTransfer);
    }
}
