<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Unicodeveloper\Paystack\Facades\Paystack;

class PaymentController extends Controller
{
    /**
     * Redirect the User to Paystack Payment Page
     * 
     */
    public function redirectToGateway(Request $request)
    {
        $metadata = json_encode(['product_name' => 'Niccompop',]);
        $userData = [
            "amount" => intval($request->amount),
            "reference" => Paystack::genTranxRef(),
            "email" => 'Olaoluwavincent@gmail.com',
            // "email" => $request->user()->email,
            // "first_name" => $request->user()->fullname,
            // "last_name" => $request->user()->username,
            "metadata" => $metadata,
        ];
        try {
            // dd(Paystack::getAuthorizationUrl($userData));
            return Paystack::getAuthorizationUrl($userData)->redirectNow();
            // return Redirect::back()->withMessage(['status' => $authorizationUrl->url]);
            // return Redirect::route('cart')->with('status', $authorizationUrl->url);
        } catch (\Exception $e) {
            dd('Error', $e);
            return Redirect::back()->withMessage(['msg' => 'The paystack token has expired. Please refresh the page and try again.', 'type' => 'error']);
        }
    }

    /**
     * Obtain Paystack payment information
     * @return void
     */
    public function handleGatewayCallback()
    {
        $paymentDetails = Paystack::getPaymentData();

        dd($paymentDetails);
        // Now you have the payment details,
        // you can store the authorization_code in your db to allow for recurrent subscriptions
        // you can then redirect or do whatever you want
    }
}
