<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Client\ComputopShipment\Quote\Dependency\Plugin;

use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Client\Kernel\AbstractPlugin;
use Spryker\Client\Quote\Dependency\Plugin\QuoteTransferExpanderPluginInterface;

/**
 * @method \SprykerEco\Client\ComputopShipment\ComputopShipmentFactory getFactory()
 */
class DefaultShippingMethodQuoteTransferExpanderPlugin extends AbstractPlugin implements QuoteTransferExpanderPluginInterface
{
    /**
     * {@inheritDoc}
     * - Makes Zed request.
     * - Expands provided `QuoteTransfer` with default shipping method if any item
     *   in the quote does not have shipping method.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function expandQuote(QuoteTransfer $quoteTransfer): QuoteTransfer
    {
        return $this->getFactory()->createQuoteShipmentExpander()->expand($quoteTransfer);
    }
}
