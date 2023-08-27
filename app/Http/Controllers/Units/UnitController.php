<?php

namespace App\Http\Controllers\Units;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\UnitRepository;
use App\Http\Requests\UnitRequest;
use OpenApi\Annotations as OA; 
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class UnitController extends Controller
{
    use ResponseTrait;

    public function __construct(UnitRepository $unitRepository)
    {
        $this->middleware('auth:api', ['except' => ['indexAll']]);
        $this->unitRepository = $unitRepository;
    }


        /**
     * @OA\Get(
     *     path="/v1/public/api/units",
     *     tags={"Units"},
     *     summary="Get Unit List",
     *     description="Get Unit List as Array",
     *     operationId="UnitIndex",
     *     security={{"bearer":{}}},
     *     @OA\Response(response=200,description="Get Unit List as Array"),
     *     @OA\Response(response=400, description="Bad request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function UnitIndex(): JsonResponse
    {
        try {
            $data = $this->unitRepository->getAll();
            return $this->responseSuccess($data, 'Unit List Fetch Successfully !');
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

        /**
     * @OA\Get(
     *     path="/v1/public/api/units/{id}",
     *     tags={"Units"},
     *     summary="Show Unit Details",
     *     description="Show Unit Details",
     *     operationId="showUnit",
     *     security={{"bearer":{}}},
     *     @OA\Parameter(name="id", description="id, eg; 1", required=true, in="path", @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Show Unit Details"),
     *     @OA\Response(response=400, description="Bad request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function show($id): JsonResponse
    {
        try {
            $data = $this->unitRepository->getByID($id);
            if (is_null($data)) {
                return $this->responseError(null, 'Unit Not Found', Response::HTTP_NOT_FOUND);
            }

            return $this->responseSuccess($data, 'Unit Details Fetch Successfully !');
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\Get(
     *     path="/v1/public/api/units/by-course/{course_id}",
     *     tags={"Units"},
     *     summary="Get Units by Course ID",
     *     description="Get list of units associated with a specific course",
     *     operationId="getUnitsByCourseID",
     *     security={{"bearer":{}}},
     *     @OA\Parameter(name="course_id", description="ID of the course", required=true, in="path", @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Units for the specified Course ID"),
     *     @OA\Response(response=400, description="Bad request"),
     *     @OA\Response(response=404, description="No units found for the specified Course ID"),
     *     @OA\Response(response=500, description="Internal Server Error")
     * )
     */

    public function getUnitByCourseID($course_id): JsonResponse
        {
            try {
                $units = $this->unitRepository->getUnitsByCourseID($course_id);
                
                if ($units->isEmpty()) {
                    return $this->responseError(null, 'No Units Found for the given Course ID', Response::HTTP_NOT_FOUND);
                }

                return $this->responseSuccess($units, 'Units for Course ID ' . $course_id . ' Fetched Successfully !');
            } catch (\Exception $e) {
                return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }

 /**
     * @OA\Get(
     *     path="/v1/public/api/units/view/all",
     *     tags={"Units"},
     *     summary="All Units - Publicly Accessible",
     *     description="All Units - Publicly Accessible",
     *     operationId="indexAll",
     *     @OA\Parameter(name="perPage", description="perPage, eg; 20", example=20, in="query", @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="All Units - Publicly Accessible" ),
     *     @OA\Response(response=400, description="Bad request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function indexAll(Request $request): JsonResponse
    {
        try {
            $data = $this->unitRepository->getPaginatedData($request->perPage);
            return $this->responseSuccess($data, 'Course List Fetched Successfully !');
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    
}
