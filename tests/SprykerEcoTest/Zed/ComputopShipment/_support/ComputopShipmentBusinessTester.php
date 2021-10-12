<?php

namespace SprykerEcoTest\Zed\ComputopShipment;

use Generated\Shared\DataBuilder\QuoteBuilder;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\StoreTransfer;

/**
 * Inherited Methods
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method void pause()
 * @method \SprykerEco\Zed\ComputopShipment\Business\ComputopShipmentFacadeInterface getFacade($moduleName = null)
 *
 * @SuppressWarnings(PHPMD)
*/
class ComputopShipmentBusinessTester extends \Codeception\Actor
{
    use _generated\ComputopShipmentBusinessTesterActions;

    /**
     * @return QuoteTransfer
     */
    public function haveQuoteWithItems(): QuoteTransfer
    {
        $storeTransfer = $this->haveStore([StoreTransfer::NAME => 'DE']);
        $quoteTransfer = (new QuoteBuilder())
            ->withStore($storeTransfer->toArray())
            ->withCustomer()
            ->withItem()
            ->withCurrency()
            ->withExpense()
        ->build();

        $quoteTransfer->setPriceMode('');

        return $quoteTransfer;

    }
}
