<?php
/**
 * Created by PhpStorm.
 * User: javad
 * Date: 8/21/20
 * Time: 10:48 AM
 */

namespace App\lib;


use Stripe\Charge;
use Stripe\Customer;

class StripePayment
{

    private $apiKey;

    private $apiKeyPublic;
    private $stripeService;

    public function __construct()
    {
        $this->apiKey = "sk_test_51HILVmH3zr450lLqud8FBmoJZsc4831VYBtyGNZDUGghmQI5SbZKz6k47Xyot577HdoonZ4yRw73MsIgZ8x48UKJ00Fw0Nc7Er";
        $this->apiKeyPublic = "pk_test_51HILVmH3zr450lLqw1PGsMMEpU2Gh11zg68pREYwaSsamBYO3x3pZR5zegGObiwQyyXC6eo8vyz0dfyiWq73edut00aM18Rx3w";
        $this->stripeService = new \Stripe\Stripe();
        $this->stripeService->setVerifySslCerts(false);
        $this->stripeService->setApiKey($this->apiKey);
    }

    public function addCustomer($customerDetailsAry)
    {

        $customer = new Customer();

        $customerDetails = $customer->create($customerDetailsAry);

        return $customerDetails;
    }

    public function chargeAmountFromCard($cardDetails)
    {
        $customerDetailsAry = array(
            'email' => $cardDetails['email'],
            'source' => $cardDetails['token']
        );
        
        $customerResult = $this->addCustomer($customerDetailsAry);
        $charge = new Charge();
        $cardDetailsAry = array(
            'customer' => $customerResult->id,
            'amount' => $cardDetails['amount'] ,
            'currency' => $cardDetails['currency_code'],
            'description' => $cardDetails['item_name'],
            'metadata' => array(
                'order_id' => $cardDetails['item_number']

            )
        );
        $result = $charge->create($cardDetailsAry);

        return $result->jsonSerialize();
    }

    public function addCard($card)
    {
        $stripe = new \Stripe\StripeClient($this->apiKeyPublic);
        try{
            $res = $stripe->paymentMethods->create([
                'type' => 'card',
                'card' => [
                    'number' => $card['cardNumber'],
                    'exp_month' => $card['month'],
                    'exp_year' => $card['year'],
                    'cvc' => $card['cvv'],
                ]
            ]);
            return [true, $res->id];
        }
        catch (\Exception $e){
            return [false, $e->getMessage()];
        }
    }
}