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

    public function __construct(LessonRepository $lessonRepository)
    {
        $this->middleware('auth:api', ['except' => ['indexAll']]);
        $this->lessonRepository = $lessonRepository;
    }


        /**
     * @OA\Get(
     *     path="/v1/public/api/lessons",
     *     tags={"Lessons"},
     *     summary="Get Lesson List",
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
            $data = $this->unitRepository->getAll();
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
            $data = $this->unitRepository->getByID($id);
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
     *     path="/v1/public/api/lessons/by-course/{course_id}",
     *     tags={"Lessons"},
     *     summary="Get Lessons by Course ID",
     *     description="Get list of lessons associated with a specific course",
     *     operationId="getLessonsByCourseID",
     *     security={{"bearer":{}}},
     *     @OA\Parameter(name="course_id", description="ID of the course", required=true, in="path", @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Lessons for the specified Course ID"),
     *     @OA\Response(response=400, description="Bad request"),
     *     @OA\Response(response=404, description="No Lessons found for the specified Course ID"),
     *     @OA\Response(response=500, description="Internal Server Error")
     * )
     */

    public function getLessonByCourseID($course_id): JsonResponse
        {
            try {
                $lessons = $this->unitRepository->getLessonsByCourseID($course_id);
                
                if ($lessons->isEmpty()) {
                    return $this->responseError(null, 'No lessons Found for the given Course ID', Response::HTTP_NOT_FOUND);
                }

                return $this->responseSuccess($lessons, 'Lessons for Course ID ' . $course_id . ' Fetched Successfully !');
            } catch (\Exception $e) {
                return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }

 /**
     * @OA\Get(
     *     path="/v1/public/api/lessons/view/all",
     *     tags={"Lessons"},
     *     summary="All Lessons - Publicly Accessible",
     *     description="All Lessons - Publicly Accessible",
     *     operationId="indexLessonAll",
     *     @OA\Parameter(name="perPage", description="perPage, eg; 20", example=20, in="query", @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="All Lessons - Publicly Accessible" ),
     *     @OA\Response(response=400, description="Bad request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function indexAll(Request $request): JsonResponse
    {
        try {
            $data = $this->unitRepository->getPaginatedData($request->perPage);
            return $this->responseSuccess($data, 'Lessons List Fetched Successfully !');
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

}
