<?php

class PaymentRepository
{
    private mysqli $conn;


    public function __construct(mysqli $conn)
    {
        $this->conn = $conn;
    }



    /**
     * Get payment by appointment ID
     */
    public function getByAppointmentId(int $appointmentId)
    {

        $sql = "
            SELECT *
            FROM payments
            WHERE appointment_id = ?
            LIMIT 1
        ";


        $stmt = $this->conn->prepare($sql);


        $stmt->bind_param(
            "i",
            $appointmentId
        );


        $stmt->execute();


        $result = $stmt->get_result();


        return $result->fetch_assoc();

    }





    /**
     * Create payment
     */
    public function create(array $data)
    {


        $sql = "
            INSERT INTO payments
            (
                appointment_id,
                amount,
                payment_method,
                payment_status,
                transaction_id
            )
            VALUES
            (
                ?,
                ?,
                ?,
                ?,
                ?
            )
        ";



        $stmt = $this->conn->prepare($sql);



        $stmt->bind_param(

            "idsss",

            $data['appointment_id'],
            $data['amount'],
            $data['payment_method'],
            $data['payment_status'],
            $data['transaction_id']

        );



        return $stmt->execute();

    }






    /**
     * Update payment status
     */
    public function updateStatus(int $appointmentId, string $status)
    {


        $sql = "
            UPDATE payments
            SET payment_status = ?
            WHERE appointment_id = ?
        ";



        $stmt = $this->conn->prepare($sql);



        $stmt->bind_param(

            "si",

            $status,
            $appointmentId

        );



        return $stmt->execute();

    }


}