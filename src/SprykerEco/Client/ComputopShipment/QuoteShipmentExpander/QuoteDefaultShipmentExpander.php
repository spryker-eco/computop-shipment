<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Client\ComputopShipment\QuoteShipmentExpander;

use Generated\Shared\Transfer\QuoteTransfer;
use SprykerEco\Client\ComputopShipment\Zed\ComputopShipmentStubInterface;

class QuoteDefaultShipmentExpander implements QuoteShipmentExpanderInterface
{
    /**
     * @var \SprykerEco\Client\ComputopShipment\Zed\ComputopShipmentStubInterface
     */
    protected $computopShipmentStub;

    /**
     * @param \SprykerEco\Client\ComputopShipment\Zed\ComputopShipmentStubInterface $computopShipmentStub
     */
    public function __construct(ComputopShipmentStubInterface $computopShipmentStub)
    {
        $this->computopShipmentStub = $computopShipmentStub;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function expand(QuoteTransfer $quoteTransfer): QuoteTransfer
    {
        if ($quoteTransfer->getItems()->count() === 0 || $this->isQuoteHasShipment($quoteTransfer)) {
            return $quoteTransfer;
        }

        return $this->computopShipmentStub->expandQuoteWithDefaultShippingMethod($quoteTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return bool
     */
    protected function isQuoteHasShipment(QuoteTransfer $quoteTransfer): bool
    {
        foreach ($quoteTransfer->getItems() as $itemTransfer) {
            if ($itemTransfer->getShipment() !== null && $itemTransfer->getShipment()->getMethod() !== null) {
                return true;
            }
        }

        return false;
    }
}
