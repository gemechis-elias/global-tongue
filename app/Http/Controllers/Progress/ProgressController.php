<?php

namespace App\Http\Controllers\Progress;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\Progress;
use App\Models\User;
use App\Repositories\ProgressRepository;
use Illuminate\Http\Request;
use App\Http\Requests\ProgressRequest;
use OpenApi\Annotations as OA; 
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ProgressController extends Controller
{
    use ResponseTrait;
   
           /**
     * Progress Repository class.
     *
     * @var ProgressRepository
     */
    public  $progressRepository;

    public function __construct(ProgressRepository $progressRepository)
    {
        $this->middleware('auth:api', ['except' => ['indexAll']]);
        $this->progressRepository = $progressRepository;
    }
     /**
     * @OA\Get(
     *     path="/v1/public/api/progress",
     *     tags={"Progress"},
     *     summary="Get Progress List",
     *     description="Get Progress List as Array",
     *     operationId="Progresssindex",
     *     security={{"bearer":{}}},
     *     @OA\Response(response=200,description="Get Progress List as Array"),
     *     @OA\Response(response=400, description="Bad request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function index(): JsonResponse
    {
        try {
            $data = $this->progressRepository->getAll();
            return $this->responseSuccess($data, 'Progress List Fetch Successfully !');
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


        /**
     * @OA\Get(
     *     path="/v1/public/api/progress/{user_id}",
     *     tags={"Progress"},
     *     summary="Show Progress Details of User",
     *     description="Show Progress Details",
     *     operationId="Progressshow",
     *     security={{"bearer":{}}},
     *     @OA\Parameter(name="user_id", description="user_id, eg; 1", required=true, in="path", @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Show Progress Details"),
     *     @OA\Response(response=400, description="Bad request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * )
     */

     public function show($user_id): JsonResponse
     {
         try {
                $userProgress = $this->progressRepository->getByID(intval($user_id));
                if (is_null($userProgress)) {
                    return $this->responseError(null, 'Progress Not Found', Response::HTTP_NOT_FOUND);
                }
                // Retrieve the user's enrolled courses (parse JSON from my_courses)
                $user = User::find($user_id);
                $enrolledCourses = json_decode($user->my_courses);

                // Retrieve all lessons associated with enrolled courses
                $allLessons = Lesson::whereIn('course_id', $enrolledCourses)->get();

                // Filter completed lessons based on user's progress
                $completedLessonIds = $userProgress->where('completed', 1)->pluck('lesson_id')->toArray();
                $completedLessons = $allLessons->whereIn('id', $completedLessonIds);


                // Implement logic for pending payments

                // Construct the response data
                $data = [
                    'all_lessons' => $allLessons,
                    'completed_lessons' => $completedLessons,
                    'enrolled_courses' => $enrolledCourses,
                    'test' => $userProgress,
                ]; 

             return $this->responseSuccess($data, 'Progress Details Fetch Successfully !');
         } catch (\Exception $e) {
             return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
         }
     }


}

?>