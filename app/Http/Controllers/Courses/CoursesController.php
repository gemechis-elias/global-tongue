<?php

namespace App\Http\Controllers\Courses;

use App\Http\Controllers\Controller;
use App\Repositories\CourseRepository;
use Illuminate\Http\Request;
use App\Http\Requests\CourseRequest;
use OpenApi\Annotations as OA; 
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;



class CoursesController extends Controller
{
    use ResponseTrait;
       /**
     * Exercise Repository class.
     *
     * @var CourseRepository
     */
    public  $courseRepository;

    public function __construct(CourseRepository $courseRepository)
    {
        $this->middleware('auth:api', ['except' => ['indexAll']]);
        $this->courseRepository = $courseRepository;
    }

    /**
     * @OA\Get(
     *     path="/v1/public/api/courses",
     *     tags={"Courses"},
     *     summary="Get Course List",
     *     description="Get Course List as Array",
     *     operationId="index",
     *     security={{"bearer":{}}},
     *     @OA\Response(response=200,description="Get Course List as Array"),
     *     @OA\Response(response=400, description="Bad request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function index(): JsonResponse
    {
        try {
            $data = $this->courseRepository->getAll();
            return $this->responseSuccess($data, 'Course List Fetch Successfully !');
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\Get(
     *     path="/v1/public/api/courses/view/all",
     *     tags={"Courses"},
     *     summary="All Courses - Publicly Accessible",
     *     description="All Courses - Publicly Accessible",
     *     operationId="indexAll",
     *     @OA\Parameter(name="perPage", description="perPage, eg; 20", example=20, in="query", @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="All Courses - Publicly Accessible" ),
     *     @OA\Response(response=400, description="Bad request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function indexAll(Request $request): JsonResponse
    {
        try {
            $data = $this->courseRepository->getPaginatedData($request->perPage);
            return $this->responseSuccess($data, 'Course List Fetched Successfully !');
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\Get(
     *     path="/v1/public/api/courses/view/search",
     *     tags={"Courses"},
     *     summary="All Courses - Publicly Accessible",
     *     description="All Courses - Publicly Accessible",
     *     operationId="search",
     *     @OA\Parameter(name="perPage", description="perPage, eg; 20", example=20, in="query", @OA\Schema(type="integer")),
     *     @OA\Parameter(name="search", description="search, eg; Test", example="Test", in="query", @OA\Schema(type="string")),
     *     @OA\Response(response=200, description="All Courses - Publicly Accessible" ),
     *     @OA\Response(response=400, description="Bad request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function search(Request $request): JsonResponse
    {
        try {
            $data = $this->courseRepository->searchCourse($request->search, $request->perPage);
            return $this->responseSuccess($data, 'Course List Fetched Successfully !');
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\Post(
     *     path="/v1/public/api/courses",
     *     tags={"Courses"},
     *     summary="Create New Course",
     *     description="Create New Course",
     *     operationId="store",
     *     @OA\RequestBody(
     *          @OA\JsonContent(
     *              type="object",
     *             @OA\Property(property="name", type="string", example="English for Beginner"),
     *             @OA\Property(property="description", type="string", example="Here are the biggest enterprise technology acquisitions of 2021 so far, in reverse chronological order."),
     *             @OA\Property(property="level", type="string", example="Beginner"),
     *            @OA\Property(property="type", type="string", example="free"),
     *          ),
     *      ),
     *      security={{"bearer":{}}},
     *      @OA\Response(response=200, description="Create New Course" ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function store(CourseRequest $request): JsonResponse
    {
        try {
            $product = $this->courseRepository->create($request->all());
            return $this->responseSuccess($product, 'New Course Created Successfully !');
        } catch (\Exception $exception) {
            return $this->responseError(null, $exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\Get(
     *     path="/v1/public/api/courses/{course_id}",
     *     tags={"Courses"},
     *     summary="Show Course Details",
     *     description="Show Course Details",
     *     operationId="show",
     *     security={{"bearer":{}}},
     *     @OA\Parameter(name="id", description="id, eg; 1", required=true, in="path", @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Show Course Details"),
     *     @OA\Response(response=400, description="Bad request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function show($id): JsonResponse
    {
        try {
            $data = $this->courseRepository->getByID($id);
            if (is_null($data)) {
                return $this->responseError(null, 'Course Not Found', Response::HTTP_NOT_FOUND);
            }

            return $this->responseSuccess($data, 'Course Details Fetch Successfully !');
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\Put(
     *     path="/v1/public/api/courses/{id}",
     *     tags={"Courses"},
     *     summary="Update Course",
     *     description="Update Course",
     *     @OA\Parameter(name="id", description="id, eg; 1", required=true, in="path", @OA\Schema(type="integer")),
     *     @OA\RequestBody(
     *          @OA\JsonContent(
     *              type="object",
     *             @OA\Property(property="name", type="string", example="English for Beginner"),
     *             @OA\Property(property="description", type="string", example="Here are the biggest enterprise technology acquisitions of 2021 so far, in reverse chronological order."),
     *             @OA\Property(property="level", type="string", example="Beginner"),
     *             @OA\Property(property="type", type="string", example="free"),
     *          ),
     *      ),
     *     operationId="update",
     *     security={{"bearer":{}}},
     *     @OA\Response(response=200, description="Update Course"),
     *     @OA\Response(response=400, description="Bad request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function update(CourseRequest $request, $id): JsonResponse
    {
        try {
            $data = $this->courseRepository->update($id, $request->all());
            if (is_null($data))
                return $this->responseError(null, 'Course Not Found', Response::HTTP_NOT_FOUND);

            return $this->responseSuccess($data, 'Course Updated Successfully !');
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\Delete(
     *     path="/v1/public/api/courses/{id}",
     *     tags={"Courses"},
     *     summary="Delete Course",
     *     description="Delete Course",
     *     operationId="destroy",
     *     security={{"bearer":{}}},
     *     @OA\Parameter(name="id", description="id, eg; 1", required=true, in="path", @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Delete Course"),
     *     @OA\Response(response=400, description="Bad request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function destroy($id): JsonResponse
    {
        try {
            $product =  $this->courseRepository->getByID($id);
            if (empty($product)) {
                return $this->responseError(null, 'Course Not Found', Response::HTTP_NOT_FOUND);
            }

            $deleted = $this->courseRepository->delete($id);
            if (!$deleted) {
                return $this->responseError(null, 'Failed to delete the product.', Response::HTTP_INTERNAL_SERVER_ERROR);
            }

            return $this->responseSuccess($product, 'Course Deleted Successfully !');
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
