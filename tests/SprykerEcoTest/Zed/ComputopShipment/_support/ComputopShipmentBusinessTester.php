<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEcoTest\Zed\ComputopShipment;

use Codeception\Actor;
use Generated\Shared\DataBuilder\QuoteBuilder;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\StoreTransfer;

/**
 * Inherited Methods
 *
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
class ComputopShipmentBusinessTester extends Actor
{
    use _generated\ComputopShipmentBusinessTesterActions;

    /**
     * @return \Generated\Shared\Transfer\QuoteTransfer
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
