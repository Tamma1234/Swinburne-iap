<?php

namespace App\Service;

use Illuminate\Support\Facades\Log;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;
use PayPal\Api\Payer;

class ProcessOrderService
{
    /**
     * Payment by Paypal.
     * 
     * @param $apiContext
     * @param $cart
     * 
     * @return array
     */
    public function paymentByPaypal($apiContext, $cart)
    {
        $payer = new Payer();
        $payer->setPaymentMethod("paypal");

        foreach ($cart->products as $key => $value) {
            $item = new Item();
            $item->setName($value['productInfo']->title)
                ->setCurrency("USD")
                ->setQuantity($value['quantity'])
                ->setSku($value['productInfo']->id) // Similar to `item_number` in Classic API
                ->setPrice(round($value['price'] / 23000, 2));
            $this->totalPrice = $value['quantity'] * round($value['price'] / 23000, 2);

            $this->itemList[] = $item;
        }

        $itemList = new ItemList();
        $itemList->setItems($this->itemList);

        $details = new Details();
        $details->setSubtotal($this->totalPrice);

        // ### Amount
        // Lets you specify a payment amount.
        // You can also specify additional details
        // such as shipping, tax.
        $amount = new Amount();
        $amount->setCurrency("USD")
            ->setTotal($this->totalPrice)
            ->setDetails($details);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription("Payment description")
            ->setInvoiceNumber(uniqid());


        // $baseUrl = getBaseUrl();
        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(route('payment.create'))
            ->setCancelUrl(route('payment.create'));

        $payment = new Payment();
        $payment->setIntent("sale")
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions(array($transaction));

        try {
            $payment->create($apiContext);
        } catch (\Exception $ex) {
            Log::error('Error', [$ex->getMessage()]);
        }

        return [$payment->id, $payment->getApprovalLink()];
    }
}
