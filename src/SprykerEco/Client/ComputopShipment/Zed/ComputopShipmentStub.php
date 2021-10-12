<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Client\ComputopShipment\Zed;

use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Shared\Kernel\Transfer\TransferInterface;
use SprykerEco\Client\ComputopShipment\Dependency\Client\ComputopShipmentToZedRequestClientInterface;

class ComputopShipmentStub implements ComputopShipmentStubInterface
{
    /**
     * @var ComputopShipmentToZedRequestClientInterface
     */
    protected ComputopShipmentToZedRequestClientInterface $zedRequestClient;

    /**
     * @param ComputopShipmentToZedRequestClientInterface $zedRequestClient
     */
    public function __construct(ComputopShipmentToZedRequestClientInterface $zedRequestClient)
    {
        $this->zedRequestClient = $zedRequestClient;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function expandQuoteWithDefaultShippingMethod(QuoteTransfer $quoteTransfer): QuoteTransfer
    {
        /** @var \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer */
        $quoteTransfer = $this->zedRequestClient->call('/computop-shipment/gateway/expand-quote-with-default-shipping-method', $quoteTransfer);

        return $quoteTransfer;
    }
}
