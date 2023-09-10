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

    public  $unitRepository;
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
    public function index(): JsonResponse
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
     * @OA\Post(
     *     path="/v1/public/api/Units",
     *     tags={"Units"},
     *     summary="Create New Unit",
     *     description="Create New Unit",
     *     operationId="storeUnit",
     *     @OA\RequestBody(
     *          @OA\JsonContent(
     *              type="object",
     *             @OA\Property(property="course_id", type="integer", example="1"),
     *             @OA\Property(property="level_id", type="integer", example="1"),
     *             @OA\Property(property="unit_name", type="string", example="Unit 5"),
     *             @OA\Property(property="unit_title", type="string", example="Let's Talk About You"),
     *             @OA\Property(property="unit_description", type="string", example="Explore subject pronouns, professions "),
     *             @OA\Property(property="unit_image", type="string", example="https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.gsoschool.com%2Fen%2Fthe-importance-of-learning-english%2F&psig=AOvVaw2MD-qQVFugibI_Wd0Ggrxi&ust=1694452866329000&source=images&cd=vfe&opi=89978449&ved=0CBAQjRxqFwoTCJDLy_zGoIEDFQAAAAAdAAAAABAE"),
     *             @OA\Property(property="no_of_lessons", type="string", example="5"),
     *          ),
     *      ),
     *      security={{"bearer":{}}},
     *      @OA\Response(response=200, description="Create New Unit" ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function store(UnitRequest $request): JsonResponse
    {
        try {
            $unit = $this->unitRepository->create($request->all());
            return $this->responseSuccess($unit, 'New Unit Created Successfully !');
        } catch (\Exception $exception) {
            return $this->responseError(null, $exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }



    /**
     * @OA\Get(
     *     path="/v1/public/api/units/by/{course_id}/{level_id}",
     *     tags={"Units"},
     *     summary="Get Units by Parents ID",
     *     description="Get list of units associated with a specific course",
     *     operationId="getUnitsByCourseID",
     *     security={{"bearer":{}}},
     *     @OA\Parameter(name="course_id", description="ID of the course", required=true, in="path", @OA\Schema(type="integer")),
     *     @OA\Parameter(name="level_id", description="ID of the level", required=true, in="path", @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Units for the specified Parents ID"),
     *     @OA\Response(response=400, description="Bad request"),
     *     @OA\Response(response=404, description="No units found for the specified Parents ID"),
     *     @OA\Response(response=500, description="Internal Server Error")
     * )
     */

    public function getUnitsByCourseID ($course_id, $level_id): JsonResponse
        {
            try {
                $units = $this->unitRepository->getUnitsByCourseID($course_id, $level_id);
                
                if ($units->isEmpty()) {
                    return $this->responseError(null, 'No Units Found for the given Course ID & Level ID', Response::HTTP_NOT_FOUND);
                }

                return $this->responseSuccess($units, 'Units for Course ID ' . $course_id . 'and' . $level_id .' Fetched Successfully !');
            } catch (\Exception $e) {
                return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }

 
 
    
}
