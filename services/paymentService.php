<?php

require_once __DIR__ . '/../repositories/PaymentRepository.php';
require_once __DIR__ . '/MpesaService.php';


class PaymentService
{

    private PaymentRepository $paymentRepo;

    private MpesaService $mpesa;



    public function __construct($conn)
    {

        $this->paymentRepo = new PaymentRepository($conn);

        $this->mpesa = new MpesaService();

    }



    public function processPayment(int $paymentId): array
    {


        $payment = $this->paymentRepo->getById($paymentId);



        if (!$payment) {

            return [

                "success" => false,

                "message" => "Payment not found"

            ];

        }



        $response = $this->mpesa->pay($payment);
        
        /* hii ni code ya debug kuangalia kama mock server ina shida inawekwa hapa chini responsec
         ya kuangalia kama response inarudi vizuri na data ya payment ipo sawa na ile ya mock server. Hii itasaidia kuona kama tatizo ni kwenye mock server au kwenye code yetu.
        
        echo "<pre>";

        echo "PAYMENT DATA:\n";
        print_r($payment);

        echo "\nMPESA RESPONSE:\n";
        print_r($response);

        echo "</pre>";

        exit;*/
        



        if(!empty($response['success']) && $response['success'] === true) {



            $this->paymentRepo->updateStatus(

                $paymentId,

                'paid'

            );

            $this->paymentRepo->updateTransactionId(

                $paymentId,

                $response['transaction_id']
            );



            return [

                "success" => true,

                "message" => "Payment successful",
                "transaction_id" => $response['transaction_id'] ?? null

            ];

        }



        return [

            "success" => false,

            "message" => $response['message'] ?? 'Payment failed'

        ];


    }


}