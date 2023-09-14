<?php

namespace App\Http\Controllers\Exercise;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use App\Repositories\ExerciseRepository;
use App\Http\Requests\ExerciseRequest;
use OpenApi\Annotations as OA; 
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
class ExerciseController extends Controller
{
    
        use ResponseTrait;
    /**
     * Exercise Repository class.
     *
     * @var ExerciseRepository
     */
    public $exerciseRepository;

        public function __construct(ExerciseRepository $exerciseRepository)
        {
            
            $this->middleware('auth:api', ['except' => ['indexAll']]);
            $this->exerciseRepository = $exerciseRepository;
        }
    
    
            /**
         * @OA\Get(
         *     path="/v1/public/api/exercises",
         *     tags={"Exercises"},
         *     summary="Get All Exercise List",
         *     description="Get Exercise List as Array",
         *     operationId="ExerciseIndex",
         *     security={{"bearer":{}}},
         *     @OA\Response(response=200,description="Get Exercise List as Array"),
         *     @OA\Response(response=400, description="Bad request"),
         *     @OA\Response(response=404, description="Resource Not Found"),
         * )
         */
        public function index(): JsonResponse
        {
            try {
                $data = $this->exerciseRepository->getAll();
                return $this->responseSuccess($data, 'Exercise List Fetch Successfully !');
            } catch (\Exception $e) {
                return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }
    
            /**
         * @OA\Get(
         *     path="/v1/public/api/exercises/{id}",
         *     tags={"Exercises"},
         *     summary="Show Exercise Details",
         *     description="Show Exercise Details",
         *     operationId="showExercise",
         *     security={{"bearer":{}}},
         *     @OA\Parameter(name="id", description="id, eg; 1", required=true, in="path", @OA\Schema(type="integer")),
         *     @OA\Response(response=200, description="Show Exercise Details"),
         *     @OA\Response(response=400, description="Bad request"),
         *     @OA\Response(response=404, description="Resource Not Found"),
         * )
         */
        public function show($id): JsonResponse
        {
            try {
                $data = $this->exerciseRepository->getByID($id);
                if (is_null($data)) {
                    return $this->responseError(null, 'Exercise Not Found', Response::HTTP_NOT_FOUND);
                }
    
                return $this->responseSuccess($data, 'Exercise Details Fetch Successfully !');
            } catch (\Exception $e) {
                return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }
    
       /**
         * @OA\Get(
         *     path="/v1/public/api/exercises/by/{course_id}/{level_id}/{unit_id}/{lesson_id}",
         *     tags={"Exercises"},
         *     summary="Get Exercises by Parents",
         *     description="Get list of exercises associated with a specific Parents",
         *     operationId="getExercisesByLessonID",
         *     security={{"bearer":{}}},
         *     @OA\Parameter(name="course_id", description="ID of the course", required=true, in="path", @OA\Schema(type="integer")),
         *    @OA\Parameter(name="level_id", description="ID of the level", required=true, in="path", @OA\Schema(type="integer")),
         *     @OA\Parameter(name="unit_id", description="ID of the unit", required=true, in="path", @OA\Schema(type="integer")),
         *     @OA\Parameter(name="lesson_id", description="ID of the lesson", required=true, in="path", @OA\Schema(type="integer")),
         *     @OA\Response(response=200, description="Exercises for the specified Parents ID"),
         *     @OA\Response(response=400, description="Bad request"),
         *     @OA\Response(response=404, description="No Exercises found for the specified Parents ID"),
         *     @OA\Response(response=500, description="Internal Server Error")
         * )
         */

    
        public function getExercisesByLessonID($course_id,$level_id, $unit_id, $lesson_id): JsonResponse
            {
                try {
                    $exercises = $this->exerciseRepository->getExercisesByLessonID($course_id,$level_id, $unit_id, $lesson_id);
                    
                    if ($exercises->isEmpty()) {
                        return $this->responseError(null, 'No exercises Found for the given Lesson ID', Response::HTTP_NOT_FOUND);
                    }
    
                    return $this->responseSuccess($exercises, 'Exercises for Lesson ID ' . $lesson_id . ' Fetched Successfully !');
                } catch (\Exception $e) {
                    return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
                }
            }
    
 

       /**
 * @OA\Post(
 *     path="/v1/public/api/exercises",
 *     tags={"Exercises"},
 *     summary="Create New Exercise",
 *     description="Create New Exercise",
 *     operationId="storeExercise",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="course_id", type="integer", example=1),
 *             @OA\Property(property="unit_id", type="integer", example=1),
 *             @OA\Property(property="level_id", type="integer", example=1),
 *             @OA\Property(property="lesson_id", type="integer", example=1),
 *             @OA\Property(property="exercise_type", type="string", example="Type A"),
 *             @OA\Property(property="instruction", type="string", example="Instructions here"),
 *             @OA\Property(property="question", type="string", example="Question here"),
 *             @OA\Property(property="image", type="string", example="exercise_image.jpg"),
 *             @OA\Property(property="voice", type="string", example="exercise_voice.mp3"),
 *             @OA\Property(property="choices", type="string", example="Choice 1, Choice 2"),
 *             @OA\Property(property="incorrect_hint", type="string", example="Incorrect hint here"),
 *             @OA\Property(property="correct_answer", type="integer", example=1),
 *         ),
 *     ),
 *     security={{"bearer":{}}},
 *     @OA\Response(response=200, description="Create New Exercise"),
 *     @OA\Response(response=400, description="Bad request"),
 *     @OA\Response(response=404, description="Resource Not Found"),
 * )
 */
public function store(ExerciseRequest $request): JsonResponse
{
    try {
        $exercise = $this->exerciseRepository->create($request->all());
        return $this->responseSuccess($exercise, 'New Exercise Created Successfully !');
    } catch (\Exception $exception) {
        return $this->responseError(null, $exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}

/**
 * @OA\Put(
 *     path="/v1/public/api/exercises/{id}",
 *     tags={"Exercises"},
 *     summary="Update Exercise",
 *     description="Update Exercise",
 *     operationId="updateExercise",
 *     @OA\Parameter(name="id", description="id, eg; 1", required=true, in="path", @OA\Schema(type="integer")),
 * 
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="course_id", type="integer", example=1),
 *             @OA\Property(property="unit_id", type="integer", example=1),
 *             @OA\Property(property="level_id", type="integer", example=1),
 *             @OA\Property(property="lesson_id", type="integer", example=1),
 *             @OA\Property(property="exercise_type", type="string", example="Type A"),
 *             @OA\Property(property="instruction", type="string", example="Instructions here"),
 *             @OA\Property(property="question", type="string", example="Question here"),
 *             @OA\Property(property="image", type="string", example="exercise_image.jpg"),
 *             @OA\Property(property="voice", type="string", example="exercise_voice.mp3"),
 *             @OA\Property(property="choices", type="string", example="Choice 1, Choice 2"),
 *             @OA\Property(property="incorrect_hint", type="string", example="Incorrect hint here"),
 *             @OA\Property(property="correct_answer", type="integer", example=1),
 *         ),
 *     ),
 *     security={{"bearer":{}}},
 *     @OA\Response(response=200, description="Update Exercise"),
 *     @OA\Response(response=400, description="Bad request"),
 *     @OA\Response(response=404, description="Resource Not Found"),
 * )
 */
public function update(ExerciseRequest $request, $id): JsonResponse
{
    try {
        $data = $this->exerciseRepository->update($id, $request->all());
        if (is_null($data))
            return $this->responseError(null, 'Exercise Not Found', Response::HTTP_NOT_FOUND);

        return $this->responseSuccess($data, 'Exercise Updated Successfully !');
    } catch (\Exception $e) {
        return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}

    /**
     * @OA\Delete(
     *     path="/v1/public/api/exercises/{id}",
     *     tags={"Exercises"},
     *     summary="Delete Exercises",
     *     description="Delete Exercises",
     *     operationId="destroyExercises",
     *     security={{"bearer":{}}},
     *     @OA\Parameter(name="id", description="id, eg; 1", required=true, in="path", @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Delete Exercises"),
     *     @OA\Response(response=400, description="Bad request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function destroy($id): JsonResponse
    {
        try {
            $exercise =  $this->exerciseRepository->getByID($id);
            if (empty($exercise)) {
                return $this->responseError(null, 'Exercise Not Found', Response::HTTP_NOT_FOUND);
            }

            $deleted = $this->exerciseRepository->delete($id);
            if (!$deleted) {
                return $this->responseError(null, 'Failed to delete the exercise.', Response::HTTP_INTERNAL_SERVER_ERROR);
            }

            return $this->responseSuccess($exercise, 'Exercise Deleted Successfully !');
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

}
    