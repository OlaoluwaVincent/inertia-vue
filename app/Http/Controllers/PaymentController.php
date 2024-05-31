<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Enrollment;
use App\Class\PaystackData;
use App\Enums\CurrencyEnum;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Mail\PurchaseMail;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Unicodeveloper\Paystack\Facades\Paystack;

class PaymentController extends Controller
{
    /**
     * Redirect the User to Paystack Payment Page
     * 
     */
    public function redirectToGateway(Request $request)
    {
        $transactionData = [
            "amount" => floatval($request->amount) * CurrencyEnum::TO_DOLLAR,
            "reference" => PaystackData::genTranxRef(),
            "email" => $request->user()->email,
            "metadata" => $request->metadata,
        ];
        try {
            //Generate Payment Url
            PaystackData::getAuthorizationUrl($transactionData);

            return Inertia::location(PaystackData::authorizationUrl());
        } catch (\Exception $e) {
            dd('Error', $e);
            return Redirect::back()->withMessage(['msg' => 'The paystack token has expired. Please refresh the page and try again.', 'type' => 'error']);
        }
    }


    public function handleGatewayCallback()
    {
        // Set transaction data (make sure this sets PaystackData::$email)
        PaystackData::setTransactionData();

        // Retrieve the user by email
        $user = User::where('email', PaystackData::$email)->firstOrFail();

        DB::transaction(function () use ($user) {
            // Create transaction record
            Transaction::create([
                'user_id' => $user->id,
                'amount' => PaystackData::extractAmount(),
                'transaction_ref' => PaystackData::extractTransactionRef(),
                'status' => PaystackData::extractStatus(),
                'customer_id' => PaystackData::extractCustomerId(),
                'transaction_id' => PaystackData::extractTransactionId(),
                'channel' => PaystackData::extractChannel(),
            ]);

            // Enroll user in each course
            foreach (PaystackData::extractMetadata() as $courseId) {
                Enrollment::create([
                    'user_id' => $user->id,
                    'course_id' => intval($courseId['id']),
                ]);
            }
        });

        Mail::to($user->email)->send(new PurchaseMail($user, PaystackData::extractMetadata(), PaystackData::extractAmount()));


        return Redirect::to(config('app.url') . '/my-courses?redirect_from=payment');
    }
}
