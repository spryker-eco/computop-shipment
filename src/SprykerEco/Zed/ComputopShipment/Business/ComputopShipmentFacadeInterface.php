<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\ComputopShipment\Business;

use Generated\Shared\Transfer\QuoteTransfer;
use SprykerEco\Zed\ComputopShipment\Business\Exception\ComputopDefaultShipmentException;

interface ComputopShipmentFacadeInterface
{
    /**
     * Specification:
     * - Throws `ComputopDefaultShipmentException` if shipment method not found in DB.
     * - Expands `QuoteTransfer` with default shipping method from config.
     *
     * @api
     *
     * @throws ComputopDefaultShipmentException
     *
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function expandQuoteWithDefaultShippingMethod(QuoteTransfer $quoteTransfer): QuoteTransfer;
}
