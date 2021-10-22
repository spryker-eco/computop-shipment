<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEcoTest\Zed\ComputopShipment\Business;

use Codeception\Test\Unit;
use SprykerEco\Shared\ComputopShipment\ComputopShipmentConstants;
use SprykerEco\Zed\ComputopShipment\Business\Exception\ComputopDefaultShipmentException;

class ComputopShipmentFacadeTest extends Unit
{
    /**
     * @var string
     */
    protected const CORRECT_SHIPMENT_METHOD_KEY = 'spryker_dummy_shipment-standard';

    /**
     * @var string
     */
    protected const INCORRECT_SHIPMENT_METHOD_KEY = 'incorrect';

    /**
     * @var \SprykerEcoTest\Zed\ComputopShipment\ComputopShipmentBusinessTester
     */
    protected $tester;

    /**
     * @return void
     */
    public function testExpandQuoteWithDefaultShippingMethodSuccessfullyExpandsQuote(): void
    {
        //Arrange
        $this->tester->setConfig(ComputopShipmentConstants::PAYPAL_EXPRESS_DEFAULT_SHIPMENT_METHOD_KEY, static::CORRECT_SHIPMENT_METHOD_KEY);
        $quoteTransfer = $this->tester->haveQuoteWithItems();

        //Act
        $quoteTransfer = $this->tester->getFacade()->expandQuoteWithDefaultShippingMethod($quoteTransfer);

        //Assert
        $this->assertNotNull($quoteTransfer->getShipment());
        $this->assertSame(static::CORRECT_SHIPMENT_METHOD_KEY, $quoteTransfer->getShipment()->getMethod()->getShipmentMethodKey());
    }

    /**
     * @return void
     */
    public function testExpandQuoteWithDefaultShippingMethodThrowsExceptionWhenShipmentMethodNotFound(): void
    {
        //Arrange
        $this->tester->setConfig(ComputopShipmentConstants::PAYPAL_EXPRESS_DEFAULT_SHIPMENT_METHOD_KEY, static::INCORRECT_SHIPMENT_METHOD_KEY);
        $quoteTransfer = $this->tester->haveQuoteWithItems();

        //Assert
        $this->expectException(ComputopDefaultShipmentException::class);

        //Act
        $quoteTransfer = $this->tester->getFacade()->expandQuoteWithDefaultShippingMethod($quoteTransfer);
    }
}
