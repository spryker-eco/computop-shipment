<?php

namespace SprykerEcoTest\Zed\ComputopShipment\Business;

use Codeception\Test\Unit;
use SprykerEco\Shared\ComputopShipment\ComputopShipmentConstants;
use SprykerEco\Zed\ComputopShipment\Business\ComputopShipmentException;

class ComputopShipmentFacadeTest extends Unit
{
    /**
     * @var string
     */
    public const CORRECT_SHIPMENT_METHOD_KEY = 'spryker_dummy_shipment-standard';

    /**
     * @var string
     */
    public const INCORRECT_SHIPMENT_METHOD_KEY = 'incorrect';

    /**
     * @var \SprykerEcoTest\Zed\ComputopShipment\ComputopShipmentBusinessTester
     */
    protected $tester;

    /**
     * @var \SprykerTest\Shared\Quote\Helper\PersistentQuoteHelper
     */
    protected $persistentQuoteHelper;

    public function testSuccessExpandQuoteWithDefaultShippingMethod()
    {
        //Arrange
        $this->tester->setConfig(ComputopShipmentConstants::PAYPAL_EXPRESS_DEFAULT_SHIPMENT_METHOD_KEY, static::CORRECT_SHIPMENT_METHOD_KEY);
        $quoteTransfer = $this->tester->haveQuoteWithItems();

        //Act
        $quoteTransfer = $this->tester->getFacade()->expandQuoteWithDefaultShippingMethod($quoteTransfer);

        //Assert
        $this->assertNotNull($quoteTransfer->getShipment());
    }

    /**
     * @return void
     */
    public function testMethodNotFoundExpandQuoteWithDefaultShippingMethod(): void
    {
        //Arrange
        $this->tester->setConfig(ComputopShipmentConstants::PAYPAL_EXPRESS_DEFAULT_SHIPMENT_METHOD_KEY, static::INCORRECT_SHIPMENT_METHOD_KEY);
        $quoteTransfer = $this->tester->haveQuoteWithItems();

        //Assert
        $this->expectException(ComputopShipmentException::class);

        //Act
        $quoteTransfer = $this->tester->getFacade()->expandQuoteWithDefaultShippingMethod($quoteTransfer);
    }
}
