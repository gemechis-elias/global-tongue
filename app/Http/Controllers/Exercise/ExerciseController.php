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
    
        public function __construct(ExerciseRepository $exerciseRepository)
        {
            $this->middleware('auth:api', ['except' => ['indexAll']]);
            $this->exerciseRepository = $exerciseRepository;
        }
    
    
            /**
         * @OA\Get(
         *     path="/v1/public/api/exercises",
         *     tags={"Exercises"},
         *     summary="Get Exercise List",
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
         *     path="/v1/public/api/exercises/by-lesson/{course_id, unit_id, lesson_id}",
         *     tags={"Exercises"},
         *     summary="Get Exercises by Lesson ID",
         *     description="Get list of exercises associated with a specific lesson",
         *     operationId="getExercisesByLessonID",
         *     security={{"bearer":{}}},
         *     @OA\Parameter(name="lesson_id", description="ID of the lesson", required=true, in="path", @OA\Schema(type="integer")),
         *     @OA\Response(response=200, description="Exercises for the specified Lesson ID"),
         *     @OA\Response(response=400, description="Bad request"),
         *     @OA\Response(response=404, description="No Exercises found for the specified Lesson ID"),
         *     @OA\Response(response=500, description="Internal Server Error")
         * )
         */
    
        public function getExerciseByLessonID($course_id, $unit_id, $lesson_id): JsonResponse
            {
                try {
                    $exercises = $this->exerciseRepository->getExercisesByLessonID($course_id, $unit_id, $lesson_id);
                    
                    if ($exercises->isEmpty()) {
                        return $this->responseError(null, 'No exercises Found for the given Lesson ID', Response::HTTP_NOT_FOUND);
                    }
    
                    return $this->responseSuccess($exercises, 'Exercises for Lesson ID ' . $lesson_id . ' Fetched Successfully !');
                } catch (\Exception $e) {
                    return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
                }
            }
    
     /**
         * @OA\Get(
         *     path="/v1/public/api/exercises/view/all",
         *     tags={"Exercises"},
         *     summary="All Exercises - Publicly Accessible",
         *     description="All Exercises - Publicly Accessible",
         *     operationId="indexExerciseAll",
         *     @OA\Parameter(name="perPage", description="perPage, eg; 20", example=20, in="query", @OA\Schema(type="integer")),
         *     @OA\Response(response=200, description="All Exercises - Publicly Accessible" ),
         *     @OA\Response(response=400, description="Bad request"),
         *     @OA\Response(response=404, description="Resource Not Found"),
         * )
         */
        public function indexAll(Request $request): JsonResponse
        {
            try {
                $data = $this->exerciseRepository->getPaginatedData($request->perPage);
                return $this->responseSuccess($data, 'Exercises List Fetched Successfully !');
            } catch (\Exception $e) {
                return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }
    
    }
    