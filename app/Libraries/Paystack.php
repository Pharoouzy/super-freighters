<?php

namespace App\Libraries;

use Illuminate\Support\Facades\Http;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Client\ConnectionException;


/**
 * Class Paystack
 * @package App\Libraries
 */
class Paystack {

    private $header, $http, $key;

    public function __construct() {

        $this->env = config('settings.paystack_env') ?? config('paystack.paystack_env');

        $this->key = ($this->env === 'test') ?
            config('paystack.test.secret_key') :
            config('paystack.live.secret_key');

        $this->header = [
            'Authorization' => 'Bearer ' . $this->key,
            'Content-Type' => 'application/json',
            'Cache-Control' => 'no-cache'
        ];

        $this->http = Http::withHeaders($this->header);
    }

    /**
     * @param $data
     * @return \Illuminate\Http\Client\Response|\Illuminate\Http\RedirectResponse|mixed
     */
    public function initialize($data) {

        try {
            $response = json_decode($this->http->post(config('paystack.initialize_url'), [
                'amount' => $data['amount'] * 100,
                'email' => $data['email'],
                'currency' => 'NGN',
                'reference' => $data['transaction_ref'],
                'callback_url' => route('payment.verify'),
                'metadata' => [
                    'transaction_ref' => $data['transaction_ref'],
                    'mode' => $this->env,
                ],
                'ref' => $data['transaction_ref'],
            ])->getBody(), true);

            return $response;

        } catch(ConnectionException $e) {
            return ['status' => false, 'message' => $e->getMessage()];
        } catch(ClientException $e) {
            return ['status' => false, 'message' => $e->getMessage()];
        }

    }

    /**
     * @param $reference
     * @return \Illuminate\Http\Client\Response|\Illuminate\Http\RedirectResponse|mixed
     */
    public function verify($reference) {

        try {

            $response = json_decode($this->http->get(config('paystack.verify_url') . $reference)->getBody(), true);

            return $response;

        } catch(ConnectionException $e) {
            return ['status' => false, 'message' => $e->getMessage()];
        } catch(ClientException $e) {
            return ['status' => false, 'message' => $e->getMessage()];
        }

    }
}
