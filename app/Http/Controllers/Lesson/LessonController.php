<?php

namespace App\Http\Controllers\Lesson;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Repositories\LessonRepository;
use App\Http\Requests\LessonRequest;
use OpenApi\Annotations as OA; 
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class LessonController extends Controller
{
    use ResponseTrait;
 /**
     * Lesson Repository class.
     *
     * @var LessonRepository
     */
    public $lessonRepository;
    public function __construct(LessonRepository $lessonRepository)
    {
        $this->middleware('auth:api', ['except' => ['indexAll']]);
        $this->lessonRepository = $lessonRepository;
    }


        /**
     * @OA\Get(
     *     path="/v1/public/api/lessons",
     *     tags={"Lessons"},
     *     summary="Get All Lesson List",
     *     description="Get Lesson List as Array",
     *     operationId="LessonIndex",
     *     security={{"bearer":{}}},
     *     @OA\Response(response=200,description="Get Lesson List as Array"),
     *     @OA\Response(response=400, description="Bad request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function index(): JsonResponse
    {
        try {
            $data = $this->lessonRepository->getAll();
            return $this->responseSuccess($data, 'Lesson List Fetch Successfully !');
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

        /**
     * @OA\Get(
     *     path="/v1/public/api/lessons/{id}",
     *     tags={"Lessons"},
     *     summary="Show Lesson Details",
     *     description="Show Lesson Details",
     *     operationId="showLesson",
     *     security={{"bearer":{}}},
     *     @OA\Parameter(name="id", description="id, eg; 1", required=true, in="path", @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Show Lesson Details"),
     *     @OA\Response(response=400, description="Bad request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function show($id): JsonResponse
    {
        try {
            $data = $this->lessonRepository->getByID($id);
            if (is_null($data)) {
                return $this->responseError(null, 'Lesson Not Found', Response::HTTP_NOT_FOUND);
            }

            return $this->responseSuccess($data, 'Lesson Details Fetch Successfully !');
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
        /**
     * @OA\Get(
     *     path="/v1/public/api/lessons/getContent/{lesson_id}",
     *     tags={"All Content of Lesson"},
     *     summary="Show Lesson Details",
     *     description="Show Lesson Details",
     *     operationId="getContent",
     *     security={{"bearer":{}}},
     *     @OA\Parameter(name="lesson_id", description="id, eg; 1", required=true, in="path", @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Show Lesson Details"),
     *     @OA\Response(response=400, description="Bad request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function getContent($lesson_id): JsonResponse
    {
        try {
            $lesson = $this->lessonRepository->getAllContent(intval($lesson_id));
            
            if (is_null($lesson)) {
                return $this->responseError(null, 'Lesson Not Found', Response::HTTP_NOT_FOUND);
            }
    
            // Access related exercises, conversations, and tips
            $exercises = $lesson->exercises;
            $conversations = $lesson->conversations;
            $tips = $lesson->tips;
    
            // You can return these data as needed
            $data = [
                'lesson' => $lesson,
                'exercises' => $exercises,
                'conversations' => $conversations,
                'tips' => $tips,
            ];
    
            return $this->responseSuccess($data, 'Lesson Contents Fetch Successfully !');
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    
    /**
     * @OA\Get(
     *     path="/v1/public/api/lessons/by/{course_id}/{level_id}/{unit_id}",
     *     tags={"Lessons"},
     *     summary="Get Lessons by Unit ID",
     *     description="Get list of lessons associated with a specific unit",
     *     operationId="getLessonsByUnitID",
     *     security={{"bearer":{}}},
     *     @OA\Parameter(name="course_id", description="ID of the course", required=true, in="path", @OA\Schema(type="integer")),
     *     @OA\Parameter(name="level_id", description="ID of the level", required=true, in="path", @OA\Schema(type="integer")),
     *     @OA\Parameter(name="unit_id", description="ID of the unit", required=true, in="path", @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Lessons for the specified Unit ID"),
     *     @OA\Response(response=400, description="Bad request"),
     *     @OA\Response(response=404, description="No Lessons found for the specified Unit ID"),
     *     @OA\Response(response=500, description="Internal Server Error")
     * )
     */

    public function getLessonsByUnitID($course_id, $unit_id, $level_id): JsonResponse
        {
            try {
                $lessons = $this->lessonRepository->getLessonsByUnitID($course_id, $unit_id, $level_id);
                
                if ($lessons->isEmpty()) {
                    return $this->responseError(null, 'No lessons Found for the given Unit ID', Response::HTTP_NOT_FOUND);
                }

                return $this->responseSuccess($lessons, 'Lessons for Unit ID ' . $unit_id . ' Fetched Successfully !');
            } catch (\Exception $e) {
                return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }

 

/**
 * @OA\Post(
 *     path="/v1/public/api/lessons",
 *     tags={"Lessons"},
 *     summary="Create New Lesson",
 *     description="Create New Lesson",
 *     operationId="storeLesson",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="course_id", type="integer", example=1),
 *             @OA\Property(property="level_id", type="integer", example=1),
 *             @OA\Property(property="unit_id", type="integer", example=1),
 *             @OA\Property(property="lesson_title", type="string", example="Essential Pronunciation: -ch, -h, -ll, -ñ"),
 *             @OA\Property(property="lesson_type", type="string", example="voice"),
 *             @OA\Property(property="image", type="string", example="lesson_image.jpg"),
 *         ),
 *     ),
 *     security={{"bearer":{}}},
 *     @OA\Response(response=200, description="Create New Lesson"),
 *     @OA\Response(response=400, description="Bad request"),
 *     @OA\Response(response=404, description="Resource Not Found"),
 * )
 */
public function store(LessonRequest $request): JsonResponse
{
    try {
        $lesson = $this->lessonRepository->create($request->all());
        return $this->responseSuccess($lesson, 'New Lesson Created Successfully !');
    } catch (\Exception $exception) {
        return $this->responseError(null, $exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}

/**
 * @OA\Put(
 *     path="/v1/public/api/lessons/{id}",
 *     tags={"Lessons"},
 *     summary="Update Lesson",
 *     description="Update Lesson",
 *     operationId="updateLesson",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="course_id", type="integer", example=1),
 *             @OA\Property(property="level_id", type="integer", example=1),
 *             @OA\Property(property="unit_id", type="integer", example=1),
 *             @OA\Property(property="lesson_title", type="string", example="Essential Pronunciation: -ch, -h, -ll, -ñ"),
 *             @OA\Property(property="lesson_type", type="string", example="voice"),
 *             @OA\Property(property="image", type="string", example="lesson_image.jpg"),
 *         ),
 *     ),
 *     security={{"bearer":{}}},
 *     @OA\Response(response=200, description="Update Lesson"),
 *     @OA\Response(response=400, description="Bad request"),
 *     @OA\Response(response=404, description="Resource Not Found"),
 * )
 */
public function update(LessonRequest $request, $id): JsonResponse
{
    try {
        $data = $this->lessonRepository->update($id, $request->all());
        if (is_null($data))
            return $this->responseError(null, 'Lesson Not Found', Response::HTTP_NOT_FOUND);

        return $this->responseSuccess($data, 'Lesson Updated Successfully !');
    } catch (\Exception $e) {
        return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}

    /**
     * @OA\Delete(
     *     path="/v1/public/api/lessons/{id}",
     *     tags={"Lessons"},
     *     summary="Delete Lessons",
     *     description="Delete Lessons",
     *     operationId="destroyLessons",
     *     security={{"bearer":{}}},
     *     @OA\Parameter(name="id", description="id, eg; 1", required=true, in="path", @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Delete Lessons"),
     *     @OA\Response(response=400, description="Bad request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function destroy($id): JsonResponse
    {
        try {
            $lesson =  $this->lessonRepository->getByID($id);
            if (empty($lesson)) {
                return $this->responseError(null, 'Lesson Not Found', Response::HTTP_NOT_FOUND);
            }

            $deleted = $this->lessonRepository->delete($id);
            if (!$deleted) {
                return $this->responseError(null, 'Failed to delete the Lesson.', Response::HTTP_INTERNAL_SERVER_ERROR);
            }

            return $this->responseSuccess($lesson, 'Lesson Deleted Successfully !');
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

}
