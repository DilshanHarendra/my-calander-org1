<?php


namespace App\Repositories\Subscription;


use App\Repositories\Account\AccountRepositoryInterface;

class SubscriptionEloquentRepository implements SubscriptionRepositoryInterface
{

    private $accountRepository;

    public function __construct(AccountRepositoryInterface $accountRepository)
    {
        $this->accountRepository = $accountRepository;
    }

    /**
     * @param $accountId
     * @return array
     */
    public function getAllPayments($accountId)
    {
        $account = $this->accountRepository->getDataById($accountId);
        $methods = [];
        if ($account->hasPaymentMethod()) {
            foreach ($account->paymentMethods() as $method) {
                $methods[] = [
                    'id' => $method->id,
                    'brand' => $method->card->brand,
                    'last_four' => $method->card->last4,
                    'exp_month' => $method->card->exp_month,
                    'exp_year' => $method->card->exp_year,
                ];
            }
        }
        return $methods;
    }

    /**
     * @param $accountId
     * @param $request
     * @return bool
     */
    public function createPayment($accountId, $request)
    {
        $account = $this->accountRepository->getDataById($accountId);
        $paymentMethodID = $request['payment_method'];

        if ($account->stripe_id === null) {
            $account->createAsStripeCustomer();
        }

        $account->addPaymentMethod($paymentMethodID);
        $account->updateDefaultPaymentMethod($paymentMethodID);

        return true;
    }

    /**
     * @param $accountId
     * @param $id
     * @return bool
     */
    public function deletePayment($accountId, $id)
    {
        $account = $this->accountRepository->getDataById($accountId);

        $paymentMethods = $account->paymentMethods();

        foreach ($paymentMethods as $method) {
            if ($method->id === $id) {
                $method->delete();
                break;
            }
        }

        return true;

    }

    public function updatePayment($accountId, $request)
    {
        $account = $this->accountRepository->getDataById($accountId);

        $planID = $request['plan'];
        $paymentID = $request['payment'];

        if ($account->subscribed('Super Notes')) {
            $account->newSubscription('Super Notes', $planID)
                ->create($paymentID);
        } else {
            $account->subscription('Super Notes')->swap($planID);
        }

        return true;
    }
}
