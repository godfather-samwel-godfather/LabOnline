<?php

require_once __DIR__ . '/MobileMoneyService.php';


class MpesaService implements MobileMoneyService
{

    private string $apiUrl = "https://d8f263d2-6ac0-4384-8a9f-a59954a45948.mock.pstmn.io/mpesa/pay";



    public function pay(array $payment): array
    {

        $data = [

            "payment_id" => $payment['id'],

            "amount" => $payment['amount']

        ];



        $ch = curl_init($this->apiUrl);



        curl_setopt($ch, CURLOPT_POST, true);



        curl_setopt(
            $ch,
            CURLOPT_POSTFIELDS,
            json_encode($data)
        );



        curl_setopt($ch, CURLOPT_HTTPHEADER, [

            "Content-Type: application/json"

        ]);



        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);



        $response = curl_exec($ch);



        curl_close($ch);



        if (!$response) {


            return [

                "success" => false,

                "message" => "No response from payment server"

            ];

        }



        return json_decode($response, true);


    }


}