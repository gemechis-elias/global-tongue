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
     * @OA\Get(
     *     path="/v1/public/api/progress/{user_id}",
     *     tags={"Progress"},
     *     summary="Show Progress Details",
     *     description="Show Progress Details",
     *     operationId="Progressshow",
     *     security={{"bearer":{}}},
     *     @OA\Parameter(name="id", description="id, eg; 1", required=true, in="path", @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Show Progress Details"),
     *     @OA\Response(response=400, description="Bad request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function getProgress($userId): JsonResponse
    {
        try {
        // Retrieve the user's progress from the database
        $userProgress = Progress::where('user_id', $userId)->get();

        // Retrieve the user's enrolled courses (parse JSON from my_courses)
        $user = User::find($userId);
        $enrolledCourses = json_decode($user->my_courses);

        // Retrieve all lessons associated with enrolled courses
        $allLessons = Lesson::whereIn('course_id', $enrolledCourses)->get();

        // Filter completed lessons based on user's progress
        $completedLessons = $userProgress->filter(function ($progress) {
            return $progress->completed;
        });

        // Implement logic for pending payments

        // Construct the response data
        $progressData = [
            'all_lessons' => $allLessons,
            'completed_lessons' => $completedLessons,
            'enrolled_courses' => $enrolledCourses,
            'pending_payment' => ""
        ];

        
        if (is_null(response()->json($progressData))) {
            return $this->responseError(null, 'Progress Not Found', Response::HTTP_NOT_FOUND);
        }

        return $this->responseSuccess(response()->json($progressData), 'Progress Details Fetch Successfully !');
    }
    catch (\Exception $e) {
        return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}

}

?>