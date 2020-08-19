<?php

namespace App\Http\Controllers\Api\V1\Tenant;

use App\Http\Controllers\Api\V1\ApiController;
use App\Http\Controllers\Controller;
use App\Repositories\Subscription\SubscriptionRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SubscriptionsController extends ApiController
{

    private $repository;

    public function __construct(SubscriptionRepositoryInterface $repository)
    {
        $this->middleware('auth:api');
        $this->repository = $repository;
    }

    /**
     * @return JsonResponse
     */
    public function index()
    {
        $account = current_tenant();
        $methods = $this->repository->getAllPayments($account->id);
        return response()->json($methods);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $account = current_tenant();
        $this->repository->createPayment($account->id, $request);
        return response()->json(null, 204);
    }


    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function update(Request $request)
    {
        $account = current_tenant();

        $this->repository->updatePayment($account->id, $request);

        return response()->json([
            'subscription_updated' => true
        ]);
    }


    /**
     * @param $id
     * @return JsonResponse
     */
    public function destory($id)
    {
        $account = current_tenant();
        $this->repository->deletePayment($account->id, $id);
        return response()->json(null, 204);
    }
}
