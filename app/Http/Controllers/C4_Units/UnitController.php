<?php

namespace App\Http\Controllers\C4_Units;

use App\Http\Controllers\Controller;
use App\Models\Conversation;
use App\Models\Exercise;
use App\Models\Lesson;
use App\Models\Tips;
use App\Models\User;
use Illuminate\Http\Request;
use App\Repositories\UnitRepository;
use App\Http\Requests\UnitRequest;
use Illuminate\Support\Facades\Auth;
use OpenApi\Annotations as OA; 
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class UnitController extends Controller
{
    use ResponseTrait;

    public  $unitRepository;
        /**
     * Authenticated User Instance.
     *
     * @var User
     */
    public User | null $user;

    public function __construct(UnitRepository $unitRepository)
    {
        $this->middleware('auth:api', ['except' => ['indexAll']]);
        $this->unitRepository = $unitRepository;
        $this->user = Auth::guard()->user();
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
            // Retrieve the current unit
            $unit = $this->unitRepository->getByID($id);
            if (is_null($unit)) {
                return $this->responseError(null, 'Unit Not Found', Response::HTTP_NOT_FOUND);
            }
    
            // Retrieve the user's completed items
            $user = $this->user; 
            $completedLessons = json_decode($user->completed_lessons) ?? [];
            $completedExercises = json_decode($user->completed_exercises) ?? [];
            $completedTips = json_decode($user->completed_tips) ?? [];
            $completedConversations = json_decode($user->completed_conversation) ?? [];
             
            $totalLessons = Lesson::where('unit_id', $unit->id)->count();
            $totalExercises = Exercise::where('unit_id', $unit->id)->count();
            $totalTips = Tips::where('unit_id', $unit->id)->count();
            $totalConversations = Conversation::where('unit_id', $unit->id)->count();
    
 
            $totalCoveragePercentage = (
              
                (count($completedLessons) / $totalLessons) +
                (count($completedExercises) / $totalExercises) +
                (count($completedTips) / $totalTips) +
                (count($completedConversations) / $totalConversations)
            ) / 5 * 100; // Divide by the number of item types and multiply by 100 to get the percentage

    
            $totalCoverage = [
                 
                'completed_lessons' => count($completedLessons) . "/" . $totalLessons,
                'completed_exercises' => count($completedExercises) . "/" . $totalExercises,
                'completed_tips' => count($completedTips) . "/" . $totalTips,
                'completed_conversation' => count($completedConversations) . "/" . $totalConversations,
            ];
    

            // Construct the response data
            $data = [
                'unit' => $unit,
                'total_coverage' => $totalCoveragePercentage,
                'unit_detail' => $totalCoverage,
            ];
    
            return $this->responseSuccess($data, 'Unit Details Fetch Successfully !');
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    

        /**
     * @OA\Post(
     *     path="/v1/public/api/units",
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
     *             @OA\Property(property="image", type="string", example=""),
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
     * @OA\Put(
     *     path="/v1/public/api/Units/{id}",
     *     tags={"Units"},
     *     summary="Update Unit",
     *     description="Update Unit",
     *     operationId="updateUnit",
     *     @OA\RequestBody(
     *          @OA\JsonContent(
     *              type="object",
     *             @OA\Property(property="course_id", type="integer", example="1"),
     *             @OA\Property(property="level_id", type="integer", example="1"),
     *             @OA\Property(property="unit_name", type="string", example="Unit 5"),
     *             @OA\Property(property="unit_title", type="string", example="Let's Talk About You"),
     *             @OA\Property(property="unit_description", type="string", example="Explore subject pronouns, professions "),
     *             @OA\Property(property="image", type="string", example=""),
     *          ),
     *      ),
     *      security={{"bearer":{}}},
     *      @OA\Response(response=200, description="Update Unit" ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function update(UnitRequest $request, $id): JsonResponse
{
    try {
        $data = $this->unitRepository->update($id, $request->all());
        if (is_null($data))
            return $this->responseError(null, 'Unit Not Found', Response::HTTP_NOT_FOUND);

        return $this->responseSuccess($data, 'Unit Updated Successfully !');
    } catch (\Exception $e) {
        return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
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

  /**
     * @OA\Delete(
     *     path="/v1/public/api/units/{id}",
     *     tags={"Units"},
     *     summary="Delete Units",
     *     description="Delete Units",
     *     operationId="destroyUnits",
     *     security={{"bearer":{}}},
     *     @OA\Parameter(name="id", description="id, eg; 1", required=true, in="path", @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Delete Units"),
     *     @OA\Response(response=400, description="Bad request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function destroy($id): JsonResponse
    {
        try {
            $unit =  $this->unitRepository->getByID($id);
            if (empty($unit)) {
                return $this->responseError(null, 'Unit Not Found', Response::HTTP_NOT_FOUND);
            }

            $deleted = $this->unitRepository->delete($id);
            if (!$deleted) {
                return $this->responseError(null, 'Failed to delete the Unit.', Response::HTTP_INTERNAL_SERVER_ERROR);
            }

            return $this->responseSuccess($unit, 'Unit Deleted Successfully !');
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
 
    
}
