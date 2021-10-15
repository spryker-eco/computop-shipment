<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\ComputopShipment;

use Spryker\Zed\Kernel\AbstractBundleConfig;
use SprykerEco\Shared\ComputopShipment\ComputopShipmentConstants;

class ComputopShipmentConfig extends AbstractBundleConfig
{
    /**
     * @api
     *
     * @return string
     */
    public function getDefaultShipmentMethodKey(): string
    {
        return $this->get(ComputopShipmentConstants::PAYPAL_EXPRESS_DEFAULT_SHIPMENT_METHOD_KEY);
    }
}
