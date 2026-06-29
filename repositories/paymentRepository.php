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
     * Get payment by ID
     */
    public function getById(int $id)
    {

        $sql = "
            SELECT *
            FROM payments
            WHERE id = ?
            LIMIT 1
        ";


        $stmt = $this->conn->prepare($sql);


        $stmt->bind_param(
            "i",
            $id
        );


        $stmt->execute();


        return $stmt->get_result()->fetch_assoc();

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
                reference_payment_id,
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
                ?,
                ?
            )
        ";



        $stmt = $this->conn->prepare($sql);



        $stmt->bind_param(

            "iidsss",

            $data['appointment_id'],
            $data['reference_payment_id'],
            $data['amount'],
            $data['payment_method'],
            $data['payment_status'],
            $data['transaction_id']

        );



        return $stmt->execute();

    }





    /**
     * Update payment status by payment ID
     */
    public function updateStatus(int $paymentId, string $status)
    {


        $sql = "
            UPDATE payments
            SET payment_status = ?
            WHERE id = ?
        ";



        $stmt = $this->conn->prepare($sql);



        $stmt->bind_param(

            "si",

            $status,
            $paymentId

        );



        return $stmt->execute();

    }


    /**this function is used to update the transaction ID of a payment record in the database. It takes two parameters: the payment ID and the new transaction ID. The function prepares an SQL statement to update the transaction ID for the specified payment ID, binds the parameters, and executes the statement. If successful, it returns true; otherwise, it returns false.
 * Update transaction ID
 */
public function updateTransactionId(int $paymentId, string $transactionId)
{

    $sql = "
        UPDATE payments
        SET transaction_id = ?
        WHERE id = ?
    ";


    $stmt = $this->conn->prepare($sql);


    $stmt->bind_param(

        "si",

        $transactionId,
        $paymentId

    );


    return $stmt->execute();

}


}