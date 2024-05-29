<?php

namespace App\Class;

use Unicodeveloper\Paystack\Facades\Paystack;

class PaystackData extends Paystack
{
    const NO_DATA = "Payment was not processed";
    const SUCCESS = "success";

    protected static $customer_data;
    protected static $customer_metadata;
    protected static $customer_id;
    protected static $transaction_data;
    protected static $transaction_metadata;
    protected static $transaction_status;
    protected static $transaction_id;
    protected static $transaction_ref;
    protected static $amount;
    protected static $channel;
    public static $email;

    public function __construct()
    {
        parent::__construct();
    }

    public static function setTransactionData()
    {
        $response = self::getPaymentData();
        if (!$response['status']) {
            self::$transaction_data = ["status" => self::NO_DATA];
        } else {
            self::$transaction_data = $response['data'];
            self::$customer_data = self::$transaction_data['customer'];
            self::$customer_metadata = self::$customer_data['metadata'];
            self::$customer_id = self::$customer_data['id'];
            self::$transaction_metadata = self::$transaction_data['metadata'];
            self::$transaction_status = self::$transaction_data['status'];
            self::$transaction_id = self::$transaction_data['id'];
            self::$transaction_ref = self::$transaction_data['reference'];
            self::$amount = self::$transaction_data['amount'];
            self::$channel = self::$transaction_data['channel'];
            self::$email = self::$customer_data['email'];
        }
    }

    public static function extractCustomerData(): array
    {
        return self::$customer_data;
    }

    public static function extractCustomerMetadata(): array
    {
        return self::$customer_metadata;
    }

    public static function extractCustomerId(): int
    {
        return self::$customer_id;
    }

    public static function extractMetadata(): array
    {
        return self::$transaction_metadata;
    }

    public static function extractStatus(): string
    {
        return self::$transaction_status;
    }

    public static function extractTransactionId(): int
    {
        return self::$transaction_id;
    }

    public static function extractTransactionRef(): string
    {
        return self::$transaction_ref;
    }

    public static function extractAmount(): int
    {
        return self::$amount / 100;
    }

    public static function extractChannel(): string
    {
        return self::$channel;
    }
}
