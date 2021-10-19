<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Client\ComputopShipment\Dependency\Client;

use Spryker\Shared\Kernel\Transfer\TransferInterface;

interface ComputopShipmentToZedRequestClientInterface
{
    /**
     * @param string $url
     * @param \Spryker\Shared\Kernel\Transfer\TransferInterface $object
     * @param array|null $requestOptions
     *
     * @return \Spryker\Shared\Kernel\Transfer\TransferInterface
     */
    // phpcs:ignore
    public function call($url, TransferInterface $object, $requestOptions = null);
}
