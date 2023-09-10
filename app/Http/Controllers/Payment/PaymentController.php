<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Repositories\PaymentRepository;
use Illuminate\Http\Request;
use App\Http\Requests\PaymentRequest;
use OpenApi\Annotations as OA; 
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;



class PaymentsController extends Controller
{
    use ResponseTrait;
       /**
     * Exercise Repository class.
     *
     * @var PaymentRepository
     */
    public  $paymentRepository;

    public function __construct(PaymentRepository $paymentRepository)
    {
        $this->middleware('auth:api', ['except' => ['indexAll']]);
        $this->paymentRepository = $paymentRepository;
    }

    /**
     * @OA\Get(
     *     path="/v1/public/api/payments",
     *     tags={"Payments"},
     *     summary="Get Payment List",
     *     description="Get Payment List as Array",
     *     operationId="index",
     *     security={{"bearer":{}}},
     *     @OA\Response(response=200,description="Get Payment List as Array"),
     *     @OA\Response(response=400, description="Bad request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function index(): JsonResponse
    {
        try {
            $data = $this->paymentRepository->getAll();
            return $this->responseSuccess($data, 'Payment List Fetch Successfully !');
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }



    /**
     * @OA\Get(
     *     path="/v1/public/api/payments/view/search",
     *     tags={"Payments"},
     *     summary="All Payments - Publicly Accessible",
     *     description="Search All Payments - Publicly Accessible",
     *     operationId="search",
     *     @OA\Parameter(name="perPage", description="perPage, eg; 20", example=20, in="query", @OA\Schema(type="integer")),
     *     @OA\Parameter(name="search", description="search, eg; Test", example="Test", in="query", @OA\Schema(type="string")),
     *     @OA\Response(response=200, description="All Payments - Publicly Accessible" ),
     *     @OA\Response(response=400, description="Bad request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function search(Request $request): JsonResponse
    {
        try {
            $data = $this->paymentRepository->searchPayment($request->search, $request->perPage);
            return $this->responseSuccess($data, 'Payment List Fetched Successfully !');
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\Post(
     *     path="/v1/public/api/payments",
     *     tags={"Payments"},
     *     summary="Create New Payment",
     *     description="Create New Payment",
     *     operationId="store",
     *     @OA\RequestBody(
     *          @OA\JsonContent(
     *              type="object",
     *             @OA\Property(property="name", type="string", example="English for Beginner"),
     *             @OA\Property(property="description", type="string", example="Here are the biggest enterprise technology acquisitions of 2021 so far, in reverse chronological order."),
     *             @OA\Property(property="level", type="string", example="Beginner"),
     *             @OA\Property(property="type", type="string", example="free"),
     *             @OA\Property(property="image", type="string", example=""),
     * 
     *          ),
     *      ),
     *      security={{"bearer":{}}},
     *      @OA\Response(response=200, description="Create New Payment" ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function store(PaymentRequest $request): JsonResponse
    {
        try {
            $product = $this->paymentRepository->create($request->all());
            return $this->responseSuccess($product, 'New Payment Created Successfully !');
        } catch (\Exception $exception) {
            return $this->responseError(null, $exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\Get(
     *     path="/v1/public/api/payments/{id}",
     *     tags={"Payments"},
     *     summary="Show Payment Details",
     *     description="Show Payment Details",
     *     operationId="show",
     *     security={{"bearer":{}}},
     *     @OA\Parameter(name="id", description="id, eg; 1", required=true, in="path", @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Show Payment Details"),
     *     @OA\Response(response=400, description="Bad request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function show($id): JsonResponse
    {
        try {
            $data = $this->paymentRepository->getByID($id);
            if (is_null($data)) {
                return $this->responseError(null, 'Payment Not Found', Response::HTTP_NOT_FOUND);
            }

            return $this->responseSuccess($data, 'Payment Details Fetch Successfully !');
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\Put(
     *     path="/v1/public/api/payments/{id}",
     *     tags={"Payments"},
     *     summary="Update Payment",
     *     description="Update Payment",
     *     @OA\Parameter(name="id", description="id, eg; 1", required=true, in="path", @OA\Schema(type="integer")),
     *     @OA\RequestBody(
     *          @OA\JsonContent(
     *              type="object",
     *             @OA\Property(property="name", type="string", example="English for Beginner"),
     *             @OA\Property(property="description", type="string", example="Here are the biggest enterprise technology acquisitions of 2021 so far, in reverse chronological order."),
     *             @OA\Property(property="level", type="string", example="Beginner"),
     *             @OA\Property(property="type", type="string", example="free"),
     *             @OA\Property(property="image", type="string", example=""),
     * 
     *          ),
     *      ),
     *     operationId="update",
     *     security={{"bearer":{}}},
     *     @OA\Response(response=200, description="Update Payment"),
     *     @OA\Response(response=400, description="Bad request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function update(PaymentRequest $request, $id): JsonResponse
    {
        try {
            $data = $this->paymentRepository->update($id, $request->all());
            if (is_null($data))
                return $this->responseError(null, 'Payment Not Found', Response::HTTP_NOT_FOUND);

            return $this->responseSuccess($data, 'Payment Updated Successfully !');
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\Delete(
     *     path="/v1/public/api/payments/{id}",
     *     tags={"Payments"},
     *     summary="Delete Payment",
     *     description="Delete Payment",
     *     operationId="destroy",
     *     security={{"bearer":{}}},
     *     @OA\Parameter(name="id", description="id, eg; 1", required=true, in="path", @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Delete Payment"),
     *     @OA\Response(response=400, description="Bad request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function destroy($id): JsonResponse
    {
        try {
            $product =  $this->paymentRepository->getByID($id);
            if (empty($product)) {
                return $this->responseError(null, 'Payment Not Found', Response::HTTP_NOT_FOUND);
            }

            $deleted = $this->paymentRepository->delete($id);
            if (!$deleted) {
                return $this->responseError(null, 'Failed to delete the product.', Response::HTTP_INTERNAL_SERVER_ERROR);
            }

            return $this->responseSuccess($product, 'Payment Deleted Successfully !');
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}