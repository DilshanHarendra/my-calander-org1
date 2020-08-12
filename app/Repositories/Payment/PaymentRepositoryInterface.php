<?php


namespace App\Repositories\Payment;


interface PaymentRepositoryInterface
{
    public function getAllPayments($accountId);

    public function createPayment($accountId, $request);

    public function updatePayment($accountId, $request);

    public function deletePayment($accountId, $id);

}
